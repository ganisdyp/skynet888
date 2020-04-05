<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Movie */

$this->title = Yii::t('backend', 'Create Movie / Trailor');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Movies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="existing-movie" id="existing-movie" style="font-size:14pt; margin-bottom:20px;">
    </div>
</div>
<div class="movie-create">

    <?= $this->render('_form', [
        'model' => $model,
        'modelDetails' => $modelDetails,
     //   'modelDetails2' => $modelDetails2,
    ]) ?>

</div>

<?php
$script = <<< JS

function checkMovieExistence(project_id) {
  // alert("Call");
    $.ajax({
  method: "POST",
  url: "loadmovie",
  data: { project_id: project_id }
    })
  .done(function( msg ) {
   
      document.getElementById("existing-movie").innerHTML = "";
        var index = 1;
       
        for(var i in msg){
            if(i == 0){
                 document.getElementById("existing-movie").innerHTML = "<span style='margin-left:20px;'><b>Existing Movie / Trailor</b></span><br>";
            }
            
            if(msg[i]){
               
var array = msg[i].split(" ||| ");
var movie_id = array[0];
var temp = array[1];

var array2 = temp.split(" |x| ");
var movie_media = array2[0];
var movie_name = array2[1];
            document.getElementById("existing-movie").innerHTML += ("<div class='col-md-2 col-sm-4' style='text-align:center;'><a href='view?id="+movie_id+"'>" +
             "<iframe src='"+movie_media+"' width='100%' height='100%' style='margin-left:10px;' frameborder='0' allow='accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe><br>"+movie_name+"</a></div>");
            index++;
            }
        }
  
      
  }); 
  
}
JS;

$this->registerJs($script, \yii\web\View::POS_BEGIN);
