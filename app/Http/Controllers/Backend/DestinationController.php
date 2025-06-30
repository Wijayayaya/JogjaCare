<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;

class DestinationController extends Controller
{
    // Maximum file size in bytes (512KB untuk mencegah error)
    const MAX_FILE_SIZE = 512 * 1024; // 512KB
    const MAX_WIDTH = 800; // Maximum width
    const MAX_HEIGHT = 600; // Maximum height
    const JPEG_QUALITY = 80; // JPEG compression quality
    
    public function index()
    {
        $destinations = Destination::ordered()->paginate(10);
        return view('backend.destinations.index', compact('destinations'));
    }

    public function create()
    {
        return view('backend.destinations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000', // Batasi deskripsi
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:512', // Kurangi menjadi 512KB
            'map_url' => 'nullable|url',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0'
        ]);

        $data = $request->all();
        
        if ($request->hasFile('image')) {
            try {
                $processedImage = $this->processImage($request->file('image'));
                $data['image'] = $processedImage['base64'];
                $data['image_mime_type'] = $processedImage['mime_type'];
            } catch (\Exception $e) {
                return back()->withErrors(['image' => 'Failed to process image: ' . $e->getMessage()]);
            }
        }

        Destination::create($data);

        return redirect()->route('backend.destinations.index')
            ->with('success', 'Destination created successfully.');
    }

    public function show(Destination $destination)
    {
        return view('backend.destinations.show', compact('destination'));
    }

    public function edit(Destination $destination)
    {
        return view('backend.destinations.edit', compact('destination'));
    }

    public function update(Request $request, Destination $destination)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:512', // Kurangi menjadi 512KB
            'map_url' => 'nullable|url',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0'
        ]);

        $data = $request->all();
        
        if ($request->hasFile('image')) {
            try {
                $processedImage = $this->processImage($request->file('image'));
                $data['image'] = $processedImage['base64'];
                $data['image_mime_type'] = $processedImage['mime_type'];
            } catch (\Exception $e) {
                return back()->withErrors(['image' => 'Failed to process image: ' . $e->getMessage()]);
            }
        } else {
            // Remove image keys if no new image uploaded
            unset($data['image'], $data['image_mime_type']);
        }

        $destination->update($data);

        return redirect()->route('backend.destinations.index')
            ->with('success', 'Destination updated successfully.');
    }

    public function destroy(Destination $destination)
    {
        $destination->delete();

        return redirect()->route('backend.destinations.index')
            ->with('success', 'Destination deleted successfully.');
    }

    /**
     * Process and compress image
     */
    private function processImage($file)
    {
        // Check file size
        if ($file->getSize() > self::MAX_FILE_SIZE) {
            throw new \Exception('File size must not exceed ' . $this->formatBytes(self::MAX_FILE_SIZE) . '.');
        }

        // Check if GD extension is available, fallback to Imagick or basic processing
        try {
            if (extension_loaded('gd')) {
                $manager = new ImageManager(['driver' => 'gd']);
            } elseif (extension_loaded('imagick')) {
                $manager = new ImageManager(['driver' => 'imagick']);
            } else {
                // Fallback: Just convert to base64 without processing
                return $this->basicImageProcessing($file);
            }
            
            // Create image instance
            $image = $manager->make($file);
            
            // Get original dimensions
            $originalWidth = $image->width();
            $originalHeight = $image->height();
            
            // Calculate new dimensions while maintaining aspect ratio
            if ($originalWidth > self::MAX_WIDTH || $originalHeight > self::MAX_HEIGHT) {
                $image->resize(self::MAX_WIDTH, self::MAX_HEIGHT, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
            }
            
            // Convert to JPEG for better compression (except for PNG with transparency)
            $mimeType = $file->getMimeType();
            if ($mimeType !== 'image/png' || !$this->hasTransparency($image)) {
                $image->encode('jpg', self::JPEG_QUALITY);
                $mimeType = 'image/jpeg';
            } else {
                $image->encode('png');
                $mimeType = 'image/png';
            }
            
            // Get the compressed image data
            $imageData = $image->getEncoded();
            
            // Check if compressed size is still too large
            $compressedSize = strlen($imageData);
            if ($compressedSize > (self::MAX_FILE_SIZE * 0.8)) { // 80% of max size
                // Further compress if still too large
                if ($mimeType === 'image/jpeg') {
                    $image->encode('jpg', 60); // Lower quality
                } else {
                    // For PNG, convert to JPEG
                    $image->encode('jpg', 70);
                    $mimeType = 'image/jpeg';
                }
                $imageData = $image->getEncoded();
            }
            
            $base64 = base64_encode($imageData);
            
            // Final size check
            $finalSize = strlen($base64);
            if ($finalSize > (500 * 1024)) { // 500KB limit for base64
                throw new \Exception('Image is too large even after compression. Please use a smaller image.');
            }
            
            return [
                'base64' => $base64,
                'mime_type' => $mimeType
            ];
            
        } catch (\Exception $e) {
            // If image processing fails, try basic processing
            if (strpos($e->getMessage(), 'driver') !== false || strpos($e->getMessage(), 'extension') !== false) {
                return $this->basicImageProcessing($file);
            }
            throw $e;
        }
    }

    /**
     * Basic image processing without intervention/image
     */
    private function basicImageProcessing($file)
    {
        // Double check file size
        if ($file->getSize() > self::MAX_FILE_SIZE) {
            throw new \Exception('File size must not exceed ' . $this->formatBytes(self::MAX_FILE_SIZE) . '. Current size: ' . $this->formatBytes($file->getSize()));
        }

        $imageData = file_get_contents($file->getRealPath());
        $base64 = base64_encode($imageData);
        
        // Check base64 size (base64 adds ~33% overhead)
        $base64Size = strlen($base64);
        $maxBase64Size = 300 * 1024; // 300KB limit for base64 to be safe
        
        if ($base64Size > $maxBase64Size) {
            throw new \Exception(
                'Image file is too large for processing without compression. ' .
                'File size: ' . $this->formatBytes($file->getSize()) . 
                ', Base64 size: ' . $this->formatBytes($base64Size) . 
                '. Please use an image smaller than 200KB or enable GD/Imagick extension.'
            );
        }
        
        return [
            'base64' => $base64,
            'mime_type' => $file->getMimeType()
        ];
    }

    /**
     * Check if PNG has transparency
     */
    private function hasTransparency($image)
    {
        // Simple check - if it's PNG and has alpha channel
        return $image->mime() === 'image/png';
    }

    private function formatBytes($size, $precision = 2)
    {
        $units = array('B', 'KB', 'MB', 'GB');
        
        for ($i = 0; $size > 1024 && $i < count($units) - 1; $i++) {
            $size /= 1024;
        }
        
        return round($size, $precision) . ' ' . $units[$i];
    }
}