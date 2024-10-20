<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
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

    public function condition()
    {
        return $this->belongsTo(Condition::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_item');
    }

    public function comment()
    {
        return $this->hasMany(Comment::class);
    }

    public function sold_items()
    {
        return $this->hasMany(SoldItem::class);
    }

    public function favorites()
    {
        return $this->belongsToMany(User::class, 'favorites');
    }


    public static function conditionFormat($conditions)
    {
        $result = "";
        foreach ($conditions as $index => $condition) {
            if ($index == 0) {
                $result =  $condition;
            } else {
                $result =  $result . "・" . $condition;
            }
        }
        return $result;
    }

    public static function searchItems($keyword)
    {
        $query = Item::query();
        $conditions = array();

        if (!empty($keyword)) {
            array_push($conditions, $keyword);
            $query->where('name', 'like', "%$keyword%");
        }

        $items = $query->get();
        $text = self::conditionFormat($conditions);

        return compact('items', 'text');
    }

}
