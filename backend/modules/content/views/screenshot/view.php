<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Screenshot */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Screenshots'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="screenshot-view">

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
        <?php
        /* $path_parts = pathinfo($model->main_photo);
         $extension = $path_parts['extension'];*/
        //echo $extension;
        $media_type = $model->media_type;
        if ($media_type == 1) {  /* echo "<video id='current_media' width='480' controls controlsList=\"nodownload\">";
            echo "<source src='" . Yii::$app->getHomeUrl() . 'uploads/screenshot/' . $model->main_photo . "'  type='video/mp4'>";
            echo "</video>";*/
            ?>

            <iframe width="480" height="320" src="<?= $model->main_photo; ?>"
                    allowfullscreen></iframe>
        <?php } else {
            echo Html::img(Yii::$app->getHomeUrl() . 'uploads/screenshot/' . $model->main_photo,
                ['class' => 'thumbnail', 'width' => '250']);
        }

        ?>
    </div>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [

                'id',
            [
                'attribute' => 'project.name',
                'value' => function ($model) {
                    $name_en = $model->project->getProjectLangs()->where(['project_lang.project_id' => $model->project_id, 'project_lang.language' => 'en'])->one();
                   // $name_th = $model->project->getProjectLangs()->where(['project_lang.project_id' => $model->project_id, 'project_lang.language' => 'th'])->one();
                    return $name_en->name;

                },
                'label' => 'Project',
            ],
            'date_published',

        ],
    ]) ?>

    <?php

    echo "<div class='row' style='text-align:left; margin-left:1px;'>";
    echo "<span title='Related project' class='label label-default' style='font-size:12pt; font-weight:normal;'>" . $model->project->name . "</span> ";

    echo "</div>";
    echo "<br>";
    


    $this->registerJs(' 
//checkFile("' . $model->main_photo . '");
    
function checkFile(file) {
  var extension = file.substr((file.lastIndexOf(' . ') +1));
  if (!/(mp4)$/ig.test(extension)) {
     //alert("Image!");
     $(\'#video-box\').hide();
     $(\'#image-box\').show();
  }else{
     //alert("Video!");
     $(\'#image-box\').hide();
     $(\'#video-box\').show();
  }
}
    ', \yii\web\View::POS_READY);

    ?>

</div>
