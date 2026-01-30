@extends('layouts.app')

@section('title', $article->title . ' - Membership App')

@section('content')
<div class="container py-4">
    <!-- Back Button -->
    <div class="row mb-4">
        <div class="col">
            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i> Back to Articles
            </a>
        </div>
    </div>

    <!-- Article Content -->
    <div class="row">
        <div class="col-lg-8">
            <!-- Article Header -->
            <div class="card mb-4">
                @if($article->image)
                <img src="{{ $article->image }}" class="card-img-top" alt="{{ $article->title }}" style="max-height: 400px; object-fit: cover;">
                @endif

                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <span class="badge bg-primary">{{ $article->category }}</span>
                            @if($article->is_premium)
                            <span class="badge bg-warning">Premium Content</span>
                            @endif
                        </div>
                        <div class="text-muted">
                            <small>
                                <i class="far fa-calendar me-1"></i> {{ $article->formatted_date }}
                            </small>
                        </div>
                    </div>

                    <h1 class="card-title fw-bold mb-3">{{ $article->title }}</h1>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="text-muted">
                            <i class="fas fa-eye me-1"></i> {{ $article->view_count }} views
                        </div>

                        <!-- Social Share -->
                        <div class="social-share">
                            <small class="me-2">Share:</small>
                            <a href="#" class="text-muted me-2">
                                <i class="fab fa-facebook"></i>
                            </a>
                            <a href="#" class="text-muted me-2">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="text-muted">
                                <i class="fab fa-linkedin"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Article Content -->
                    <div class="article-content mb-5">
                        {!! nl2br(e($article->content)) !!}
                    </div>

                    <!-- Tags -->
                    <div class="tags mb-4">
                        <strong class="me-2">Tags:</strong>
                        @foreach(explode(',', $article->category) as $tag)
                        <span class="badge bg-light text-dark me-1">{{ trim($tag) }}</span>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Comments Section (Optional) -->
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title mb-3">
                        <i class="fas fa-comments me-2"></i>Comments (0)
                    </h5>
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        Comments feature is coming soon!
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Membership Status -->
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="fas fa-user-crown me-2"></i>Your Membership
                    </h5>
                    <div class="mb-3">
                        <span class="badge bg-primary">{{ auth()->user()->membership_name }} Member</span>
                    </div>
                    <p class="card-text small">
                        You're currently reading as a {{ strtolower(auth()->user()->membership_name) }} member.
                        @if(auth()->user()->membership_type != 'C')
                        <br>
                        <a href="{{ route('dashboard') }}#upgrade" class="text-primary">Upgrade your membership</a> for unlimited access.
                        @endif
                    </p>
                </div>
            </div>

            <!-- Related Articles -->
            @if($relatedArticles->count() > 0)
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title mb-3">
                        <i class="fas fa-link me-2"></i>Related Articles
                    </h5>
                    @foreach($relatedArticles as $related)
                    <div class="related-article mb-3 pb-3 border-bottom">
                        <h6 class="mb-1">
                            <a href="/articles/{{ $related->slug ?? $related->id }}" class="text-decoration-none">
                                {{ $related->title }}
                            </a>
                        </h6>
                        <div class="d-flex justify-content-between">
                            <small class="text-muted">{{ $related->category }}</small>
                            <small class="text-muted">
                                <i class="fas fa-eye me-1"></i> {{ $related->view_count }}
                            </small>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Popular Articles (Static for now) -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-3">
                        <i class="fas fa-fire me-2"></i>Popular Articles
                    </h5>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="#" class="text-decoration-none">
                                <i class="fas fa-chevron-right text-primary me-2"></i>
                                Getting Started with Laravel
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="#" class="text-decoration-none">
                                <i class="fas fa-chevron-right text-primary me-2"></i>
                                JavaScript ES6+ Features
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="#" class="text-decoration-none">
                                <i class="fas fa-chevron-right text-primary me-2"></i>
                                Database Design Basics
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="#" class="text-decoration-none">
                                <i class="fas fa-chevron-right text-primary me-2"></i>
                                REST API Best Practices
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .article-content {
        line-height: 1.8;
        font-size: 1.1rem;
    }

    .article-content p {
        margin-bottom: 1.5rem;
    }

    .related-article:hover {
        background-color: #f8f9fa;
        padding-left: 10px;
        margin-left: -10px;
        border-radius: 5px;
        transition: all 0.3s;
    }
</style>
@endsection