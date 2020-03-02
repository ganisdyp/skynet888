<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Environment */

$this->title = Yii::t('backend', 'Create Environment');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Environments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="existing-environment" id="existing-environment" style="font-size:14pt; margin-bottom:20px;">
    </div>
    <div class="environment-create">

    <?= $this->render('_form', [
        'model' => $model,
        'modelDetails' => $modelDetails,
     //   'modelDetails2' => $modelDetails2,
    ]) ?>

</div>
<?php
$script = <<< JS

function checkEnvironmentExistence(project_id) {
  // alert("Call");
    $.ajax({
  method: "POST",
  url: "loadenvironment",
  data: { project_id: project_id }
    })
  .done(function( msg ) {
   
      document.getElementById("existing-environment").innerHTML = "";
        var index = 1;
       
        for(var i in msg){
            if(i == 0){
                 document.getElementById("existing-environment").innerHTML = "<b>Existing Environment</b><br>";
            }
            
            if(msg[i]){
               
var array = msg[i].split(" ||| ");
var environment_id = array[0];
var environment_photo = array[1];

            document.getElementById("existing-environment").innerHTML += ("<a href='view?id="+environment_id+"'>" +
             "<img src='../../uploads/environment/"+environment_photo+"' class='thumbnail inline' style='height:100px;margin-left:10px;'></a>");
            index++;
            }
        }
  
      
  }); 
  
}
JS;

$this->registerJs($script, \yii\web\View::POS_BEGIN);
