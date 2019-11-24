<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $getInfoFormModel app\models\GetInfoForm */
/* @var $debtInformationModel app\models\DebtInformation */
/* @var $form ActiveForm */
?>
    <div class="site-index">
        <?php $form = ActiveForm::begin(['id' => 'debtInformation']); ?>
        <?= $form->field($getInfoFormModel, 'inn')->textInput(['type' => 'number']) ?>
        <div class="form-group">
            <?= Html::submitButton('Получить информацию', ['class' => 'btn btn-primary', 'data-loading-text' => 'Ожидайте...']) ?>
        </div>
        <?php ActiveForm::end(); ?>
        <div id="request">
        </div>
        <div id="data">
        </div>
        <div id="result" class="debt-information-form" hidden>
            <?php $form = ActiveForm::begin(['action' => '/site/save']); ?>
            <?= $form->field($debtInformationModel, 'iinBin')->textInput(['maxlength' => true]) ?>
            <?= $form->field($debtInformationModel, 'totalArrear')->textInput() ?>
            <?= $form->field($debtInformationModel, 'totalTaxArrear')->textInput() ?>
            <?= $form->field($debtInformationModel, 'pensionContributionArrear')->textInput() ?>
            <?= $form->field($debtInformationModel, 'socialContributionArrear')->textInput() ?>
            <?= $form->field($debtInformationModel, 'socialHealthInsuranceArrear')->textInput() ?>
            <div class="form-group">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

<?php
$js = <<<JS
$('#debtInformation').on('beforeSubmit', function () {
    var data = $(this).serialize();
    $('.btn-primary').button('loading');
    $.ajax({
        url: '/site/index',
        type: 'POST',
        data: data,
        success: function (res) {
            $('.btn-primary').button('reset');
            $('#result').removeAttr('hidden').slideDown();
            var obj = jQuery.parseJSON(res);
            $('#debtinformation-iinbin').val(obj.iinBin);
            $('#debtinformation-totalarrear').val(obj.totalArrear);
            $('#debtinformation-totaltaxarrear').val(obj.totalTaxArrear);
            $('#debtinformation-pensioncontributionarrear').val(obj.pensionContributionArrear);
            $('#debtinformation-socialcontributionarrear').val(obj.socialContributionArrear);
            $('#debtinformation-socialhealthinsurancearrear').val(obj.socialHealthInsuranceArrear);
        },
        error: function () {
            alert('Ошибка!');
        }
    });
    return false;
});
JS;
$this->registerJs($js);
