<?php
require '../vendor/autoload.php';

use EasyWeChat\Foundation\Application;

session_start();
$config = [
        // ...
        'debug'  => true,
        'app_id'     =>'wxb84db8bb472503ed',
        'appsecret' =>'d4624c36b6795d1d99dcf0547af5443d',
        'token'     =>'Asdsd',
        'oauth' => [
            'scopes'   => ['snsapi_userinfo'],
            'callback' => '/oauth_callback.php',
        ],

    'log' => [
        'level' => 'debug',
        'file'  => '/tmp/easywechat.log', // XXX: 绝对路径！！！！
    ],


        // ..
    ];
    // ...
$app = new Application($config);
$oauth = $app->oauth;
// 获取 OAuth 授权结果用户信息
$user = $oauth->user();

file_put_contents('test.txt',$user->toArray());
print_r($user);

$_SESSION['wechat_user'] = $user->toArray();
$targetUrl = empty($_SESSION['target_url']) ? '/' : $_SESSION['target_url'];
header('location:'. $targetUrl);
