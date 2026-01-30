@extends('layouts.app')

@section('title', 'Dashboard - Membership App')

@section('content')
<div class="container-fluid p-0">
    <!-- User Info -->
    <div class="user-info-card">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h2 class="fw-bold">Welcome, {{ auth()->user()->name }}!</h2>
                <p class="mb-2">{{ auth()->user()->email }}</p>
                <span class="membership-badge badge-type-{{ strtolower(auth()->user()->membership_type) }}">
                    {{ auth()->user()->membership_name }} Membership
                </span>
            </div>
            <div class="col-md-4 text-end">
                <div class="avatar bg-white rounded-circle d-inline-flex align-items-center justify-content-center"
                    style="width: 80px; height: 80px;">
                    @if(auth()->user()->avatar)
                    <img src="{{ auth()->user()->avatar }}" class="rounded-circle" width="80" height="80" alt="Avatar">
                    @else
                    <i class="fas fa-user fa-3x text-primary"></i>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Content Usage -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="content-card">
                <h4 class="fw-bold mb-4"><i class="fas fa-newspaper me-2"></i>Article Access</h4>
                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-2">
                        <span>Used: {{ $articleCount }} of {{ $articleLimit == 999 ? 'Unlimited' : $articleLimit }}</span>
                        <span>{{ number_format($articleUsage, 0) }}%</span>
                    </div>
                    <div class="progress" style="height: 10px;">
                        <div class="progress-bar progress-bar-type-{{ strtolower(auth()->user()->membership_type) }}"
                            style="width: {{ $articleUsage }}%"></div>
                    </div>
                </div>
                <p class="text-muted small">Access to premium articles based on your membership level.</p>
            </div>
        </div>

        <div class="col-md-6">
            <div class="content-card">
                <h4 class="fw-bold mb-4"><i class="fas fa-video me-2"></i>Video Access</h4>
                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-2">
                        <span>Used: {{ $videoCount }} of {{ $videoLimit == 999 ? 'Unlimited' : $videoLimit }}</span>
                        <span>{{ number_format($videoUsage, 0) }}%</span>
                    </div>
                    <div class="progress" style="height: 10px;">
                        <div class="progress-bar progress-bar-type-{{ strtolower(auth()->user()->membership_type) }}"
                            style="width: {{ $videoUsage }}%;"></div>
                    </div>
                </div>
                <p class="text-muted small">Access to premium video tutorials based on your membership level.</p>
            </div>
        </div>
    </div>

    <!-- Articles Section -->
    <div class="content-card">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold mb-0"><i class="fas fa-newspaper me-2"></i>Latest Articles</h4>
            <span class="badge bg-primary">{{ $articleCount }} Articles</span>
        </div>

        @if($articles->count() > 0)
        <div class="row">
            @foreach($articles as $article)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="badge bg-secondary">{{ $article->category }}</span>
                            @if($article->is_premium)
                            <span class="badge bg-warning">Premium</span>
                            @endif
                        </div>
                        <h5 class="card-title">{{ $article->title }}</h5>
                        <p class="card-text">{{ Str::limit($article->content, 100) }}</p>
                        <a href="{{ route('articles.show', $article->id) }}" class="btn btn-sm btn-outline-primary">
                            Read Article <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                    <div class="card-footer text-muted small">
                        <i class="fas fa-eye me-1"></i> {{ $article->view_count }} views
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-4">
            <p class="text-muted">No articles available for your membership level.</p>
        </div>
        @endif

        <!-- View All Articles Button -->
        <div class="text-center mt-4">
            <a href="{{ route('articles.index') }}" class="btn btn-primary">
                <i class="fas fa-list me-2"></i> View All Articles
            </a>
        </div>
    </div>

    <!-- Videos Section -->
    <div class="content-card">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold mb-0"><i class="fas fa-video me-2"></i>Latest Videos</h4>
            <span class="badge bg-primary">{{ $videoCount }} Videos</span>
        </div>

        @if($videos->count() > 0)
        <div class="row">
            @foreach($videos as $video)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="position-relative mb-3">
                            <div class="ratio ratio-16x9 bg-light rounded overflow-hidden">
                                <div class="d-flex align-items-center justify-content-center h-100">
                                    <i class="fas fa-play-circle fa-3x text-primary"></i>
                                </div>
                            </div>
                            <span class="badge bg-dark position-absolute bottom-0 end-0 m-2">
                                {{ $video->duration_formatted }}
                            </span>
                            @if($video->is_premium)
                            <span class="badge bg-warning position-absolute top-0 end-0 m-2">Premium</span>
                            @endif
                        </div>
                        <h5 class="card-title">{{ $video->title }}</h5>
                        <p class="card-text small text-muted">{{ Str::limit($video->description, 80) }}</p>
                        <a href="{{ $video->url }}" target="_blank" class="btn btn-sm btn-outline-danger">
                            <i class="fab fa-youtube me-1"></i> Watch Video
                        </a>
                    </div>
                    <div class="card-footer text-muted small">
                        <i class="fas fa-eye me-1"></i> {{ $video->view_count }} views
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-4">
            <p class="text-muted">No videos available for your membership level.</p>
        </div>
        @endif
        
        <!-- OPSIONAL: Tombol View All Videos jika dibutuhkan -->
        {{--
        <div class="text-center mt-4">
            <a href="{{ route('videos.index') }}" class="btn btn-primary">
                <i class="fas fa-list me-2"></i> View All Videos
            </a>
        </div>
        --}}
    </div>

    <!-- Upgrade Membership Section -->
    <div class="content-card">
        <h4 class="fw-bold mb-4"><i class="fas fa-crown me-2"></i>Upgrade Your Membership</h4>
        <p>Want to access more content? Upgrade your membership plan to get more articles and videos.</p>

        <form method="POST" action="{{ route('dashboard.upgrade') }}">
            @csrf
            <div class="row mt-4">
                @foreach(['A' => 'Basic', 'B' => 'Standard', 'C' => 'Premium'] as $key => $name)
                <div class="col-md-4 mb-3">
                    <div class="card h-100 {{ auth()->user()->membership_type == $key ? 'border-primary' : '' }}">
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ $name }}</h5>
                            <h2 class="fw-bold">
                                @if($key == 'A') Free
                                @elseif($key == 'B') $9.99<span class="fs-6 text-muted">/month</span>
                                @else $19.99<span class="fs-6 text-muted">/month</span>
                                @endif
                            </h2>
                            <ul class="list-unstyled mb-3">
                                @if($key == 'A')
                                <li class="mb-2">3 Articles</li>
                                <li class="mb-2">3 Videos</li>
                                @elseif($key == 'B')
                                <li class="mb-2">10 Articles</li>
                                <li class="mb-2">10 Videos</li>
                                <li class="mb-2">Premium Content</li>
                                @else
                                <li class="mb-2">Unlimited Articles</li>
                                <li class="mb-2">Unlimited Videos</li>
                                <li class="mb-2">All Premium Content</li>
                                @endif
                            </ul>
                            @if(auth()->user()->membership_type == $key)
                            <button type="button" class="btn btn-outline-primary w-100" disabled>
                                Current Plan
                            </button>
                            @else
                            <button type="submit" name="membership_type" value="{{ $key }}"
                                class="btn btn-{{ $key == 'C' ? 'warning' : 'primary' }} w-100">
                                Upgrade to {{ $name }}
                            </button>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </form>
    </div>
</div>

<style>
    .user-info-card {
        background: linear-gradient(135deg, #4361ee 0%, #3a0ca3 100%);
        color: white;
        border-radius: 15px;
        padding: 25px;
        margin-bottom: 20px;
    }

    .content-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        padding: 25px;
        margin-bottom: 30px;
        transition: transform 0.3s;
    }

    .content-card:hover {
        transform: translateY(-5px);
    }

    /* Optional: Tambahkan styling untuk badge jika perlu */
    .membership-badge {
        display: inline-block;
        padding: 5px 15px;
        border-radius: 20px;
        font-weight: bold;
        font-size: 0.9em;
    }
    
    .badge-type-a { background: #6c757d; color: white; }
    .badge-type-b { background: #0d6efd; color: white; }
    .badge-type-c { background: #ffc107; color: black; }
    
    .progress-bar-type-a { background-color: #6c757d; }
    .progress-bar-type-b { background-color: #0d6efd; }
    .progress-bar-type-c { background-color: #ffc107; }
</style>
@endsection