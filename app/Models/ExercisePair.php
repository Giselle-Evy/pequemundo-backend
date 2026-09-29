<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExercisePair extends Model
{
    use HasFactory;

    protected $fillable = [
        'exercise_id',
        'left_text',
        'right_text',
        'order',
    ];

    public function exercise()
    {
        return $this->belongsTo(Exercise::class);
    }
}