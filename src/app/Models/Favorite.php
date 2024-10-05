<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'item_id'
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->belongsTo(Item::class);
    }
}
