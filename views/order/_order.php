<?php
/**
 * Created by PhpStorm.
 * User: redrice
 * Date: 14.02.16
 * Time: 23:08
 */

use yii\helpers\Html;
?>

<div class="caption">
    <div>Название: <span><?= Html::encode("{$order->tour_name}") ?></span></div>
    <div>Имя: <span><?= $order->name ?></span></div>
    <div>Телефон: <span><?= $order->tel ?></span></div>
    <div>Email: <span ><?= $order->email ?></span></div>
    <div>Информация:
        <?php
        $string = strip_tags($order->info);
        if(strlen($string) > 500) {
            $string = strip_tags($tour->info);
            $string = substr($string, 0, 1000);
            $string = rtrim($string, ".,!-");
            $string = substr($string, 0, strrpos($string, ' '));
            $string = $string." [...]";
        }
        ?>
        <span>
            <?= $string ?>
        </span>
    </div>
    <div>Дата: <span><?= $order->date ?></span></div>
</div>
<hr/>