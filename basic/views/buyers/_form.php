<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Buyers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="buyers-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'b_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'b_mobile')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'b_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'b_order_unique_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'b_status')->dropDownList([ 0 => '0', 1 => '1', '' => '', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'b_total_sum')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
