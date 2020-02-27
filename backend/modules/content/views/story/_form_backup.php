<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\ProjectLang;
use common\models\Tag;
use common\models\StoryTypeLang;
use common\models\StoryPhoto;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Story */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="story-form">

    <?php $form = ActiveForm::begin(['enableClientValidation' => false, 'options' => ['enctype' => 'multipart/form-data']]); ?>
    <div class="row">
        <div class="col-md-12">
            <?php
            if ($model->isNewRecord) {
                // Show nothing
            } else {
                echo Html::img(Yii::$app->getHomeUrl() . 'uploads/story/' . $model->main_photo,
                    ['id' => 'current_img', 'class' => 'thumbnail', 'width' => '150']);
                echo "<video id='current_media' width='480' controls>";
                echo "<source src='" . Yii::$app->getHomeUrl() . 'uploads/story/' . $model->main_photo . "'  type='video/mp4'>";
                echo "</video>";
            } ?>
            <?= $form->field($model, 'main_photo_file')->fileInput() ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'story_type_id')->dropDownList(ArrayHelper::map(StoryTypeLang::find()->all(), 'story_type_id', 'name'), ['prompt' => '- Select -'])->label('Story Category') ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'tag_id')->dropDownList(ArrayHelper::map(Tag::find()->all(), 'id', 'tag'), ['prompt' => '- Select -'])->label('Tag') ?>
        </div>
    </div>


    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'project_id')->dropDownList(ArrayHelper::map(ProjectLang::find()->all(), 'project_id', 'name'), ['prompt' => '- Select -'])->label('Related Project') ?>
        </div>
        <div class="col-md-6">

        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'name_th')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'description_th')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'keyword')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <?= "<h2>Details</h2>" ?>

    <?php foreach ($modelDetails as $i => $modelDetail) : ?>
        <div class="row story-profile story-profile-<?= $i ?>">
            <div class="col-md-10">
                <?= Html::activeHiddenInput($modelDetail, "[$i]id") ?>
                <?= Html::activeHiddenInput($modelDetail, "[$i]updateType", ['class' => 'update-type']) ?>

                <?= $form->field($modelDetail, "[$i]story_photo")->fileInput() ?>
            </div>
            <div class="col-md-2">
                <?= Html::button('x', ['class' => 'delete-button btn btn-danger', 'data-target' => "story-profile-$i"]) ?>
            </div>
        </div>
    <?php endforeach; ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('backend', 'Save'), ['class' => 'btn btn-success']) ?>
        <?= Html::submitButton('Add photo', ['name' => 'addRow', 'value' => 'true', 'class' => 'btn btn-info']) ?>
    </div>

    <?php ActiveForm::end();

    $this->registerJs(' 

    $(document).ready(function(){
      $(\'.delete-button\').click(function() {
        var detail = $(this).closest(\'.story-profile\');
        var updateType = detail.find(\'.update-type\');
        if (updateType.val() === " . json_encode(StoryPhoto::UPDATE_TYPE_UPDATE) . ") {
            //marking the row for deletion
            updateType.val(" . json_encode(StoryPhoto::UPDATE_TYPE_DELETE) . ");
            detail.hide();
        } else {
            //if the row is a new row, delete the row
            detail.remove();
        }

    });
      $(\':file\').change(function(){
var file = this.files[0];
var fileType = file["type"];
var ValidTypes = ["image/gif", "image/jpeg", "image/png", "video/mp4"];
if ($.inArray(fileType, ValidTypes) < 0) {
    alert("INVALID FILE TYPE!");
   $(\'#current_media\').show();
   $(\'#story-main_photo\').val(\'\');
}else{
$(\'#current_media\').hide();
}
    });
    });', \yii\web\View::POS_READY);

    ?>
</div>
