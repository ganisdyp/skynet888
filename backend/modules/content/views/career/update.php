<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Career */

$this->title = Yii::t('backend', 'Update Career Content', [
    'nameAttribute' => $model->id,
]);
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
if (Yii::$app->session->hasFlash('alert')):
    echo \yii\bootstrap\Alert::widget([
        'body' => ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'body'),
        'options' => ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'options'),
    ]);
endif;
?>
<div class="career-update">

    <?= $this->render('_form', [
        'model' => $model,
        'modelDetails' => $modelDetails,
    ]) ?>

</div>
