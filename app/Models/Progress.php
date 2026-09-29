<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    use HasFactory;

    protected $table = 'progress';

    protected $fillable = [
        'child_profile_id',
        'exercise_id',
        'completed',
        'score',
    ];

    protected $casts = [
        'completed' => 'boolean',
    ];

    public function childProfile()
    {
        return $this->belongsTo(ChildProfile::class);
    }

    public function exercise()
    {
        return $this->belongsTo(Exercise::class);
    }
}