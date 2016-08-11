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

$this->title = 'Изменить';
$this->params['breadcrumbs'][] = ['label' => 'Туры', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="add-tour">


    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="form-site col-md-6">
        <?= $form->field($load, 'imageFiles[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>
        <?= $form->field($model, 'name')->textInput(['value' => $tour->name]) ?>
        <?= $form->field($model, 'org')->textInput(['value' => $tour->org]) ?>
        <?= $form->field($model, 'tel')->textInput(['value' => $tour->tel]) ?>
        <?= $form->field($model, 'address')->textInput(['value' => $tour->address]) ?>
        <?= $form->field($model, 'site')->textInput(['value' => $tour->site]) ?>
    </div>
    <div class="form-img col-md-6">
        <?= Html::img('/ctour/web/img/img-chng.jpg', ['alt' => '...', 'data-src' => 'holder.js/300x200'] );?>
    </div>
    <div class="col-md-12">
        <?=
        $form->field($model, 'info')->widget(CKEditor::className(),[
            'editorOptions' => [
                'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                'inline' => false, //по умолчанию false
            ],
        ])->textInput(['value' => $tour->info]);
        //$form->field($model, 'info')
        ?>

        <div class="form-group">
            <?= Html::submitButton('Обновить', ['class' => 'btn btn-primary']) ?>
        </div>

    </div>
    <?php ActiveForm::end(); ?>

</div>