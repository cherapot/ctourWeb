<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;


AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<header class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Туры по Крыму',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);

    /*
    $form = ActiveForm::begin();
        $form->field($model, 'site')->textInput(['value' => 'Search']);
    ActiveForm::end();
    */

    echo
    '<form class="navbar-form navbar-right" action="/ctour/web/index.php/tour/search" method="get">
            <input type="search" class="form-control" placeholder="Поиск..." name="public_search" maxlength="50">

    </form>';


    if(Yii::$app->user->isGuest)
    {
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => [
                ['label' => 'Главная', 'url' => ['/site/index']],
                //['label' => 'О сайте', 'url' => ['/site/about']],
                //['label' => 'Контакты', 'url' => ['/site/contact']],
                ['label' => 'Туры', 'url' => ['/tour']],
                ['label' => 'Войти', 'url' => ['/site/login']],
            ],
        ]);
    }
    else {
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => [
                ['label' => 'Главная', 'url' => ['/site/index']],
                //['label' => 'О сайте', 'url' => ['/site/about']],
                //['label' => 'Контакты', 'url' => ['/site/contact']],
                (Yii::$app->user->identity->status == 0)?
                    [
                        'label' => 'Все туры', 'url' => ['/tour'],
                    ] :
                    [
                        'label' => 'Туры', 'items' => [
                            ['label' => 'Все туры', 'url' => ['/tour']],
                            ['label' => 'Мои туры', 'url' => ['/tour/my']],
                            ['label' => 'Добавить тур', 'url' => ['/tour/add']],
                        ]
                    ],
                (Yii::$app->user->identity->status == 0)?
                    [
                        'label' => 'Заказы', 'url' => ['/order'],
                    ] :
                    [
                        'label' => 'Заказы', 'items' => [
                        ['label' => 'Все заказы', 'url' => ['/order/all']],
                        ['label' => 'Новые заказы', 'url' => ['/order/new']],
                        ['label' => 'Принятые заказы', 'url' => ['/order/complete']],
                    ]
                    ],
                [
                    'label' => 'Выйти (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ],


            ],
        ]);
    }
    NavBar::end();
    ?>


</header>

<section class="container main-section">
    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>
    <?= $content ?>
</section>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
