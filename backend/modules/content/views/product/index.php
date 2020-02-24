<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use fedemotta\datatables\DataTables;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\content\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Products');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('backend', 'Create Product'), ['create'], ['class' => 'btn btn-success']) ?>
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

                        return '<center>'.Html::img(Yii::$app->getHomeUrl() . 'uploads/product/youtube-video-icon.png',
                                ['class' => 'thumbnail', 'height' => '100']).'</center>';
                    } else {
                        return '<center>'.Html::img(Yii::$app->getHomeUrl() . 'uploads/product/' . $dataProvider->main_photo,
                                ['class' => 'thumbnail', 'height' => '100']).'</center>';
                    }

                }
            ],
            'name',
            [
                'attribute' => 'productType.name',
                'value' => function ($dataProvider) {
                    return $dataProvider->productType->name;
                },
                'label' => 'Category',
            ],
            [
                'attribute' => 'brand.name',
                'value' => function ($dataProvider) {
                    return $dataProvider->brand->name;
                },
                'label' => 'Brand',
            ],
            //  'academic_year',
            //'academic_semester',
            //'date_published',


            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
