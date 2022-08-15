<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UrlChecker */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="url-checker-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'frequency_interval')->dropDownList(\app\models\UrlChecker::getInvervalTime()) ?>

    <?= $form->field($model, 'check_repetition_if_error')->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
