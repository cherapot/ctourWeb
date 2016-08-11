<?php
/**
 * Created by PhpStorm.
 * User: redmenote
 * Date: 07.01.16
 * Time: 23:30
 */

use yii\helpers\Html;

$this->title = 'Подробнее';
$this->params['breadcrumbs'][] = ['label' => 'Туры', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>



<div class="col-md-12">

    <h1 class="h1"> <?= $tour->name ?></h1>

    <?php if($gallery) { ?>
    <?= $this->render('_gallery', [
                'gallery' => $gallery,
    ]) ?>
    <?php } ?>

    <div class="col-md-4">
        <div class="caption ">
            <h3><?= Html::encode("{$tour->name}") ?></h3>
            <div>Организация: <span class="fn org"><?= $tour->org ?></span></div>
            <div>Телефон: <span class="tel"><?= $tour->tel ?></span></div>
            <div class="adr">Адрес: <span class="locality street-address"><?= $tour->address ?></span></div>
            <div>Сайт компании: <a href="http://<?= $tour->site ?>">Перейти</a></div>
            <div class="nav-submit">
                <?= //Html::a('Заказать', [Yii::$app->urlManager->createUrl(['more', 'id' => $tour->id])], ['class'=>'primary ']);
                    '<a href="'.$url = Yii::$app->urlManager->createUrl(['tour/order', 'id' => $tour->id]).'"'.' class='.'"btn btn-primary"'.'>Заказать</a>';
                ?>
            </div>
        </div>
    </div>
</div>
<div class="col-md-12">

    <br><div><?= $tour->info ?></div>
    <div>Дата: <span><?= $tour->date ?></span></div>
    <hr/>
        <p>
            <?= //Html::a('Заказать', [Yii::$app->urlManager->createUrl(['more', 'id' => $tour->id])], ['class'=>'btn btn-primary ']);
                '<a href="'.$url = Yii::$app->urlManager->createUrl(['tour/order', 'id' => $tour->id]).'"'.' class='.'"btn btn-primary"'.'>Заказать</a>';
            ?>
        </p>
</div>
<div class="col-md-12">
	<ul class="nav nav-tabs">
	    <li class="active"><a data-toggle="tab" href="#panel1">На сайте</a></li>
	    <li><a data-toggle="tab" href="#panel2">Вконтакте</a></li>
	</ul>

	<div class="tab-content">
	    <div id="panel1" class="tab-pane fade in active">
            <?= $this->render('_comment', [
                'comments' => $comments,
                'model' => $model,
            ]) ?>
	    </div>
	    <div id="panel2" class="tab-pane fade">
            <!-- Put this script tag to the <head> of your page -->
            <script type="text/javascript" src="//vk.com/js/api/openapi.js?121"></script>

            <script type="text/javascript">
                VK.init({apiId: 5393194, onlyWidgets: true});
            </script>

            <!-- Put this div tag to the place, where the Comments block will be -->
            <div id="vk_comments"></div>
            <script type="text/javascript">
                VK.Widgets.Comments("vk_comments", {limit: 10, width: "665", attach: "*"});
            </script>
	    </div>
	</div>
</div>




<script type="text/javascript">

    var tmp = document.getElementsByClassName('smallImage');
    var main = document.getElementById('largeImage');

    function mod(){
        main.src = this.src;
        var t = document.getElementById('panel');
        t.style.height = t.offsetWidth/16*10 + 'px';
    }

    for (i=0; i<tmp.length; i++)
    {
        t = tmp.item(i);
        t.addEventListener('click', mod , false)
    }

    var t = document.getElementById('panel');
    t.style.height = t.offsetWidth/16*10 + 'px';

</script>

