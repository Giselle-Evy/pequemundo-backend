<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'age',
        'avatar',
        'total_points',
        'equipped_avatar_id',
        'equipped_accessory_id',
        'equipped_accessory_id_2',
        'equipped_frame_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function progress()
    {
        return $this->hasMany(Progress::class);
    }

    public function achievements()
    {
        return $this->belongsToMany(Achievement::class);
    }

    public function storeItems()
    {
        return $this->belongsToMany(StoreItem::class, 'child_items')
            ->withPivot('purchased_at')
            ->withTimestamps();
    }

    public function equippedAvatar()
    {
        return $this->belongsTo(StoreItem::class, 'equipped_avatar_id');
    }

    public function equippedAccessory()
    {
        return $this->belongsTo(StoreItem::class, 'equipped_accessory_id');
    }

    public function equippedAccessory2()
    {
        return $this->belongsTo(StoreItem::class, 'equipped_accessory_id_2');
    }

    public function equippedFrame()
    {
        return $this->belongsTo(StoreItem::class, 'equipped_frame_id');
    }
}