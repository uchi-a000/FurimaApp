<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            "レディース",
            "メンズ",
            "洋服",
            "靴",
            "アクセサリー",
            "小物",
            "ゲーム",
            "おもちゃ",
            "楽器",
            "アート",
            "チケット",
            "本",
            "雑誌",
            "漫画",
            "CD",
            "DVD",
            "ブルーレイ",
            "スマホ",
            "タブレット",
            "パソコン",
            "テレビ",
            "オーディオ",
            "カメラ",
            "生活家電",
            "スポーツ",
            "アウトドア",
            "釣り",
            "旅行用品",
            "コスメ",
            "美容",
            "ダイエット",
            "健康",
            "食品",
            "飲料",
            "酒",
            "キッチン",
            "日用品",
            "その他",
            "家具",
            "インテリア",
            "ペット用品",
            "フラワー",
            "ガーデニング",
            "ハンドメイド",
            "手芸",
            "車",
            "バイク",
            "自転車"
        ];

        foreach ($names as $name) {
            DB::table('categories')->insert([
                'name' => $name,
            ]);
        }
    }
}
