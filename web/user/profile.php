<?php

require '../../vendor/autoload.php';


use EasyWeChat\Foundation\Application;

$config = [
    // ...
    'appid'     =>'wxb84db8bb472503ed',
    'appsecret' =>'d4624c36b6795d1d99dcf0547af5443d',
    'token'     =>'Asdsd',
    'oauth' => [
        'scopes'   => ['snsapi_userinfo'],
        'callback' => '/oauth_callback.php',
    ],
    // ..
];

$app = new Application($config);
$oauth = $app->oauth;

if (empty($_SESSION['wechat_user'])) {
    $_SESSION['target_url'] = 'user/profile.php';
    return $oauth->redirect()->send();
    // 这里不一定是return，如果你的框架action不是返回内容的话你就得使用
    // $oauth->redirect()->send();
}
// 已经登录过
$user = $_SESSION['wechat_user'];

print $_SESSION;
