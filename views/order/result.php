<?php
/**
 * Created by PhpStorm.
 * User: redrice
 * Date: 15.02.16
 * Time: 23:19
 */

use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = 'Результат поиска';
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['breadcrumbs'][] = ['label' => 'Поиск', 'url' => ['search']];
?>
    <div class="content col-md-12">
        <?php foreach ($orders as $order): ?>


            <div class="col-sm-4 col-md-4">
                <div class="thumbnail">
                    <?= $this->render('_order', [
                        'order' => $order,
                    ]) ?>

                </div>
            </div>

        <?php endforeach; ?>
    </div>
    <div class='pagination-center col-md-12'>
        <?= LinkPager::widget(['pagination' => $pagination]) ?>
    </div>
