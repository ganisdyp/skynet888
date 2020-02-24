<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ProductType */

$this->title = Yii::t('backend', 'Create Product Category');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Product Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-type-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
