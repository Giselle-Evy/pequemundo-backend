<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'child_profile_id',
        'store_item_id',
        'purchased_at',
    ];

    protected $casts = [
        'purchased_at' => 'datetime',
    ];

    public function childProfile()
    {
        return $this->belongsTo(ChildProfile::class);
    }

    public function storeItem()
    {
        return $this->belongsTo(StoreItem::class);
    }
}