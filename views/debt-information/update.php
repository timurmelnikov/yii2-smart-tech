<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DebtInformation */

$this->title = 'Изменить информацию о задолженности: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Информация о задолженности', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="debt-information-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
