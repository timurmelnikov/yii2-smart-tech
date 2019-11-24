<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DebtInformation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="debt-information-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'iinBin')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'totalArrear')->textInput() ?>
    <?= $form->field($model, 'totalTaxArrear')->textInput() ?>
    <?= $form->field($model, 'pensionContributionArrear')->textInput() ?>
    <?= $form->field($model, 'socialContributionArrear')->textInput() ?>
    <?= $form->field($model, 'socialHealthInsuranceArrear')->textInput() ?>
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
