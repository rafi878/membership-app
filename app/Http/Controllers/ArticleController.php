<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Get accessible articles
        $articles = Article::forMembership($user)->paginate(10);
        
        // Calculate usage statistics
        $articleCount = Article::forMembership($user)->count();
        $articleLimit = $this->getArticleLimit($user->membership_type);
        $articleUsage = $articleLimit == 999 ? 0 : 
                       min(100, ($articleCount / $articleLimit) * 100);

        return view('articles.index', compact(
            'articles', 
            'articleCount', 
            'articleLimit', 
            'articleUsage'
        ));
    }

    public function show($id)
    {
        $article = Article::findOrFail($id);
        
        // Check access
        if ($article->is_premium && Auth::user()->membership_type === 'A') {
            return redirect()->route('articles.index')
                           ->with('error', 'Premium article requires higher membership level.');
        }
        
        // Increment view count if column exists
        if (Schema::hasColumn('articles', 'view_count')) {
            $article->increment('view_count');
        }
        
        return view('articles.show', compact('article'));
    }
    
    /**
     * Get article access limit based on membership type
     */
    private function getArticleLimit($membershipType)
    {
        $limits = [
            'A' => 3,   // Basic: 3 articles
            'B' => 10,  // Standard: 10 articles
            'C' => 999  // Premium: unlimited
        ];
        
        return $limits[$membershipType] ?? $limits['A'];
    }
}