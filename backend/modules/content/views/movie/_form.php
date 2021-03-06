<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\ProjectLang;
use common\models\MoviePhoto;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use kartik\file\FileInput;
use dosamigos\tinymce\TinyMce;

/* @var $this yii\web\View */
/* @var $model common\models\Movie */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $this->registerJs("
    $('.delete-button-photo').click(function() {
        var detail = $(this).closest('.movie-profile');
        var updateType = detail.find('.update-type');
        if (updateType.val() === " . json_encode(MoviePhoto::UPDATE_TYPE_UPDATE) . ") {
            //marking the row for deletion
            updateType.val(" . json_encode(MoviePhoto::UPDATE_TYPE_DELETE) . ");
            detail.hide();
        } else {
            //if the row is a new row, delete the row
            detail.remove();
        }

    });
       
");
?>

<div class="movie-form">
    <?php $form = ActiveForm::begin(['enableClientValidation' => false]); ?>
    <div class="row">
        <div class="col-md-12">
            <?= $form->errorSummary($model); ?>
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#english">English</a></li>
                <li><a data-toggle="tab" href="#thai">Thai</a></li>
            </ul>
        </div>
        <!-- Tab content -->
        <div class="tab-content col-md-8">
            <div id="english" class="tab-pane fade in active">
                <br>
                <div class="col-md-12">
                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-12">
                    <?= $form->field($model, 'description')->widget(TinyMce::className(), [
                        'options' => ['rows' => 10],
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
                                /*  "993300", "Burnt orange",
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
                                  "CC99FF", "Plum",*/
                                "5734ba", "DC purple",
                            ]
                        ]
                    ]); ?>
                </div>
            </div>
            <div id="thai" class="tab-pane fade">
                <br>
                <div class="col-md-12">
                    <?= $form->field($model, 'name_th')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-12">
                    <?= $form->field($model, 'description_th')->widget(TinyMce::className(), [
                        'options' => ['rows' => 10],
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
                                /*  "993300", "Burnt orange",
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
                                  "CC99FF", "Plum",*/
                                "5734ba", "DC purple",
                            ]
                        ]
                    ]); ?>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="col-md-12">
                <br>
                <?= $form->field($model, 'project_id')->dropDownList(ArrayHelper::map(ProjectLang::find()->all(),
                    'project_id', 'name'), ['prompt' => '- Select -','onchange' => 'checkMovieExistence(this.value)'])->label('Related Project') ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <hr style="border-top: 1px solid #c8c8c8; margin-top: 1rem; margin-bottom: 1rem;">
        </div>
        <div class="col-md-12">
            <h4>Media Upload</h4>
        </div>
        <div class="col-md-12">
            <?php
            if ($model->isNewRecord) {
                // Show nothing
                ?>
                <div class="col-md-6">
                    <input id="media-selector" type="checkbox" checked data-toggle="toggle"
                           data-off="<i class='fa fa-film'></i> Video" data-on="<i class='fa fa-image'></i> Image">
                    <br>
                    <div id="video-box" class="col-md-12">
                        <br>
                        <iframe width="324" height="224" src="<?= $model->main_photo; ?>"
                                allowfullscreen></iframe>
                        <?php echo $form->field($model, 'main_photo')->textInput()->label('Media URL'); ?>
                    </div>
                    <div id="image-box" class="col-md-12">
                        <br>
                        <?php
                        /* echo Html::img(Yii::$app->getHomeUrl() . 'uploads/movie/' . $model->main_photo,
                             ['id' => 'current_img', 'class' => 'thumbnail', 'width' => '150']);*/
                        //    echo $form->field($model, 'main_photo_file')->fileInput();
                        echo $form->field($model, 'main_photo_file')->widget(FileInput::classname(), [
                            'options' => ['accept' => 'image/*'], 'pluginOptions' => [
                                'showUpload' => false,
                                'maxFileSize' => 100000
                            ],
                        ]);
                        ?>
                    </div>
                </div>
                <?php
                //  echo $form->field($model, 'main_photo_file')->fileInput();
                //   echo $form->field($model, 'main_photo')->textInput()->label('Video URL');
            } else {
                $media_type = $model->media_type;
                ?>
                <div class="col-md-6">
                    <?php
                    if ($media_type == 1) {
                        ?>
                        <input id="media-selector" type="checkbox" data-toggle="toggle"
                               data-off="<i class='fa fa-film'></i> Video" data-on="<i class='fa fa-image'></i> Image">
                    <?php } else { ?>
                        <input id="media-selector" type="checkbox" checked data-toggle="toggle"
                               data-off="<i class='fa fa-film'></i> Video" data-on="<i class='fa fa-image'></i> Image">

                    <?php } ?>
                    <div id="video-box" class="col-md-12">
                        <br>
                        <iframe width="338" height="238" src="<?= $model->main_photo; ?>"
                                allowfullscreen></iframe>
                        <?php echo $form->field($model, 'main_photo')->textInput()->label('Media URL'); ?>
                    </div>
                    <div id="image-box" class="col-md-12">
                        <br>
                        <?php
                        /* echo Html::img(Yii::$app->getHomeUrl() . 'uploads/movie/' . $model->main_photo,
                             ['id' => 'current_img', 'class' => 'thumbnail', 'width' => '150']);*/
                        // echo $form->field($model, 'main_photo_file')->fileInput();
                        echo $form->field($model, 'main_photo_file')->widget(FileInput::classname(), [
                            'options' => ['accept' => 'image/*'], 'pluginOptions' => [
                                'showUpload' => false,
                                'initialPreview' => [
                                    [Yii::$app->request->BaseUrl."/uploads/movie/$model->main_photo"]
                                ],
                                'initialPreviewAsData' => true,
                                'initialCaption' => "$model->main_photo",
                                'initialPreviewConfig' => [
                                    ['caption' => $model->main_photo]
                                ],
                                'overwriteInitial' => false,
                                'maxFileSize' => 100000
                            ],
                        ]);
                        ?>
                    </div>
                </div>
                <?php
            }
            echo $form->field($model, 'media_type')->hiddenInput()->label(false) ?>

        </div>
    </div>

    <?= "<h4>Addition Details</h4>" ?>
    <div class="row">
        <div class="col-md-12">
            <?= $form->errorSummary($modelDetails); ?>
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#photo">Related photos</a></li>
            </ul>
        </div>
        <!-- Tab content -->
        <div class="tab-content col-md-12">
            <div id="photo" class="tab-pane fade in active">
                <div class="row">
                    <?php foreach ($modelDetails as $i => $modelDetail) : ?>
                        <div class="movie-profile movie-profile-<?= $i ?>" style="margin-top: .75rem;">
                            <div class="col-md-5 col-xs-10">
                                <?= Html::activeHiddenInput($modelDetail, "[$i]id") ?>
                                <?= Html::activeHiddenInput($modelDetail, "[$i]updateType", ['class' => 'update-type']) ?>
                                <?php //echo $form->field($modelDetail, "[$i]movie_photo")->fileInput()
                                //
                                echo $form->field($modelDetail, "[$i]movie_photo")->widget(FileInput::classname(), [
                                    'options' => ['accept' => 'image/*'], 'pluginOptions' => [
                                        'showUpload' => false,
                                        'initialPreview' => [
                                            [Yii::$app->request->BaseUrl."/uploads/movie/related_photo/$modelDetail->photo_url"]
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
                                    <?= Html::button('x', ['class' => 'delete-button-photo btn btn-danger', 'data-target' => "movie-profile-$i"]) ?>
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
        <div class="form-group col-md-12 text-right">
            <hr style="border-top: 1px solid #c8c8c8;">
            <?= Html::submitButton(Yii::t('backend', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end();

        $this->registerJs(' 
  $(\'#media-selector\').change(function(){
    var isImage = $(\'#media-selector\').is(\':checked\'); 
    if(isImage){
     $(\'#video-box\').hide();
   $(\'#image-box\').show();
    $(\'#movie-media_type\').val(2);
  
    }else{
     $(\'#image-box\').hide();
   $(\'#video-box\').show();
     $(\'#movie-media_type\').val(1);
  
    }
    });
    $(document).ready(function(){

       var isImage = $(\'#media-selector\').is(\':checked\'); 
        if(isImage){
          $(\'#video-box\').hide();
   $(\'#image-box\').show();
    $(\'#movie-media_type\').val(2);
        }else{
         $(\'#image-box\').hide();
   $(\'#video-box\').show();
     $(\'#movie-media_type\').val(1);
          
        }
       
      $(\':file\').change(function(){
var file = this.files[0];
var fileType = file["type"];
var ValidTypes = ["image/gif", "image/jpeg", "image/png"];
if ($.inArray(fileType, ValidTypes) < 0) {
    alert("INVALID FILE TYPE!");
   $(\'#current_img\').show();
   $(\'#movie-main_photo\').val(\'\');
}else{
$(\'#current_img\').hide();
}
    });
  
    });', \yii\web\View::POS_READY);

        ?>
    </div>
