<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Character */

$this->title = Yii::t('backend', 'Create Character');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Characters'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="character-create">

    <?= $this->render('_form', [
        'model' => $model,
        'modelDetails' => $modelDetails,
     //   'modelDetails2' => $modelDetails2,
    ]) ?>

</div>
