@extends('layouts.mainroll')

@section('title', 'Home - CGX')

@section('styles')
<link href="{{ asset('build/assets/css/gallery.css') }}" rel="stylesheet">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
@endsection

@section('content')
<div class="container mt-5 pt-5">
    <div class="row justify-content-center mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>{{ __('Dashboard') }}</span>
                    
                    <!-- Upload Image Button -->
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#uploadImageModal">
                        Upload Image
                    </button>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Welcome to CGX') }}
                </div>
            </div>
        </div>
    </div>

    <!-- Image Gallery -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Image Gallery</h4>
                </div>
                <div class="card-body">
                    <!-- Page Content -->
                    <div class="container page-top">
                        <div class="row">
                            @if(!empty($images) && count($images) > 0)
                                @foreach($images as $image)
                                <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                                    <a href="{{ asset('storage/'.$image->path) }}" class="fancybox" rel="lightbox">
                                    <img src="{{ asset('storage/'.$image->path) }}" class="zoom img-fluid" alt="{{ $image->title ?? 'Gallery Image' }}">
                                    </a>
                                </div>
                                @endforeach
                            @else
                                <div class="col-12 text-center py-5">
                                    <h5 class="text-muted">No Images in gallery.</h5>
                                    <!-- <p class="mt-3">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadImageModal">
                                            Upload Your First Image
                                        </button>
                                    </p> -->
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Upload Image Modal -->
    <div class="modal fade" id="uploadImageModal" tabindex="-1" aria-labelledby="uploadImageModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadImageModalLabel">Upload Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="imageUploadForm" action="{{ route('image.upload') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">Image Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Select Image</label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                        </div>
                        <button type="submit" id="uploadButton" class="btn btn-primary">Upload</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('left-nav')
    <!-- Add any specific left navigation items for home page -->
    <!-- <li class="nav-item">
        <a class="nav-link" href="#">Services</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">About</a>
    </li> -->
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('build/assets/js/gallery.js') }}"></script>
@endsection