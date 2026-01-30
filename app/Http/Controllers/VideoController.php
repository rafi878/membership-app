<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VideoController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Get accessible videos
        $videos = Video::forMembership($user)
                      ->latest()
                      ->paginate(9);
        
        // Calculate video count and limits
        $videoCount = Video::forMembership($user)->count();
        
        // Get limits based on membership
        $videoLimit = $this->getVideoLimit($user->membership_type);
        
        // Calculate usage percentage
        $videoUsage = $videoLimit == 999 ? 0 : 
                     min(100, ($videoCount / $videoLimit) * 100);

        return view('videos.index', compact(
            'videos', 
            'videoCount', 
            'videoLimit', 
            'videoUsage'
        ));
    }

    public function show($id)
    {
        $video = Video::findOrFail($id);
        $user = Auth::user();
        
        // Check access
        if ($video->is_premium && $user->membership_type === 'A') {
            return redirect()->route('videos.index')
                           ->with('error', 'Premium video requires higher membership level.');
        }
        
        // Increment view
        $video->increment('view_count');
        
        return view('videos.show', compact('video'));
    }
    
    /**
     * Get video access limit based on membership type
     */
    private function getVideoLimit($membershipType)
    {
        $limits = [
            'A' => 3,   // Basic: 3 videos
            'B' => 10,  // Standard: 10 videos
            'C' => 999  // Premium: unlimited
        ];
        
        return $limits[$membershipType] ?? $limits['A'];
    }
}