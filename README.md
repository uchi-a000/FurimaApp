<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

# フリマアプリ
商品の出品や購入、お気に入り追加や商品の詳細も確認できます。（管理画面あり）



## 作成した目的
php・laravelを学習中で練習のために作成しました。

## 機能一覧
ユーザ会員登録 ログイン ログアウト  
商品一覧取得  
商品詳細取得  
商品お気に入り一覧取得  
ユーザー情報取得  
ユーザー購入商品一覧取得  
ユーザ出品商品一覧取得  
プロフィール変更  
商品お気に入り追加  
商品お気に入り削除  
商品コメント追加  
商品コメント削除  
出品  
商品検索  

## 使用技術（実行環境）
・PHP 8.0
・laravel 10.0
・MySQL  8.0
・Mailhog(テストメール)



## テーブル設計


## ER 図





## 環境構築
1.  docker-compose up -d --build （docker-composeビルド&起動）
2.  docker-compose exe php bash （PHPコンテナ内にログイン）
3.  composer install （パッケージインストール）
4.  cp .env.example .env （.envファイルの作成(ファイルから.env を作成し、環境変数を変更)）
5.  php artisan key:generate (アプリケーションを実行)
6.  php artisan migrate（マイグレーション）
7.  php artisan db:seed（シーディング）
8. メール認証  
    brew install mailhog (mailhogインストール)  
    .env ファイルと docker-compose.yml にテストメール（mailhog）の内容記述  
    docker-compose up --build -d  
9. 管理画面  
    composer require spatie/laravel-permission（Spatie Laravel Permissionパッケージインストール）  
    php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"（設定ファイルを生成）  
    php artisan migrate  
10. 画像ストレージ保存  
    php artisan storage:link（ストレージに保存した画像を表示）
11. stripe決済  
    composer require stripe/stripe-php （Stripeパッケージのインストール）  
    .env ファイルとconfig/services.phpにStripeのAPIキー（公開キーと秘密キー）を設定

## 管理者情報
メールアドレス：admin@example.com  
パスワード：pppp0000

## その他機能（詳細）
・【配送先変更機能】商品の配送先を変更することができる  
・【商品購入機能】Stripeを利用して決済をすることができる(クレジットカードのみ)  
・【レスポンシブデザイン】タブレット・スマートフォン用のレスポンシブデザインを作成  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ブレイクポイントは768px  
・【管理画面】管理者と店舗代表者と利用者の3つの権限を作成（左上モーダルメニューで各権限のメニューを表示）  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;店舗代表者が店舗情報の作成、更新と予約情報の確認ができる管理画面を作成（予約情報の確認は登録後にできる）  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;管理者側は店舗代表者を作成、店舗代表者一覧を確認でき、お知らせメールを送れる管理画面を作成  
・【ストレージ】お店の画像をストレージに保存することができる  
・【認証】メールによって本人確認を行うことができる（管理者・店舗代表者除く）  
・【メール送信】管理者からユーザーへお知らせメールを送信できる  

## URL
・開発環境：http://localhost/  
・phpMyAdmin:：http://localhost:8080/  
・Mailhog：http://localhost:8025/

