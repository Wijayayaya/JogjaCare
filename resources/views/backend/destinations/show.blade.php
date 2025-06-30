@extends('backend.layouts.app')

@section('title') {{ __('Destination Details') }} @endsection

@section('breadcrumbs')
<x-backend.breadcrumbs>
    <x-backend.breadcrumb-item route='{{route("backend.dashboard")}}' icon='fa-solid fa-cubes' >
        {{ __('Dashboard') }}
    </x-backend.breadcrumb-item>
    <x-backend.breadcrumb-item route='{{route("backend.destinations.index")}}'>{{ __('Destinations') }}</x-backend.breadcrumb-item>
    <x-backend.breadcrumb-item type="active">{{ __('Details') }}</x-backend.breadcrumb-item>
</x-backend.breadcrumbs>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-8">
                <h4 class="card-title mb-0">
                    <i class="fa-solid fa-map-location-dot"></i> {{ $destination->title }}
                </h4>
            </div>
            <div class="col-4">
                <div class="btn-toolbar float-end" role="toolbar">
                    <a href="{{ route('backend.destinations.edit', $destination) }}" class="btn btn-primary btn-sm ms-1">
                        <i class="fas fa-edit"></i> {{ __('Edit') }}
                    </a>
                    <a href="{{ route('backend.destinations.index') }}" class="btn btn-secondary btn-sm ms-1">
                        <i class="fas fa-arrow-left"></i> {{ __('Back') }}
                    </a>
                </div>
            </div>
        </div>
        <hr>
        
        <div class="row">
            <div class="col-12 col-md-8">
                <table class="table table-borderless">
                    <tr>
                        <th width="200">{{ __('Title') }}:</th>
                        <td>{{ $destination->title }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Description') }}:</th>
                        <td>{{ $destination->description }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Google Maps URL') }}:</th>
                        <td>
                            @if($destination->map_url)
                                <a href="{{ $destination->map_url }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-external-link-alt"></i> {{ __('Open in Google Maps') }}
                                </a>
                            @else
                                <span class="text-muted">{{ __('Not provided') }}</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>{{ __('Status') }}:</th>
                        <td>
                            @if($destination->is_active)
                                <span class="badge bg-success">{{ __('Active') }}</span>
                            @else
                                <span class="badge bg-danger">{{ __('Inactive') }}</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>{{ __('Sort Order') }}:</th>
                        <td>{{ $destination->sort_order }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Created At') }}:</th>
                        <td>{{ $destination->created_at->format('d M Y H:i') }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Updated At') }}:</th>
                        <td>{{ $destination->updated_at->format('d M Y H:i') }}</td>
                    </tr>
                </table>
            </div>
            
            <div class="col-12 col-md-4">
                @if($destination->hasImage())
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0">{{ __('Image') }}</h6>
                    </div>
                    <div class="card-body text-center">
                        <img src="{{ $destination->image_url }}" alt="{{ $destination->title }}" class="img-fluid rounded">
                        <div class="mt-2">
                            <small class="text-muted">{{ __('Size') }}: {{ $destination->image_size }}</small>
                        </div>
                    </div>
                </div>
                @else
                <div class="card">
                    <div class="card-body text-center">
                        <i class="fas fa-image fa-3x text-muted mb-3"></i>
                        <p class="text-muted">{{ __('No image uploaded') }}</p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection