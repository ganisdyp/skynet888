<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\About */

$this->title = Yii::t('backend', 'Create About Us');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'About Us'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="about-create">
    

    <?= $this->render('_form', [
        'model' => $model,
        'modelDetails' => $modelDetails,
    ]) ?>

</div>
