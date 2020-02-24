<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = Yii::t('common', 'Services');
$this->params['breadcrumbs'][] = $this->title;
define('PAGE_NAME', 'services');
?>

<div class="container">
  <div class="row justify-content-center my-5">
    <div class="col-12">
      <div class="section-title text-center viewpoint-animate d03s" data-animation="fadeInDown">
        <h2 class="letter-spacing-1 font-playfair"><?php echo Yii::t('common', 'our_service'); ?></h2>
        <hr class="mx-auto">
      </div>
      <div class="mt-4 viewpoint-animate d03s" data-animation="fadeIn">
        <?php
          echo '<center><p>'.Yii::t('common', 'service_content_3').'</p></center>';
        ?>
      </div>
    </div>
    <div class="col-lg-8">
      <img src="../images/service.jpg" class="img-fluid mt-2 mb-3" alt="safebox thailand service">
    </div>
  </div>
</div>
<div class="bg-light-blue py-5">
  <div class="container">
    <div class="row viewpoint-animate d03s" data-animation="fadeIn">
      <div class="col-lg-4 mb-lg-0 mb-4">
        <div class="card card-event">
          <div class="card-header text-center bold"><?php echo Yii::t('common', 'service_type_1'); ?></div>
          <div class="card-image pos-rel">
            <div class="img-4by3 holder">
              <img class="card-img-top img-fluid" src="../images/service/manual-training.jpg">
            </div>
          </div>
          <div class="card-body">
            <?php echo Yii::t('common', 'service_type_1_content'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-4 mb-lg-0 mb-4">
        <div class="card card-event">
          <div class="card-header text-center bold"><?php echo Yii::t('common', 'service_type_2'); ?></div>
          <div class="card-image pos-rel">
            <div class="img-4by3 holder">
              <img class="card-img-top img-fluid" src="../images/service/repair.jpg">
            </div>
          </div>
          <div class="card-body">
            <?php echo Yii::t('common', 'service_type_2_content'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-4 mb-lg-0 mb-4">
        <div class="card card-event">
          <div class="card-header text-center bold"><?php echo Yii::t('common', 'service_type_3'); ?></div>
          <div class="card-image pos-rel">
            <div class="img-4by3 holder">
              <img class="card-img-top img-fluid" src="../images/service/relocation.png">
            </div>
          </div>
          <div class="card-body">
            <?php echo Yii::t('common', 'service_type_3_content'); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>