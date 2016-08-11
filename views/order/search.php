<?php
/**
 * Created by PhpStorm.
 * User: redrice
 * Date: 15.02.16
 * Time: 1:20
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\AutoComplete;
use app\models\Order;

$this->title = 'Расширенный поиск';
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


$listdata=Order::find()
    ->select(['tour_name as value', 'tour_name as label'])
    ->asArray()
    ->all();
?>



<div class="add-tour">

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


    <div class="form-group">
        <?= Html::submitButton('Поиск', ['class' => 'btn btn-primary']) ?>
    </div>


    <?php ActiveForm::end(); ?>


</div>