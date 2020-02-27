<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Story */

$this->title = Yii::t('backend', 'Update Story: {nameAttribute}', [
    'nameAttribute' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Stories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="story-update">

    <?= $this->render('_form', [
        'model' => $model,
        'modelDetails' => $modelDetails,
       // 'modelDetails2' => $modelDetails2,
    ]) ?>

</div>
