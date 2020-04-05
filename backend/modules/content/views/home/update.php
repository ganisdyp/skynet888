<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $this yii\web\View */
/* @var $model common\models\Home */

$this->title = Yii::t('backend', 'Update Home', [
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
<div class="home-update">

    <?= $this->render('_form', [
        'model' => $model,
        'modelDetails' => $modelDetails,
    ]) ?>

</div>
