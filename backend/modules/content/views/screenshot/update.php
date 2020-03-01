<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Screenshot */

$this->title = Yii::t('backend', 'Update Screenshot: {nameAttribute}', [
    'nameAttribute' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Stories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="screenshot-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
