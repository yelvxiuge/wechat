<?php


namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use EasyWeChat\Foundation\Application;

class SiteController extends Controller
{
//    public  $weconf11ig = [
//            'app_id'  => Yii::$app->params['appid'],         // AppID
//            'secret'  =>  Yii::$app->params['secret'],    // AppSecret
//            'token'   => Yii::$app->params['token']          // Token
//    ];
    public  $weconf11ig = [
        'appid'     =>'wxb84db8bb472503ed',
        'appsecret' =>'d4624c36b6795d1d99dcf0547af5443d',
        'token'     =>'Asdsd',
    ];



    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function  actionUserInfo(){

        $this->weconf11ig = [
            // ...
            'oauth' => [
                'scopes'   => ['snsapi_userinfo'],
                'callback' => '/test.php',
            ],
            // ..
        ];

        $app = new Application($this->weconf11ig);
        $oauth = $app->oauth;
        if (empty($_SESSION['wechat_user'])) {
            $_SESSION['target_url'] = '/test.php';
            return $oauth->redirect();
            // 这里不一定是return，如果你的框架action不是返回内容的话你就得使用
            // $oauth->redirect()->send();
        }
        // 已经登录过
        $user = $_SESSION['wechat_user'];

        print "this is zhengchang ";


    }




}