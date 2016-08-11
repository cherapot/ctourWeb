<?php
/**
 * Created by PhpStorm.
 * User: redmenote
 * Date: 05.02.16
 * Time: 22:16
 */

use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = 'Поиск';
$this->params['breadcrumbs'][] = ['label' => 'Туры', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['breadcrumbs'][] = ['label' => 'Расширенный поиск', 'url' => ['extendsearch']];


?>




    <div class="content col-md-12">
        <?php foreach ($tours as $tour): ?>

        <div class="col-sm-4 col-md-4">
            <div class="thumbnail">
                <?= $this->render('_tour', [
                        'tour' => $tour,
                    ]) ?>

                <p>
                <div class="pagination-center nav-submit">
                    <?= //Html::a('Подробнее', [$url], ['class'=>'btn btn-primary '])
                        '<a href="'.$url = Yii::$app->urlManager->createUrl(['tour/more', 'id' => $tour->id]).'"'.' class='.'"btn btn-primary"'.'>Подробнее</a>';
                    ?>
                </div>
                </p>
            </div>
        </div>


        <?php endforeach; ?>
    </div>
    <div class='pagination-center col-md-12'>
    <?= LinkPager::widget(['pagination' => $pagination]) ?>
    </div>
<?php
    if(!$tours)
        echo
        '<h3>По данному запросу ничего не найдено</h3>';
?>
