<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Projectov */

$this->title = Yii::t('backend', 'Update Projectov Us', [
    'nameAttribute' => $model->id,
]);

$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="projectov-update">

    <?= $this->render('_form', [
        'model' => $model,
        'modelDetails' => $modelDetails,
    ]) ?>

</div>
