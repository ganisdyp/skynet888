<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;
use kartik\file\FileInput;
use common\models\BrandPhoto;


/* @var $this yii\web\View */
/* @var $model common\models\Brand */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $this->registerJs("
    $('.delete-button-photo').click(function() {
        var detail = $(this).closest('.brand-photo');
        var updateType = detail.find('.update-type');
        if (updateType.val() === " . json_encode(BrandPhoto::UPDATE_TYPE_UPDATE) . ") {
            //marking the row for deletion
            updateType.val(" . json_encode(BrandPhoto::UPDATE_TYPE_DELETE) . ");
            detail.hide();
        } else {
            //if the row is a new row, delete the row
            detail.remove();
        }

    });
       
");
?>
    <div class="brand-form tab-content">


        <?php $form = ActiveForm::begin(['enableClientValidation' => false]); ?>


        <div class="row">
            <div class="col-md-6">
                <?= $form->errorSummary($model); ?>
                <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

            </div>
            <div class="col-md-6"></div>
            <div class="col-md-12">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#english">English</a></li>
                    <li><a data-toggle="tab" href="#thai">Thai</a></li>
                </ul>
            </div>
            <!-- Tab content -->
            <div class="col-md-12">
                <div class="tab-content">
                    <div id="english" class="tab-pane fade in active">
                        <br>
                        <div class="col-md-6">
                            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-6">
                        </div>
                        <div class="col-md-12">
                            <?= $form->field($model, 'description')->widget(TinyMce::className(), [
                                'options' => ['rows' => 6],
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
                        <div class="col-md-6">
                            <?= $form->field($model, 'name_th')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-6">
                        </div>
                        <div class="col-md-12">


                            <?= $form->field($model, 'description_th')->widget(TinyMce::className(), [
                                'options' => ['rows' => 6],
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
                                        /*   "993300", "Burnt orange",
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
                <div class="col-md-12">

                    <div class="col-md-6">
                        <?php
                        if ($model->isNewRecord) {
                            echo $form->field($model, 'main_photo_file')->widget(FileInput::classname(), [
                                'options' => ['accept' => 'image/*'], 'pluginOptions' => [
                                    'showUpload' => false,
                                    'maxFileSize' => 100000
                                ],
                            ]);
                        } else {
                            /*  echo Html::img(Yii::$app->getHomeUrl() . 'uploads/brand/' . $model->main_photo,
                                  ['id' => 'current_img', 'class' => 'thumbnail', 'width' => '150']);*/
                            // $form->field($model, 'main_photo')->hiddenInput(['value' => $model->main_photo])->label(false);
                            echo $form->field($model, 'main_photo_file')->widget(FileInput::classname(), [
                                'options' => ['accept' => 'image/*'], 'pluginOptions' => [
                                    'showUpload' => false,
                                    'initialPreview' => [
                                        [Yii::$app->request->BaseUrl."/backend/uploads/brand/$model->main_photo"]
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
                        }
                        ?>
                        <?php
                        // echo $form->field($model, 'main_photo_file')->fileInput();
                        ?>
                    </div>
                    <div class="col-md-6">
                        <div id="photo" class="tab-pane fade in active">
                            
                                <br>
                                <?php foreach ($modelDetails as $i => $modelDetail) : ?>
                                    <div class="row brand-photo brand-photo-<?= $i ?>">
                                        <div class="col-md-10">
                                            <?= Html::activeHiddenInput($modelDetail, "[$i]id") ?>
                                            <?= Html::activeHiddenInput($modelDetail, "[$i]updateType", ['class' => 'update-type']) ?>

                                            <?php
                                            echo $form->field($modelDetail, "[$i]brand_photo")->widget(FileInput::classname(), [
                                                'options' => ['accept' => 'image/*'], 'pluginOptions' => [
                                                    'showUpload' => false,
                                                    'initialPreview' => [
                                                        [Yii::$app->request->BaseUrl."/backend/uploads/brand/related_photo/$modelDetail->photo_url"]
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
                                            //echo $form->field($modelDetail, "[$i]blog_photo")->fileInput() ?>


                                        </div>
                                        <div class="col-md-2">
                                            <?= Html::button('x', ['class' => 'delete-button-photo btn btn-danger', 'data-target' => "brand-photo-$i"]) ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                                <?= Html::submitButton('<i class="fa fa-plus"></i> photo', ['name' => 'addRowPhoto', 'value' => 'true', 'class' => 'btn btn-info']) ?>

                            <div class="col-md-6"></div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <?= Html::submitButton(Yii::t('backend', 'Save'), ['class' => 'btn btn-success']) ?>
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
<?php

$this->registerJs(' 

    $(document).ready(function(){
    $(\':file\').change(function(){
var file = this.files[0];
var fileType = file["type"];
var ValidImageTypes = ["image/gif", "image/jpeg", "image/png"];
if ($.inArray(fileType, ValidImageTypes) < 0) {
    alert("INVALID FILE TYPE!");
   $(\'#current_img\').show();
   $(\'#brand-main_photo\').val(\'\');
}else{
$(\'#current_img\').hide();
}

      

    });
    });', \yii\web\View::POS_READY);

?>