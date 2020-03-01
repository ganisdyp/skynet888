<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\About */

$this->title = Yii::t('backend', 'Update About Us', [
    'nameAttribute' => $model->id,
]);

$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="about-update">

    <?= $this->render('_form', [
        'model' => $model,
        'modelDetails' => $modelDetails,
    ]) ?>

</div>
