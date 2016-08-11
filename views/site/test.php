<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 02.04.16
 * Time: 23:29
 */

use yii\helpers\Html;
?>
<div class="site-error">

    <?php
        echo "Социальный ID пользователя: " . $model['uid'] . '<br />';
    echo "Имя пользователя: " .  $model['first_name'] . '<br />';
    echo "Ссылка на профиль пользователя: " .  $model['screen_name'] . '<br />';
    echo "Пол пользователя: " .  $model['sex'] . '<br />';
    echo "День Рождения: " .  $model['bdate'] . '<br />';
    echo '<img src="' .  $model['photo_big'] . '" />';
    echo "<br />";
    ?>


</div>
