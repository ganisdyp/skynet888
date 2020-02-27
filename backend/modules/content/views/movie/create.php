<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Movie */

$this->title = Yii::t('backend', 'Create Movie / Trailor');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Movies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="movie-create">

    <?= $this->render('_form', [
        'model' => $model,
        'modelDetails' => $modelDetails,
     //   'modelDetails2' => $modelDetails2,
    ]) ?>

</div>
