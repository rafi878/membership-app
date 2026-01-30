@extends('layouts.app')

@section('title', 'Videos - Membership App')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="fw-bold">Videos</h1>
            <p class="text-muted">Access premium video tutorials based on your membership level.</p>
        </div>
        <div class="col-md-4 text-end">
            <div class="membership-badge badge-type-{{ strtolower(auth()->user()->membership_type) }}">
                {{ auth()->user()->membership_name }} Membership
            </div>
        </div>
    </div>

    <!-- Video Usage Stats -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h5 class="card-title mb-1">Your Video Access</h5>
                    <p class="text-muted small mb-0">
                        Used: {{ isset($videoCount) ? $videoCount : 0 }} of {{ isset($videoLimit) && $videoLimit == 999 ? 'Unlimited' : ($videoLimit ?? 0) }} videos
                    </p>
                </div>
                <div class="col-md-4">
                    <div class="progress" style="height: 10px;">
                        <div class="progress-bar progress-bar-type-{{ strtolower(auth()->user()->membership_type) }}" 
                             sstyle="width: {{ isset($videoUsage) ? $videoUsage : 0 }}%"></div>
                    </div>
                    <div class="text-end mt-1">
                        <span class="small">{{ number_format($videoUsage, 0) }}% used</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Videos Grid -->
    @if($videos->count() > 0)
    <div class="row">
        @foreach($videos as $video)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="position-relative">
                    <div class="ratio ratio-16x9 bg-light">
                        <div class="d-flex align-items-center justify-content-center h-100">
                            <i class="fas fa-play-circle fa-4x text-primary"></i>
                        </div>
                    </div>
                    @if($video->is_premium)
                    <span class="badge bg-warning position-absolute top-0 end-0 m-2">Premium</span>
                    @endif
                    <span class="badge bg-dark position-absolute bottom-0 end-0 m-2">
                        {{ $video->duration_formatted ?? '0:00' }}
                    </span>
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $video->title }}</h5>
                    <p class="card-text text-muted small">{{ Str::limit($video->description ?? '', 100) }}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ $video->url }}" target="_blank" class="btn btn-sm btn-danger">
                            <i class="fab fa-youtube me-1"></i> Watch
                        </a>
                        <small class="text-muted">
                            <i class="fas fa-eye me-1"></i> {{ $video->view_count }} views
                        </small>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="text-center py-5">
        <i class="fas fa-video-slash fa-4x text-muted mb-3"></i>
        <h4>No Videos Available</h4>
        <p class="text-muted">No videos are available for your current membership level.</p>
        <a href="{{ route('dashboard') }}" class="btn btn-primary">
            <i class="fas fa-arrow-left me-2"></i> Back to Dashboard
        </a>
    </div>
    @endif

    <!-- Back to Dashboard -->
    <div class="mt-4 text-center">
        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i> Back to Dashboard
        </a>
    </div>
</div>

<style>
    .membership-badge {
        display: inline-block;
        padding: 8px 16px;
        border-radius: 20px;
        font-weight: bold;
        font-size: 0.9em;
        color: white;
    }
    
    .badge-type-a {
        background: #6c757d;
    }
    
    .badge-type-b {
        background: #0d6efd;
    }
    
    .badge-type-c {
        background: #ffc107;
        color: black;
    }
    
    .progress-bar-type-a {
        background-color: #6c757d;
    }
    
    .progress-bar-type-b {
        background-color: #0d6efd;
    }
    
    .progress-bar-type-c {
        background-color: #ffc107;
    }
</style>
@endsection