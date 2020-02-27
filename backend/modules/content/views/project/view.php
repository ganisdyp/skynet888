<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Project */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Projects'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-view">

  <!--  <h1><?//= Html::encode($this->title) ?></h1> -->

    <p>
        <?= Html::a(Yii::t('backend', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('backend', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('backend', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <div class="text-center">
        <?= Html::img(Yii::$app->getHomeUrl().'uploads/project/' . $model->main_photo,
            ['class'=>'thumbnail','width'=>'250']); ?>
    </div>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
          //  'id',
            'main_photo',
            'name',
            'description',
            'name_th',
            'description_th',
        ],
    ]) ?>

</div>
