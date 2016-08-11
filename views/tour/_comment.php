<?php
/**
 * Created by PhpStorm.
 * User: redrice
 * Date: 27.02.16
 * Time: 19:52
 */

use yii\helpers\Html;

use yii\widgets\ActiveForm;
?>

<div id="comments" class="col-md-12 comments">


    <?php if(!Yii::$app->user->isGuest){
        $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'comment')->textarea() ?>

        <div class="form-group">
            <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
        </div>
        <?php ActiveForm::end();  }?>


    <?php if($comments) foreach ($comments as $comment): ?>
        <div class="comment">
            <?= Html::img('/ctour/web/img/ava.jpg    ', ['alt' => '...', 'class' => 'comment-img'] );?>
            <?= Html::tag('div', Html::encode($comment['username']), ['class'=>'comment-username'])?>
            <?= Html::tag('div', Html::encode($comment['comment']), ['class'=>'comment-text'])?>
            <?= Html::tag('div', Html::encode($comment['date']), ['class'=>'comment-date'])?>

        </div>
    <?php endforeach; ?>

</div>