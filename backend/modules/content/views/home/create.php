<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Home */

$this->title = Yii::t('backend', 'Create Home');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Home'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="home-create">
    

    <?= $this->render('_form', [
        'model' => $model,
        'modelDetails' => $modelDetails,
    ]) ?>

</div>
