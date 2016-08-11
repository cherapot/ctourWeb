<?php
/**
 * Created by PhpStorm.
 * User: redmenote
 * Date: 07.02.16
 * Time: 1:12
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use zhuravljov\widgets\DatePicker;

$this->title = 'Заказ';
$this->params['breadcrumbs'][] = ['label' => 'Туры', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="add-tour">

    <?php $form = ActiveForm::begin(); ?>

    <div class="form-site col-md-6">
        <?= $form->field($model, 'name') ?>
        <?= $form->field($model, 'tel') ?>
        <?= $form->field($model, 'count') ?>
        <?= $form->field($model, 'email') ?>
        <?= $form->field($model, 'date_tour')->widget(DatePicker::className(), [
            'clientOptions' => [
                'format' => 'dd.mm.yyyy',
                'language' => 'ru',
                'autoclose' => true,
                'todayHighlight' => true,
                'startDate' => date('Y-m-d'),
            ],
            'clientEvents' => [],
        ]) ?>

    </div>
    <div class="form-img col-md-6">
        <?= Html::img('/ctour/web/img/img-ord.jpg', ['alt' => '...', 'data-src' => 'holder.js/300x200'] );?>
    </div>
    <div class="col-md-12">
        <?=
        $form->field($model, 'info')->widget(CKEditor::className(),[
            'editorOptions' => [
                'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                'inline' => false, //по умолчанию false
            ],
        ]);
        //$form->field($model, 'info')
        ?>

        <div class="form-group">
            <?= Html::submitButton('Добавить', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>




</div>