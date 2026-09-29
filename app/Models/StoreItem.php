<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'icon',
        'price',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function childProfiles()
    {
        return $this->belongsToMany(ChildProfile::class, 'child_items')
            ->withPivot('purchased_at')
            ->withTimestamps();
    }
}