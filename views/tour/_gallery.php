<?php
/**
 * Created by PhpStorm.
 * User: redmenote
 * Date: 11.02.16
 * Time: 21:39
 */
use yii\helpers\Html;
?>

<div id="gallery" class="col-md-8">
    <div id="panel">
        <?= Html::img('/ctour/web/'.$gallery[0]->path, ['alt' => '...', 'id' => 'largeImage', 'class' => ''] );?>
    </div>
    <div id="thumbs" class="gallery-all">
        <?php foreach ($gallery as $img): ?>
            <?= Html::img('/ctour/web/'.$img->path, ['alt' => '...', 'class' => 'smallImage img-thumbnail'] );?>
        <?php endforeach; ?>
    </div>
</div>