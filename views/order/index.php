<?php
/**
 * Created by PhpStorm.
 * User: redmenote
 * Date: 11.02.16
 * Time: 11:51
 */

use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = 'Мои заказы';
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="content col-md-12">
        <?php foreach ($tours as $tour): ?>


            <div class="col-sm-4 col-md-4">
                <div class="thumbnail">
                    <?= $this->render('_tour', [
                        'tour' => $tour,
                    ]) ?>
                    <div class="pagination-center nav-submit">
                        <?= //Html::a('Подробнее', [$url], ['class'=>'btn btn-primary '])
                            '<a href="'.$url = Yii::$app->urlManager->createUrl(['tour/more', 'id' => $tour->id]).'"'.' class='.'"btn btn-primary"'.'>Подробнее</a>';
                        ?>
                    </div>

                </div>
            </div>

        <?php endforeach; ?>
    </div>

<div class='pagination-center col-md-12'>
    <?= LinkPager::widget(['pagination' => $pagination]) ?>
</div>