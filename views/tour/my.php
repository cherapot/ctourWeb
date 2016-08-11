<?php
/**
 * Created by PhpStorm.
 * User: redmenote
 * Date: 07.01.16
 * Time: 19:13
 */

use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = 'Мои туры';
$this->params['breadcrumbs'][] = ['label' => 'Туры', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


    <div class="content col-md-12">
        <?php foreach ($tours as $tour): ?>

             <div class="col-sm-4 col-md-4">
                    <div class="thumbnail tour-container">
                        <?= $this->render('_tour', [
                			'tour' => $tour,
           				]) ?>
                            <div class="pagination-center nav-submit">
                                <div class="btn-group btn-group-sm" role="group" aria-label="...">
                                <?= //Html::a('Подробнее', [$url], ['class'=>'btn btn-primary '])
                                '<a href="'.$url = Yii::$app->urlManager->createUrl(['tour/more', 'id' => $tour->id]).'"'.' class='.'"btn btn-primary"'.'>Подробнее</a>';
                                ?>
                                <?= //Html::a('Подробнее', [$url], ['class'=>'btn btn-primary '])
                                '<a href="'.$url = Yii::$app->urlManager->createUrl(['tour/delete', 'id' => $tour->id]).'"'.' class='.'"btn btn-primary"'.'>Удалить</a>';
                                ?>
                                <?= //Html::a('Подробнее', [$url], ['class'=>'btn btn-primary '])
                                '<a href="'.$url = Yii::$app->urlManager->createUrl(['tour/update', 'id' => $tour->id]).'"'.' class='.'"btn btn-primary"'.'>Изменить</a>';
                                ?>
                                </div>
                            </div>

                    </div>
                </div>




        <?php endforeach; ?>
    </div>
<div class='pagination-center col-md-12'>
<?= LinkPager::widget(['pagination' => $pagination]) ?>
</div>