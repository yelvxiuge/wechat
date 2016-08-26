<?php

use EasyWeChat\Foundation\Application;
$config = [
    // ...
];
$app = new Application($config);
$oauth = $app->oauth;
// 获取 OAuth 授权结果用户信息
$user = $oauth->user();

file_put_contents(test.txt,$user->toArray());

$_SESSION['wechat_user'] = $user->toArray();
$targetUrl = empty($_SESSION['target_url']) ? '/' : $_SESSION['target_url'];
header('location:'. $targetUrl);
