## インストール方法

## インストール後の実施事項


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




### Carbon
  PHPのDateTimeクラスを拡張した
  日付ライブラリ
  Laravelに標準搭載

  公式サイト
    https://carbon.nesbot.com/
