<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\RegForm;
use app\models\ContactForm;
use app\models\AuthVk;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

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


    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    //my code


    public function actionReg()
    {
        $model = new RegForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate())
        {
            $user = $model->reg();
            if ($user)
                if (Yii::$app->getUser()->login($user))
                    return $this->goHome();
            else {
                Yii::$app->session->setFlash('error', 'Ошибка при регистрации');
                Yii::error('Ошибка при регистрации');
                return $this->refresh();
            }
        }

        return $this->render(
            'reg',
            [
                'model' => $model
            ]
        );
    }

    public function actionLogin()
    {
        $model = new LoginForm();

        if (!Yii::$app->user->isGuest)
            return $this->goHome();

        if ($model->load(Yii::$app->request->post()) && $model->login())
            return $this->goBack();

        return $this->render(
            'login',
            [
                'model' => $model
            ]
        );
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionAuthvk($code)
    {
        $vk = new AuthVk();

        if (!$vk->load(Yii::$app->request->isGet)){

            $param = $vk->getToken($code);
            $model = $vk->getUser($param);

            return $this->render(
                'test',
                [
                    'model' => $model
                ]
            );
        }

    }
}
