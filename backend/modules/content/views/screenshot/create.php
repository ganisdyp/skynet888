<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Screenshot */

$this->title = Yii::t('backend', 'Create Screenshot');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Screenshots'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="screenshot-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
