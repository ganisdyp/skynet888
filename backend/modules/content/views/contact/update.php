<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Contact */

$this->title = Yii::t('backend', 'Update Contact Content', [
    'nameAttribute' => $model->id,
]);
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="contact-update">

    <?= $this->render('_form', [
        'model' => $model,
        'modelDetails' => $modelDetails,
    ]) ?>

</div>
