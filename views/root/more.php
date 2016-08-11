<?php
/**
 * Created by PhpStorm.
 * User: redmenote
 * Date: 06.01.16
 * Time: 14:49
 */

use yii\helpers\Html;
use yii\widgets\LinkPager;
?>
    <h1 class="h1"> Туры </h1>
    <div class="content col-md-12">
        <?php foreach ($tours as $tour): ?>
             <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <?= Html::img('/ss/basic/web/'.$tour->image, ['alt' => '...', 'data-src' => 'holder.js/300x200'] );?>
                        <div class="caption">
                                <h3><?= Html::encode("{$tour->name}") ?></h3>
                                <br><div><?= $tour->org ?></div>
                                <br><div>Телефон: <?= $tour->tel ?></div>
                                <br><div>Адрес: <?= $tour->address ?></div>
                                <br><div>Сайт компании: <a href="http://<?= $tour->site ?>">Перейти</a></div>
                                <br><div><?= $tour->info ?></div>
                                <br><div><?= $tour->date ?></div>
                                <hr/>
                            <p>
                                <?= //Html::a('Подробнее', [$url], ['class'=>'btn btn-primary '])
                                    '<a href="'.$url = Yii::$app->urlManager->createUrl(['root/more', 'id' => $tour->id]).'"'.' class='.'"btn btn-primary"'.'>Разрешить</a>';
                                ?>
                                <?= //Html::a('Подробнее', [$url], ['class'=>'btn btn-primary '])
                                '<a href="'.$url = Yii::$app->urlManager->createUrl(['root/delete', 'id' => $tour->id]).'"'.' class='.'"btn btn-primary"'.'>Удалить</a>';
                                ?>

                            </p>
                        </div>
                    </div>
                </div>



        <?php endforeach; ?>
    </div>

<?= LinkPager::widget(['pagination' => $pagination]) ?>