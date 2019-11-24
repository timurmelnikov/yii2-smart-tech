<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\DebtInformation */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Информация о задолженности', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="debt-information-view">
    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'iinBin',
            'totalArrear',
            'totalTaxArrear',
            'pensionContributionArrear',
            'socialContributionArrear',
            'socialHealthInsuranceArrear',
        ],
    ]) ?>

</div>
