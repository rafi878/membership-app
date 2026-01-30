<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'url', 
        'description',
        'duration_seconds',
        'view_count',
        'is_premium'
    ];

    protected $casts = [
        'is_premium' => 'boolean'
    ];

    /**
     * Scope untuk filter video berdasarkan membership
     */
    public function scopeForMembership(Builder $query, $user)
    {
        $membershipType = $user->membership_type ?? 'A';
        
        if ($membershipType === 'A') {
            return $query->where('is_premium', false);
        }
        elseif ($membershipType === 'B') {
            return $query->where(function ($q) {
                $q->where('is_premium', false)
                  ->orWhere('id', '<=', 5); // contoh: video id 1-5
            });
        }
        else {
            return $query;
        }
    }

    /**
     * Accessor untuk format durasi
     */
    public function getDurationFormattedAttribute()
    {
        if (!$this->duration_seconds) return '0:00';
        
        $hours = floor($this->duration_seconds / 3600);
        $minutes = floor(($this->duration_seconds % 3600) / 60);
        $seconds = $this->duration_seconds % 60;
        
        if ($hours > 0) {
            return sprintf('%d:%02d:%02d', $hours, $minutes, $seconds);
        }
        return sprintf('%d:%02d', $minutes, $seconds);
    }
}