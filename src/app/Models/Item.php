<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'condition_id',
        'name',
        'price',
        'description',
        'item_img'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function conditions()
    {
        return $this->belongsTo(Condition::class);
    }

    public function category_items()
    {
        return $this->belongsToMany(Category::class, 'category_items', 'item_id','category_id');
    }

    public function favorites()
    {
        return $this->belongsToMany(User::class, 'favorites', 'item_id', 'user_id');
    }

    public function comment()
    {
        return $this->hasMany(Comment::class);
    }

    public function sold_items()
    {
        return $this->hasMany(SoldItem::class);
    }
}
