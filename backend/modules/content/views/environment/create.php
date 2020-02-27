<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Environment */

$this->title = Yii::t('backend', 'Create Environment');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Environments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="environment-create">

    <?= $this->render('_form', [
        'model' => $model,
        'modelDetails' => $modelDetails,
     //   'modelDetails2' => $modelDetails2,
    ]) ?>

</div>
