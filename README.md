## ダウンロード方法

git clone
git clone https://github.com/KUDO-1118/laravel_udemy_multiLogin.git

### git clone ブランチを指定してダウンロードする場合
git clone -b ブランチ名 https://github.com/KUDO-1118/laravel_udemy_multiLogin.git
※もしくはzipファイルでダウンロード

## インストール方法

- cd laravel_udemy_multiLogin (作業するファイル)
- composer install
- npm install
- npm run dev
- .env.example をコピーして .envファイルを作成
  （.envファイルの中の下記をご利用の環境に合わせて変更する）
- データベース情報を.envファイルに記載
  DB_CONNECTION=mysql
  DB_HOST=127.0.0.1
  DB_PORT=3306
  DB_DATABASE=laravel_umarche
  DB_USERNAME=umarche
  DB_PASSWORD=password123
- php artisan migrate:fresh --seed
  (開発環境でDBを起動した後)
- php artisan key:generate

## インストール後の実施事項

画像のダミーデータは public/imagesフォルダ内に sample1.jpg 〜 sample6.jpg として 保存しています。

php artisan storage:link で storageフォルダにリンク後、

storage/app/public/productsフォルダ内に 保存すると表示されます。 (productsフォルダがない場合は作成してください。)

ショップの画像も表示する場合は、 storage/app/public/shopsフォルダを作成し 画像を保存してください。


### リソースコントローラの作成
```
  $ php artisan make:controller Admin/OwnersController --resource
```


### Seed(ダミーデータ)作成
```
  $ php artisan make:seeder AdminSeeder
  $ php artisan make:seeder OwnerSeeder
```
  database/seeders 直下に生成
  - シーダー(ダミーデータ)手動設定
    ```
      DB::tables(‘owners’)->insert([
　　    [ ‘name’ => ‘test1’, ‘email’ => ‘test1@test.com’,
　　    Hash::make(‘password123’)]
      ]);
    ```
   DatabaseSeeder.php内で読み込み設定
   ```
    $this->call([
      AdminSeeder, OwnerSeeder
    ]);
   ```

  - テーブル再作成&ダミー追加
    ```
      $ php artisan migrate:refresh ̶seed
    ```
    down()を実行後up()を実行

    ```
      $ php artisan migrate:fresh ̶seed
    ```
    全テーブル削除してup()を実行

### Seed(画像のダミーデータ)作成
画像のダミーデータは
public/imagesフォルダ内に
sample1.jpg ~ sample6.jpg として保存。

php artisan storage:link
storageフォルダにリンク後、

storage/app/public/productsフォルダ内に保存すると表示する
(productsフォルダがない場合は作成)

ショップの画像も表示する場合は、
storage/app/public/shopsフォルダを作成し
画像を保存してください

### Carbon
  PHPのDateTimeクラスを拡張した
  日付ライブラリ
  Laravelに標準搭載

  公式サイト
    https://carbon.nesbot.com/
