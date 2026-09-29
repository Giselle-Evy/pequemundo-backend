<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'badge_icon',
    ];

    public function childProfiles()
    {
        return $this->belongsToMany(ChildProfile::class);
    }
}