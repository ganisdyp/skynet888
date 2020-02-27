<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use fedemotta\datatables\DataTables;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\content\models\CharacterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Characters');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="character-index">

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('backend', 'Create Character'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= DataTables::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'main_photo',
                'format' => 'html',
                'value' => function ($dataProvider) {
                    /*  $path_parts = pathinfo($dataProvider->main_photo);
                      $extension = $path_parts['extension'];*/

                    $media_type = $dataProvider->media_type;
                    if ($media_type == 1) {

                        return '<center>'.Html::img(Yii::$app->getHomeUrl() . 'uploads/character/youtube-video-icon.png',
                                ['class' => 'thumbnail', 'height' => '100']).'</center>';
                    } else {
                        return '<center>'.Html::img(Yii::$app->getHomeUrl() . 'uploads/character/' . $dataProvider->main_photo,
                                ['class' => 'thumbnail', 'height' => '100']).'</center>';
                    }

                }
            ],
            'name',
            [
                'attribute' => 'project.name',
                'value' => function ($dataProvider) {
                    return $dataProvider->project->name;
                },
                'label' => 'Project',
            ],
            //  'academic_year',
            //'academic_semester',
            //'date_published',


            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
