<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;
use App\Models\Category;


class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $categories = Category::all();

        $items = [
            [
                'user_id' => 1,
                'condition_id' => 1,
                'item_name' => 'ビンテージレコード',
                'price' => ' 10000',
                'description' => '1970年代のロック音楽が楽しめるビンテージレコード。コレクター必見!',
                'item_img' => 'https://placehold.jp/150x150.png',
            ],

            [
                'user_id' => 2,
                'condition_id' => 3,
                'item_name' => 'デニムジャケット',
                'price' => ' 2000',
                'description' => 'クラシックなデザインのデニムジャケット。どんなコーデにも合うアイテムです。',
                'item_img' => 'https://placehold.jp/150x150.png',
            ],

            [
                'user_id' => 3,
                'condition_id' => 1,
                'item_name' => 'レディースハンドバッグ',
                'price' => ' 1000',
                'description' => 'シンプルで使いやすいレディースハンドバッグ。普段使いにぴったり！',
                'item_img' => 'https://placehold.jp/150x150.png',
            ],

            [
                'user_id' => 4,
                'condition_id' => 3,
                'item_name' => 'アンティーク風時計',
                'price' => ' 5000',
                'description' => 'おしゃれなアンティーク風の置時計。インテリアのアクセントにどうぞ。',
                'item_img' => 'https://placehold.jp/150x150.png',
            ],

            [
                'user_id' => 5,
                'condition_id' => 2,
                'item_name' => 'フィットネスバンド',
                'price' => ' 2000',
                'description' => '癒しの空間を演出するアロマディフューザー。リラックスタイムに最適！',
                'item_img' => 'https://placehold.jp/150x150.png',
            ],

            [
                'user_id' => 2,
                'condition_id' => 3,
                'item_name' => 'カジュアルスニーカー',
                'price' => ' 1400',
                'description' => '快適な履き心地のカジュアルスニーカー。毎日の散歩におすすめです。',
                'item_img' => 'https://placehold.jp/150x150.png',
            ],

            [
                'user_id' => 1,
                'condition_id' => 2,
                'item_name' => 'インテリアプランツ',
                'price' => ' 1000',
                'description' => 'お部屋を彩るインテリアプランツ。手間いらずで癒されます。',
                'item_img' => 'https://placehold.jp/150x150.png',
            ],

            [
                'user_id' => 2,
                'condition_id' => 3,
                'item_name' => 'スマホ用三脚',
                'price' => ' 900',
                'description' => 'スマホ撮影を便利にする三脚。旅行やイベントに最適！',
                'item_img' => 'https://placehold.jp/150x150.png',
            ],

            [
                'user_id' => 5,
                'condition_id' => 1,
                'item_name' => 'ミニマル財布',
                'price' => ' 2000',
                'description' => 'スマートに持ち歩けるミニマルな財布。収納力も抜群です。',
                'item_img' => 'https://placehold.jp/150x150.png',
            ],

            [
                'user_id' => 4,
                'condition_id' => 5,
                'item_name' => 'DIY工具セット',
                'price' => ' 500',
                'description' => '家庭で使えるDIY工具セット。初心者でも安心して使えます。',
                'item_img' => 'https://placehold.jp/150x150.png',
            ],

            [
                'user_id' => 2,
                'condition_id' => 1,
                'item_name' => 'キッチンエプロン',
                'price' => ' 1800',
                'description' => 'おしゃれなデザインのキッチンエプロン。料理を楽しむアイテムです。',
                'item_img' => 'https://placehold.jp/150x150.png',
            ],

            [
                'user_id' => 4,
                'condition_id' => 2,
                'item_name' => 'ヘアアイロン',
                'price' => ' 4500',
                'description' => 'サラサラヘアが簡単に作れるヘアアイロン。スタイリングが楽しくなります。',
                'item_img' => 'https://placehold.jp/150x150.png',
            ],

            [
                'user_id' => 5,
                'condition_id' => 1,
                'item_name' => 'ウォーターボトル',
                'price' => ' 1000',
                'description' => 'スタイリッシュなデザインのウォーターボトル。アウトドアにも最適！',
                'item_img' => 'https://placehold.jp/150x150.png',
            ],

            [
                'user_id' => 1,
                'condition_id' => 1,
                'item_name' => 'バスソルトセット',
                'price' => ' 1500',
                'description' => 'リラックスできるバスソルトセット。お風呂タイムを贅沢に！',
                'item_img' => 'https://placehold.jp/150x150.png',
            ],

            [
                'user_id' => 4,
                'condition_id' => 2,
                'item_name' => 'クラシック絵画プリント',
                'price' => ' 500',
                'description' => 'お部屋に華やかさを加えるクラシック絵画のプリント。インテリアに最適！',
                'item_img' => 'https://placehold.jp/150x150.png',
            ],

            [
                'user_id' => 3,
                'condition_id' => 1,
                'item_name' => 'スキンケアセット',
                'price' => ' 500',
                'description' => 'お肌に優しいスキンケアセット。毎日のケアが楽しみに！',
                'item_img' => 'https://placehold.jp/150x150.png',
            ],

            [
                'user_id' => 4,
                'condition_id' => 1,
                'item_name' => 'ペット用おもちゃ',
                'price' => ' 500',
                'description' => '可愛いペットのためのおもちゃ。遊びながらストレス解消！',
                'item_img' => 'https://placehold.jp/150x150.png',
            ],

            [
                'user_id' => 2,
                'condition_id' => 3,
                'item_name' => 'ノートパソコンスタンド',
                'price' => ' 1600',
                'description' => '作業効率を上げるノートパソコンスタンド。デスク周りがスッキリ！',
                'item_img' => 'https://placehold.jp/150x150.png',
            ],

            [
                'user_id' => 4,
                'condition_id' => 1,
                'item_name' => '旅行用ポーチ',
                'price' => ' 500',
                'description' => '旅行に便利な収納ポーチ。小物を整理整頓できるアイテムです。',
                'item_img' => 'https://placehold.jp/150x150.png',
            ],


        ];

        foreach ($items as $item) {
            $createdItem = Item::create($item);
            $createdItem->categories()->attach($categories->random(rand(1,3))->pluck('id')->toArray());
        }

    }
}
