<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'membership_type',
        'membership_name',
        'avatar',
        'social_id',
        'social_type'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Accessor untuk access limits
     */
    public function getAccessLimitAttribute()
    {
        $limits = [
            'A' => ['articles' => 3, 'videos' => 3],
            'B' => ['articles' => 10, 'videos' => 10],
            'C' => ['articles' => 999, 'videos' => 999] // unlimited
        ];
        
        return $limits[$this->membership_type] ?? $limits['A'];
    }

    /**
     * Accessor untuk membership name jika belum ada
     */
    public function getMembershipNameAttribute($value)
    {
        if ($value) return $value;
        
        $names = [
            'A' => 'Basic',
            'B' => 'Standard',
            'C' => 'Premium'
        ];
        
        return $names[$this->membership_type] ?? 'Basic';
    }
}