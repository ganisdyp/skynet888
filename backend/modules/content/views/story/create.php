<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Story */

$this->title = Yii::t('backend', 'Create Story');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Storys'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="story-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
