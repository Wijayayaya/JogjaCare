@extends('backend.layouts.app')

@section('title') {{ __('Destinations') }} @endsection

@section('breadcrumbs')
<x-backend.breadcrumbs>
    <x-backend.breadcrumb-item route='{{route("backend.dashboard")}}' icon='fa-solid fa-cubes' >
        {{ __('Dashboard') }}
    </x-backend.breadcrumb-item>
    <x-backend.breadcrumb-item type="active">{{ __('Destinations') }}</x-backend.breadcrumb-item>
</x-backend.breadcrumbs>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-8">
                <h4 class="card-title mb-0">
                    <i class="fa-solid fa-map-location-dot"></i> {{ __('Destinations') }}
                    <small class="text-muted">{{ __('Management') }}</small>
                </h4>
            </div>
            <div class="col-4">
                <div class="btn-toolbar float-end" role="toolbar" aria-label="Toolbar with button groups">
                    <a href="{{ route('backend.destinations.create') }}" class="btn btn-success btn-sm ms-1" data-toggle="tooltip" title="{{ __('Create') }} {{ __('Destination') }}">
                        <i class="fas fa-plus-circle"></i> {{ __('New') }}
                    </a>
                </div>
            </div>
        </div>
        <hr>
        
        <div class="row mt-4">
            <div class="col">
                @if($destinations->count())
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>{{ __('Image') }}</th>
                                <th>{{ __('Title') }}</th>
                                <th>{{ __('Description') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Sort Order') }}</th>
                                <th>{{ __('Image Size') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($destinations as $destination)
                            <tr>
                                <td>
                                    @if($destination->hasImage())
                                        <img src="{{ $destination->image_url }}" alt="{{ $destination->title }}" class="img-thumbnail" style="width: 80px; height: 60px; object-fit: cover;">
                                    @else
                                        <div class="bg-light d-flex align-items-center justify-content-center" style="width: 80px; height: 60px;">
                                            <i class="fas fa-image text-muted"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>{{ $destination->title }}</td>
                                <td>{{ Str::limit($destination->description, 100) }}</td>
                                <td>
                                    @if($destination->is_active)
                                        <span class="badge bg-success">{{ __('Active') }}</span>
                                    @else
                                        <span class="badge bg-danger">{{ __('Inactive') }}</span>
                                    @endif
                                </td>
                                <td>{{ $destination->sort_order }}</td>
                                <td>
                                    @if($destination->hasImage())
                                        <small class="text-muted">{{ $destination->image_size }}</small>
                                    @else
                                        <small class="text-muted">-</small>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('backend.destinations.show', $destination) }}" class="btn btn-sm btn-outline-primary" data-toggle="tooltip" title="{{ __('Show') }}">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('backend.destinations.edit', $destination) }}" class="btn btn-sm btn-outline-secondary" data-toggle="tooltip" title="{{ __('Edit') }}">
                                            <i class="fas fa-wrench"></i>
                                        </a>
                                        <form method="POST" action="{{ route('backend.destinations.destroy', $destination) }}" style="display: inline;" onsubmit="return confirm('{{ __('Are you sure?') }}')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" data-toggle="tooltip" title="{{ __('Delete') }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                {{ $destinations->links() }}
                @else
                <div class="text-center">
                    <p>{{ __('No destinations found.') }}</p>
                    <a href="{{ route('backend.destinations.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> {{ __('Add First Destination') }}
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection