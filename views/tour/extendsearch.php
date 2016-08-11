<?php
/**
 * Created by PhpStorm.
 * User: redrice
 * Date: 14.02.16
 * Time: 23:32
 */

/**
 * Created by PhpStorm.
 * User: redmenote
 * Date: 07.01.16
 * Time: 16:58
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\widgets\LinkPager;

use yii\jui\AutoComplete;
use app\models\Tour;

$this->title = 'Расширенный поиск';
$this->params['breadcrumbs'][] = ['label' => 'Туры', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$listdata=Tour::find()
    ->select(['name as value', 'name as label'])
    ->where(['status' => 1])
    ->asArray()
    ->all();

?>


<div class="add-tour col-md-8 col-lg-8">

    <?php $form = ActiveForm::begin(['action' => 'result', 'method' => 'get']); ?>

        <?= $form->field($model, 'search')->widget(
            AutoComplete::className(), [
            'clientOptions' => [
                'source' => $listdata,
            ],
            'options'=>[
                'class'=>'form-control'
            ]
        ]);
        ?>
        <?= $form->field($model, 'category')->dropDownList([
            'name' => 'Название',
            'org' => 'Организация',
            'address' => 'Адрес',
            'info' => 'Информация',
            'tel' => 'Телефон',
        ]);
        ?>
        <?= $form->field($model, 'sort')->dropDownList([
            'name' => 'Названию',
            'date' => 'Дате',
            'address' => 'Адресу'
        ]);
        ?>




        <div class="form-group">
            <?= Html::submitButton('Поиск', ['class' => 'btn btn-primary']) ?>
        </div>


    <?php ActiveForm::end(); ?>



</div>


<div class="calendar-margin col-md-4 col-lg-4">
    <?= $this->render('_calendar', [

    ]) ?>
</div>