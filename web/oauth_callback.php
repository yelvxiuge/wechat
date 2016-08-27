<?php
//require '../vendor/autoload.php';
//
//use EasyWeChat\Foundation\Application;
//
//session_start();
//$config = [
//        // ...
//        'debug'  => true,
//        'app_id'     =>'wxb84db8bb472503ed',
//        'appsecret' =>'d4624c36b6795d1d99dcf0547af5443d',
//        'token'     =>'Asdsd',
//        'oauth' => [
//            'scopes'   => ['snsapi_userinfo'],
//            'callback' => '/oauth_callback.php',
//        ],
//
//    'log' => [
//        'level' => 'debug',
//        'file'  => '/tmp/easywechat.log', // XXX: 绝对路径！！！！
//    ],
//
//
//        // ..
//    ];
//    // ...
//$app = new Application($config);
//$oauth = $app->oauth;
//
//// 获取 OAuth 授权结果用户信息
//$user = $oauth->user();
function getUser()
{

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://api.weixin.qq.com/sns/oauth2/access_token?appid=wxb84db8bb472503ed&secret=d4624c36b6795d1d99dcf0547af5443d&code=' . $_GET['code'] . '&grant_type=authorization_code');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $output = curl_exec($ch);
    curl_close($ch);
    $output_array = json_decode($output, true);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://api.weixin.qq.com/sns/userinfo?access_token=' . $output_array['access_token'] . '&openid=' . $output_array['openid'] . '&lang=zh_CN');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $output = curl_exec($ch);
    curl_close($ch);

    print $output;

}




$_SESSION['wechat_user'] = $user->toArray();
$targetUrl = empty($_SESSION['target_url']) ? '/' : $_SESSION['target_url'];
header('location:'. $targetUrl);
