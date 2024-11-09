<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LifeCycleTestController extends Controller
{
    public function showServiceProviderTest()
    {
        $encrypt = app()->make('encrypter');
        $password = $encrypt->encrypt('password');

        $sample = app()->make('serviceProviderTest');

        dd($sample, $password, $encrypt->decrypt($password));
    }

    public function showServiceContainerTest()
    {
        // サービスコンテナに登録
        app()->bind('lifeCycleTest', function(){
            return 'ライフサイクルテスト';
        });
        // 引数（取り出す時の名前、機能）

        // サービスコンテナを取り出す
        $test = app()->make('lifeCycleTest');

        // サービスコンテナなしのパターン
        // $message = new Message();
        // $sample = new Sample($message);
        // $sample->run();

        // サービスコンテナapp()ありのパターン
        app()->bind('sample', Sample::class);
        $sample = app()->make('sample');
        $sample->run();

        dd($test, app());
    }
}

class Sample
{
    public $message;
    public function __construct(Message $message)
    // __construct(Message)とすると自動でインスタンス化してくれる
    {
        $this->message = $message;
    }

    public function run(){
        $this->message->send();

    }
}

class Message
{
    public function send(){
        echo('メッセージ表示');
    }
}
