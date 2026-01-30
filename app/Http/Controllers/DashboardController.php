<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Video;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = \Illuminate\Support\Facades\Auth::user();
        
        // Tentukan limit berdasarkan membership
        $limits = $this->getAccessLimits($user->membership_type);
        
        // Get accessible articles
        $articles = Article::forMembership($user)
                          ->latest()
                          ->take(10) // Batasi jumlah yang ditampilkan
                          ->get();
        
        // Get accessible videos (jika ada model Video)
        $videos = collect([]);
        if (class_exists('App\Models\Video')) {
            $videos = Video::forMembership($user)
                          ->latest()
                          ->take(10)
                          ->get();
        }
        
        // Hitung usage (hitung yang benar-benar bisa diakses, bukan semua)
        $accessibleArticles = Article::forMembership($user)->get();
        $articleCount = min($accessibleArticles->count(), $limits['articles']);
        $articleUsage = $limits['articles'] === 999 ? 0 : 
                       min(100, ($articleCount / $limits['articles']) * 100);
        
        $videoCount = 0;
        if (class_exists('App\Models\Video')) {
            $accessibleVideos = Video::forMembership($user)->get();
            $videoCount = min($accessibleVideos->count(), $limits['videos']);
        }
        $videoUsage = $limits['videos'] === 999 ? 0 : 
                     min(100, ($videoCount / $limits['videos']) * 100);

        return view('dashboard.index', [
            'user' => $user,
            'articles' => $articles,
            'videos' => $videos,
            'articleLimit' => $limits['articles'],
            'videoLimit' => $limits['videos'],
            'articleUsage' => $articleUsage,
            'videoUsage' => $videoUsage,
            'articleCount' => $articleCount,
            'videoCount' => $videoCount
        ]);
    }

    /**
     * Get access limits based on membership type
     */
    private function getAccessLimits($membershipType)
    {
        $limits = [
            'A' => ['articles' => 3, 'videos' => 3],
            'B' => ['articles' => 10, 'videos' => 10],
            'C' => ['articles' => 999, 'videos' => 999] // unlimited
        ];
        
        return $limits[$membershipType] ?? $limits['A'];
    }

    public function upgradeMembership(Request $request)
    {
        $request->validate([
            'membership_type' => 'required|in:A,B,C'
        ]);

        $user = Auth::user();
        
        // Update membership type
        $user->membership_type = $request->membership_type;
        $user->membership_name = $this->getMembershipName($request->membership_type);
       

        return back()->with('success', 
            "Membership upgraded to {$user->membership_name} successfully!"
        );
    }
    
    /**
     * Get membership name from type
     */
    private function getMembershipName($type)
    {
        $names = [
            'A' => 'Basic',
            'B' => 'Standard', 
            'C' => 'Premium'
        ];
        
        return $names[$type] ?? 'Basic';
    }
}