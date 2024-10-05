<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];


    public function category_items()
    {
        return $this->belongsToMany(Item::class, 'category_items', 'category_id', 'item_id');
    }
}
