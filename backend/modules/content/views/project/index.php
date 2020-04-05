<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use fedemotta\datatables\DataTables;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\content\models\ProjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Projects');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-index">

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('backend', 'Add project'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= DataTables::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            ['attribute' => 'main_photo',
                'format' => 'html',
                'value' => function ($dataProvider) {
                    return Html::img(Yii::$app->getHomeUrl() . 'uploads/project/' . $dataProvider->main_photo,
                        ['class' => 'thumbnail', 'width' => '80']);
                }
            ],
            [
                'attribute' => 'project.name_en',
                'value' => function ($dataProvider) {
                    return $dataProvider->name;
                },
                'label' => 'Name (EN)',
            ],
            [
                'attribute' => 'project.name_th',
                'value' => function ($dataProvider) {
                    $name_th = $dataProvider->getProjectLangs()->where(['project_lang.project_id' => $dataProvider->id, 'project_lang.language' => 'th'])->one();
                    return $name_th->name;
                },
                'label' => 'Name (TH)',
            ],
            [
                'attribute' => 'status',
                'format' => 'html',
                'value' => function ($dataProvider) {
                    return Yii::$app->project->getProjectStatus($dataProvider->status);
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
