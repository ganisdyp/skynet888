<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Screenshot */

$this->title = Yii::t('backend', 'Create Screenshot');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Screenshots'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="existing-screenshot" id="existing-screenshot" style="font-size:14pt; margin-bottom:20px;">

    </div>
    <div class="screenshot-create">

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>

    </div>

<?php
$script = <<< JS

function checkScreenshotExistence(project_id) {
  // alert("Call");
    $.ajax({
  method: "POST",
  url: "loadscreenshot",
  data: { project_id: project_id }
    })
  .done(function( msg ) {
   
      document.getElementById("existing-screenshot").innerHTML = "";
        var index = 1;
       
        for(var i in msg){
            if(i == 0){
                 document.getElementById("existing-screenshot").innerHTML = "<b>Existing Screenshot</b><br>";
            }
            
            if(msg[i]){
               
var array = msg[i].split(" ||| ");
var screenshot_id = array[0];
var screenshot_photo = array[1];

            document.getElementById("existing-screenshot").innerHTML += ("<a href='view?id="+screenshot_id+"'>" +
             "<img src='../../uploads/screenshot/"+screenshot_photo+"' class='thumbnail inline' style='height:100px;margin-left:10px;'></a>");
            index++;
            }
        }
  
      
  }); 
  
}
JS;

$this->registerJs($script, \yii\web\View::POS_BEGIN);
