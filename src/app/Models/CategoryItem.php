<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'item_id'
    ];

    public function categories()
    {
        return $this->belongsTo(Category::class);
    }

    public function items()
    {
        return $this->belongsTo(Item::class);
    }
}
