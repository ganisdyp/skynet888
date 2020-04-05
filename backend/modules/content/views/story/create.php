<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Story */

$this->title = Yii::t('backend', 'Create Story');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Storys'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="existing-story" id="existing-story" style="font-size:14pt; margin-bottom:20px;">

    </div>
<div class="story-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php
$script = <<< JS

function checkStoryExistence(project_id) {
  // alert("Call");
    $.ajax({
  method: "POST",
  url: "loadstory",
  data: { project_id: project_id }
    })
  .done(function( msg ) {
       document.getElementById("existing-story").innerHTML = "<b style='color:#605CA8;'>Existing Story</b><br>";
      if(msg[0]){
          alert("Story does exist! Please update story instead of creating new one.");
          var str = msg[0];
var array = str.split(" ||| ");
var story_id = array[0];
var story_name = array[1];
          document.getElementById("existing-story").innerHTML += ("&#8226 <a href='view?id="+story_id+"'>"+story_name+"</a>")+"<br>";
   
   
   $("#submit-button").prop('disabled', true);
      }else{
         document.getElementById("existing-story").innerHTML = "";
        $("#submit-button").prop('disabled', false);
      }
      
   // var projects = JSON.parse(msg);
  /*  var index = 1;
    document.getElementById("existing-story").innerHTML = "<b>Existing Story</b><br>";
  for(var i in msg){
      
      document.getElementById("existing-story").innerHTML += ("&#8226 "+msg[i])+"<br>";
  index++;
  }*/
  
  }); 
  
}
JS;

$this->registerJs($script, \yii\web\View::POS_BEGIN);
