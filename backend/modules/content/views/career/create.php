<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Career */

$this->title = Yii::t('backend', 'Create Career Content');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Career Content'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="career-create">
    

    <?= $this->render('_form', [
        'model' => $model,
        'modelDetails' => $modelDetails,
    ]) ?>

</div>
