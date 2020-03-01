<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\CareerPhoto;
use dosamigos\tinymce\TinyMce;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\Career */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $this->registerJs("
    $('.delete-button-photo').click(function() {
        var detail = $(this).closest('.career-profile');
        var updateType = detail.find('.update-type');
        if (updateType.val() === " . json_encode(CareerPhoto::UPDATE_TYPE_UPDATE) . ") {
            //marking the row for deletion
            updateType.val(" . json_encode(CareerPhoto::UPDATE_TYPE_DELETE) . ");
            detail.hide();
        } else {
            //if the row is a new row, delete the row
            detail.remove();
        }

    });
       
");
?>
<style>
</style>
<div class="career-form">


    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#english">English</a></li>
        <li><a data-toggle="tab" href="#thai">Thai</a></li>

    </ul>
    <?php
    $form = ActiveForm::begin(); ?>


    <!-- Tab content -->
    <div class="tab-content">
        <div id="english" class="tab-pane fade in active">

            <?= $form->field($model, 'content')->widget(TinyMce::className(), [
                'options' => ['rows' => 8],
                'language' => 'en',
                'clientOptions' => [
                    'plugins' => [
                        "advlist autolink lists link charmap print preview anchor",
                        "searchreplace visualblocks code fullscreen textcolor",
                        "insertdatetime media table contextmenu paste"
                    ],
                    'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | forecolor backcolor",
                    'textcolor_map' => [
                        "000000", "Black",
                        "993300", "Burnt orange",
                        "333300", "Dark olive",
                        "003300", "Dark green",
                        "003366", "Dark azure",
                        "000080", "Navy Blue",
                        "333399", "Indigo",
                        "333333", "Very dark gray",
                        "800000", "Maroon",
                        "FF6600", "Orange",
                        "808000", "Olive",
                        "008000", "Green",
                        "008080", "Teal",
                        "0000FF", "Blue",
                        "666699", "Grayish blue",
                        "808080", "Gray",
                        "FF0000", "Red",
                        "FF9900", "Amber",
                        "99CC00", "Yellow green",
                        "339966", "Sea green",
                        "33CCCC", "Turquoise",
                        "3366FF", "Royal blue",
                        "800080", "Purple",
                        "999999", "Medium gray",
                        "FF00FF", "Magenta",
                        "FFCC00", "Gold",
                        "FFFF00", "Yellow",
                        "00FF00", "Lime",
                        "00FFFF", "Aqua",
                        "00CCFF", "Sky blue",
                        "993366", "Red violet",
                        "FFFFFF", "White",
                        "FF99CC", "Pink",
                        "FFCC99", "Peach",
                        "FFFF99", "Light yellow",
                        "CCFFCC", "Pale green",
                        "CCFFFF", "Pale cyan",
                        "99CCFF", "Light sky blue",
                        "CC99FF", "Plum",
                        "5734ba", "DC purple",
                    ]
                ]
            ]); ?>
        </div>


        <div id="thai" class="tab-pane fade">

            <?= $form->field($model, 'content_th')->widget(TinyMce::className(), [
                'options' => ['rows' => 8],
                'language' => 'en',
                'clientOptions' => [
                    'plugins' => [
                        "advlist autolink lists link charmap print preview anchor",
                        "searchreplace visualblocks code fullscreen textcolor",
                        "insertdatetime media table contextmenu paste"
                    ],
                    'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | forecolor backcolor",
                    'textcolor_map' => [
                        "000000", "Black",
                        "993300", "Burnt orange",
                        "333300", "Dark olive",
                        "003300", "Dark green",
                        "003366", "Dark azure",
                        "000080", "Navy Blue",
                        "333399", "Indigo",
                        "333333", "Very dark gray",
                        "800000", "Maroon",
                        "FF6600", "Orange",
                        "808000", "Olive",
                        "008000", "Green",
                        "008080", "Teal",
                        "0000FF", "Blue",
                        "666699", "Grayish blue",
                        "808080", "Gray",
                        "FF0000", "Red",
                        "FF9900", "Amber",
                        "99CC00", "Yellow green",
                        "339966", "Sea green",
                        "33CCCC", "Turquoise",
                        "3366FF", "Royal blue",
                        "800080", "Purple",
                        "999999", "Medium gray",
                        "FF00FF", "Magenta",
                        "FFCC00", "Gold",
                        "FFFF00", "Yellow",
                        "00FF00", "Lime",
                        "00FFFF", "Aqua",
                        "00CCFF", "Sky blue",
                        "993366", "Red violet",
                        "FFFFFF", "White",
                        "FF99CC", "Pink",
                        "FFCC99", "Peach",
                        "FFFF99", "Light yellow",
                        "CCFFCC", "Pale green",
                        "CCFFFF", "Pale cyan",
                        "99CCFF", "Light sky blue",
                        "CC99FF", "Plum",
                        "5734ba", "DC purple",
                    ]
                ]
            ]); ?>
        </div>
    </div>

    <?= "<h4>Addition Details</h4>" ?>
    <div class="col-md-12">
        <?= $form->errorSummary($modelDetails); ?>
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#photo">Related photos</a></li>
        </ul>
    </div>
    <div class="tab-content col-md-12">
        <div id="photo" class="tab-pane fade in active">
            <div class="row">
                <?php foreach ($modelDetails as $i => $modelDetail) : ?>
                    <div class="career-profile career-profile-<?= $i ?>" style="margin-top: .75rem;">
                        <div class="col-md-5 col-xs-10">
                            <?= Html::activeHiddenInput($modelDetail, "[$i]id") ?>
                            <?= Html::activeHiddenInput($modelDetail, "[$i]updateType", ['class' => 'update-type']) ?>
                            <?php //echo $form->field($modelDetail, "[$i]career_photo")->fileInput()
                            //
                            echo $form->field($modelDetail, "[$i]career_photo")->widget(FileInput::classname(), [
                                'options' => ['accept' => 'image/*'], 'pluginOptions' => [
                                    'showUpload' => false,
                                    'initialPreview' => [
                                        [Yii::$app->request->BaseUrl."/uploads/career/related_photo/$modelDetail->photo_url"]
                                    ],
                                    'initialPreviewAsData' => true,
                                    'initialCaption' => "$modelDetail->photo_url",
                                    'initialPreviewConfig' => [
                                        ['caption' => $modelDetail->photo_url]
                                    ],
                                    'overwriteInitial' => false,
                                    'maxFileSize' => 100000
                                ],
                            ]);
                            ?>
                        </div>
                        <div class="col-md-1 col-xs-2">
                            <div style="margin-top: 2rem;">
                                <?= Html::button('x', ['class' => 'delete-button-photo btn btn-danger', 'data-target' => "career-profile-$i"]) ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="col-md-12 text-center">
                <?= Html::submitButton('<i class="fa fa-plus"></i> photo', ['name' => 'addRowPhoto', 'value' => 'true', 'class' => 'btn btn-info']) ?>
            </div>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('backend', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
