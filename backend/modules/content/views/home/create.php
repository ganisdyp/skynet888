<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\HomeContent */

$this->title = Yii::t('backend', 'Create Home Content');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Home Contents'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="home-content-create">
    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
