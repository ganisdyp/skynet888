<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Projectov */

$this->title = Yii::t('backend', 'Create Project Overview');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Projectov Us'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="projectov-create">
    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
