@extends('layouts.app')

@section('title', 'Articles - Membership App')

@section('content')
<div class="container py-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col">
            <h1 class="fw-bold"><i class="fas fa-newspaper me-2"></i>Articles</h1>
            <p class="text-muted">Browse all available articles based on your membership level</p>

            <!-- Membership Info -->
            <div class="alert alert-info">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-info-circle me-2"></i>
                        You can access
                        @if($articleLimit == 999)
                        <strong>unlimited</strong> articles
                        @else
                        up to <strong>{{ $articleLimit }}</strong> articles
                        @endif
                        with your current membership.
                    </div>
                    <div>
                        Showing <strong>{{ $articleCount }}</strong> articles
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Articles Grid -->
    @if($articles->count() > 0)
    <div class="row">
        @foreach($articles as $article)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100 article-card">
                @if($article->image)
                <img src="{{ $article->image }}" class="card-img-top" alt="{{ $article->title }}" style="height: 200px; object-fit: cover;">
                @else
                <div class="card-img-top bg-secondary d-flex align-items-center justify-content-center" style="height: 200px;">
                    <i class="fas fa-newspaper fa-3x text-white"></i>
                </div>
                @endif

                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <span class="badge bg-primary">{{ $article->category }}</span>
                        @if($article->is_premium)
                        <span class="badge bg-warning">Premium</span>
                        @endif
                    </div>

                    <h5 class="card-title">{{ $article->title }}</h5>
                    <p class="card-text text-muted small">{{ $article->excerpt }}</p>

                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <small class="text-muted">
                            <i class="fas fa-eye me-1"></i> {{ $article->view_count }} views
                        </small>
                        <a href="/articles/{{ $article->slug ?? $article->id }}" class="btn btn-sm btn-outline-primary">
                            Read Article <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>

                <div class="card-footer bg-transparent">
                    <small class="text-muted">
                        <i class="far fa-calendar me-1"></i> {{ $article->formatted_date }}
                    </small>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    @if($articles->hasPages())
    <div class="row mt-4">
        <div class="col">
            <nav aria-label="Article navigation">
                <ul class="pagination justify-content-center">
                    {{ $articles->links() }}
                </ul>
            </nav>
        </div>
    </div>
    @endif

    @else
    <div class="text-center py-5">
        <div class="mb-4">
            <i class="fas fa-newspaper fa-4x text-muted"></i>
        </div>
        <h4 class="text-muted">No articles available</h4>
        <p class="text-muted">There are no articles available for your current membership level.</p>
        <a href="{{ route('dashboard') }}" class="btn btn-primary">
            <i class="fas fa-arrow-left me-2"></i> Back to Dashboard
        </a>
    </div>
    @endif
</div>

<style>
    .article-card {
        transition: transform 0.3s, box-shadow 0.3s;
        border: none;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .article-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
    }
</style>
@endsection