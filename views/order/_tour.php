<?php
/**
 * Created by PhpStorm.
 * User: redmenote
 * Date: 12.02.16
 * Time: 10:13
 */

use yii\helpers\Html;
?>

<?= Html::img('/ss/basic/web/'.$tour->image, ['alt' => '...', 'data-src' => 'holder.js/300x200'] );?>
<div class="caption vcard">
    <div>Название: <span><?= Html::encode("{$tour->name}") ?></span></div>
    <div>Организация: <span class="fn org"><?= $tour->org ?></span></div>
    <div>Телефон: <span class="tel"><?= $tour->tel ?></span></div>
    <div class="adr">Адрес: <span class="locality street-address"><?= $tour->address ?></span></div>
    <div>Сайт компании: <a href="http://<?= $tour->site ?>">Перейти</a></div>
    <div>Информация:
        <?php
            $string = strip_tags($tour->info);
            if(strlen($string) > 500) {
                $string = strip_tags($tour->info);
                $string = substr($string, 0, 500);
                $string = rtrim($string, ".,!-");
                $string = substr($string, 0, strrpos($string, ' '));
                $string = $string." [...]";
            }
            //if(strlen($string)> 199)
            //echo $string."...".strlen($string);
        ?>
        <span>
            <?= $string ?>
        </span>
    </div>
    <div>Дата: <span><?= $tour->date ?></span></div>
</div>
<hr/>
                            