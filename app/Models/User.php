<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Billable;

    public const FREE_EXERCISES_LIMIT = 3;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'free_exercises_used',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function childProfiles()
    {
        return $this->hasMany(ChildProfile::class);
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
}