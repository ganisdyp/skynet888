<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Character */

$this->title = Yii::t('backend', 'Update Character: {nameAttribute}', [
    'nameAttribute' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Characters'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="character-update">

    <?= $this->render('_form', [
        'model' => $model,
        'modelDetails' => $modelDetails,
       // 'modelDetails2' => $modelDetails2,
    ]) ?>

</div>
