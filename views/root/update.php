<?php
/**
 * Created by PhpStorm.
 * User: redmenote
 * Date: 08.01.16
 * Time: 1:20
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;

?>


<div class="add-tour">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['value' => $tour->name]) ?>
    <?= $form->field($model, 'org')->textInput(['value' => $tour->org]) ?>
    <?= $form->field($model, 'tel')->textInput(['value' => $tour->tel]) ?>
    <?= $form->field($model, 'address')->textInput(['value' => $tour->address]) ?>
    <?=
    $form->field($model, 'info')->widget(CKEditor::className(),[
        'editorOptions' => [
            'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
            'inline' => false, //по умолчанию false
        ],
    ])->textInput(['value' => $tour->info]);
    //$form->field($model, 'info')
    ?>

    <?= $form->field($model, 'site')->textInput(['value' => $tour->site]) ?>

    <div class="form-group">
        <?= Html::submitButton('Обновить', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>