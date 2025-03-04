@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">All Images</h1>
        <div>
            <a href="{{ route('admin.images.pending') }}" class="btn btn-warning btn-sm">
                <i class="fas fa-clock fa-sm"></i> Pending
            </a>
            <a href="{{ route('admin.images.approved') }}" class="btn btn-success btn-sm">
                <i class="fas fa-check fa-sm"></i> Approved
            </a>
            <a href="{{ route('admin.images.rejected') }}" class="btn btn-danger btn-sm">
                <i class="fas fa-times fa-sm"></i> Rejected
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Image Gallery</h6>
        </div>
        <div class="card-body">
            @if($images->count() > 0)
                <div class="row">
                    @foreach($images as $image)
                    <div class="col-md-4 col-lg-3 mb-4">
                        <div class="card h-100">
                            <img src="{{ asset('storage/' . $image->file_path) }}" class="card-img-top" alt="{{ $image->original_filename }}">
                            <div class="card-body">
                                <h5 class="card-title text-truncate">{{ $image->original_filename }}</h5>
                                <p class="card-text">
                                    <small class="text-muted">Uploaded by {{ $image->user->name }}</small><br>
                                    <small class="text-muted">{{ $image->created_at->format('M d, Y H:i') }}</small>
                                </p>
                                <p>
                                    @if($image->status == 'pending')
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @elseif($image->status == 'approved')
                                        <span class="badge bg-success">Approved</span>
                                    @else
                                        <span class="badge bg-danger">Rejected</span>
                                    @endif
                                </p>
                            </div>
                            <div class="card-footer">
                                @if($image->status == 'pending')
                                    <form action="{{ route('admin.images.approve', $image->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-success">Approve</button>
                                    </form>
                                    <form action="{{ route('admin.images.reject', $image->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-danger">Reject</button>
                                    </form>
                                @elseif($image->status == 'approved')
                                    <form action="{{ route('admin.images.reject', $image->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-danger">Reject</button>
                                    </form>
                                @else
                                    <form action="{{ route('admin.images.approve', $image->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-success">Approve</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="d-flex justify-content-center mt-4">
                    {{ $images->links() }}
                </div>
            @else
                <p class="text-center">No images found.</p>
            @endif
        </div>
    </div>
</div>
@endsection