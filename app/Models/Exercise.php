<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject_id',
        'title',
        'question',
        'correct_answer',
        'instructions',
        'type',
        'difficulty',
        'image_url',
        'points_reward',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function options()
    {
        return $this->hasMany(Option::class);
    }

    public function pairs()
    {
        return $this->hasMany(ExercisePair::class)->orderBy('order');
    }

    public function progress()
    {
        return $this->hasMany(Progress::class);
    }
}