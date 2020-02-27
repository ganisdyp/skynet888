<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Environment */

$this->title = Yii::t('backend', 'Update Environment: {nameAttribute}', [
    'nameAttribute' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Environments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="environment-update">

    <?= $this->render('_form', [
        'model' => $model,
        'modelDetails' => $modelDetails,
       // 'modelDetails2' => $modelDetails2,
    ]) ?>

</div>
