<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'category',
        'view_count',
        'is_premium'
    ];

    protected $casts = [
        'is_premium' => 'boolean'
    ];

    /**
     * Scope untuk filter artikel berdasarkan membership user
     */
    public function scopeForMembership(Builder $query, $user)
    {
        $membershipType = $user->membership_type ?? 'A';
        
        if ($membershipType === 'A') {
            // Basic: hanya artikel non-premium
            return $query->where('is_premium', false);
        }
        elseif ($membershipType === 'B') {
            // Standard: non-premium + beberapa premium tertentu
            return $query->where(function ($q) {
                $q->where('is_premium', false)
                  ->orWhereIn('category', ['JavaScript', 'Database', 'API']);
            });
        }
        else {
            // Premium: semua artikel
            return $query;
        }
    }

    /**
     * Accessor untuk membership_name
     */
    public function getMembershipNameAttribute()
    {
        return $this->is_premium ? 'Premium' : 'Free';
    }
}