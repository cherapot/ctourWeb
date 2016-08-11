<?php
/**
 * Created by PhpStorm.
 * User: redmenote
 * Date: 07.02.16
 * Time: 23:37
 */

use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = 'Новые заказы';
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['breadcrumbs'][] = ['label' => 'Поиск', 'url' => ['search']];
?>
    <div class="content col-md-12">
        <?php foreach ($orders as $order): ?>


            <div class="col-sm-4 col-md-4">
                <div class="thumbnail order">
                    <?= $this->render('_order', [
                        'order' => $order,
                    ]) ?>
                    <div class="pagination-center nav-submit">
                        <?= //Html::a('Подробнее', [$url], ['class'=>'btn btn-primary '])
                        '<a href="'.$url = Yii::$app->urlManager->createUrl(['order/confirm', 'id' => $order->id]).'"'.' class='.'"btn btn-primary"'.'>Подтвердить</a>';
                        ?>
                    </div>
                </div>

            </div>

        <?php endforeach; ?>
    </div>


<div class='pagination-center col-md-12'>
    <?= LinkPager::widget(['pagination' => $pagination]) ?>
</div>