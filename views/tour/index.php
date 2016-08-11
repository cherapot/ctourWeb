<?php
/**
 * Created by PhpStorm.
 * User: redmenote
 * Date: 06.01.16
 * Time: 14:49
 */


use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = 'Туры';
$this->params['breadcrumbs'][] = $this->title;
?>
    <?php
    $page = $pagination->page;
    if ($this->beginCache("tourIndex", ['duration' => 3600])) {
    ?>
    <div class="content col-md-12">
        <?php foreach ($tours as $tour): ?>


                <div class="col-sm-4 col-md-4">
                    <div class="thumbnail  tour-container">
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
    <?php
        $this->endCache();
    }
    ?>

<div class='pagination-center col-md-12'>
<?= LinkPager::widget(['pagination' => $pagination]) ?> 
</div>