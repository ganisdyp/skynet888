<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Career */

$this->title = Yii::t('backend', 'Update Career Content', [
    'nameAttribute' => $model->id,
]);
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="career-update">

    <?= $this->render('_form', [
        'model' => $model,
        'modelDetails' => $modelDetails,
    ]) ?>

</div>
