<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Character */

$this->title = Yii::t('backend', 'Create Character');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Characters'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="existing-character" id="existing-character" style="font-size:14pt; margin-bottom:20px;">
    </div>
<div class="character-create">

    <?= $this->render('_form', [
        'model' => $model,
        'modelDetails' => $modelDetails,
     //   'modelDetails2' => $modelDetails2,
    ]) ?>

</div>

<?php
$script = <<< JS

function checkCharacterExistence(project_id) {
  // alert("Call");
    $.ajax({
  method: "POST",
  url: "loadcharacter",
  data: { project_id: project_id }
    })
  .done(function( msg ) {
   
      document.getElementById("existing-character").innerHTML = "";
        var index = 1;
       
        for(var i in msg){
            if(i == 0){
                 document.getElementById("existing-character").innerHTML = "<b>Existing Character</b><br>";
            }
            
            if(msg[i]){
               
var array = msg[i].split(" ||| ");
var character_id = array[0];
var character_photo = array[1];

            document.getElementById("existing-character").innerHTML += ("<a href='view?id="+character_id+"'>" +
             "<img src='../../uploads/character/"+character_photo+"' class='thumbnail inline' style='height:100px;margin-left:10px;'></a>");
            index++;
            }
        }
  
      
  }); 
  
}
JS;

$this->registerJs($script, \yii\web\View::POS_BEGIN);
