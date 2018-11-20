<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Products */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="products-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'pr_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pr_description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pr_price')->textInput() ?>

    <?= $form->field($model, 'pr_image')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
