<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = Yii::t('common', 'About');
$this->params['breadcrumbs'][] = $this->title;
define('PAGE_NAME', 'about');
?>
<?php /*
<div class="navbar-main-hero image-section overlay pos-rel py-5">
  <div class="container">
    <div class="row mt-lg-5 mt-3 justify-content-center">
      <div class="col-12 my-lg-5 my-md-5 my-0 py-lg-4 py-0"></div>
      <div class="col-12">
        <div class="d03s fadeInDown animated" data-animation="fadeInDown">
          <p class="h2 mt-5 font-playfair letter-spacing-2 text-uppercase text-brown-dark">Safe Box Thailand</p>
        </div>
      </div>
      <div class="col-lg-6 mt-3 pb-3">
        <div class="d03s fadeIn animated" data-animation="fadeIn">
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        </div>
      </div>
    </div>
  </div>
</div>
*/ ?>
<div id="about-page" class="container">
  <div class="row align-items-center mb-lg-5 mb-4">
    <div class="col-lg-7 col-md-8">
      <div class="section-title viewpoint-animate d03s mb-lg-4 mb-3" data-animation="fadeInDown">
        <h2 class="letter-spacing-1 font-playfair"><?php echo Yii::t('common', 'about_title'); ?></h2>
        <hr>
      </div>
      <div class="viewpoint-animate d03s" data-animation="fadeIn">
        <?php 
          echo '<p>'.Yii::t('common', 'content_about_1').'</p>';
          echo '<p>'.Yii::t('common', 'content_about_2').'</p>';
        ?>
      </div>
    </div>
    <div class="col-lg-5 col-md-4 text-center mt-lg-0 mt-3 viewpoint-animate d03s" data-animation="fadeIn">
      <img src="../images/about/about.jpg" class="img-fluid" alt="safebox thailand">
    </div>
  </div>
</div>
<div id="section-about-point" class="image-section overlay text-white">
  <div class="container">
    <div class="row py-5 align-items-center viewpoint-animate d03s" data-animation="fadeIn">
      <div class="col-lg-6 mb-lg-0 mb-3">
        <div class="section-title">
          <h2 class="letter-spacing-1 font-playfair"><?php echo Yii::t('common', 'need_q'); ?></h2>
        </div>
      </div>
      <div class="col-lg-6 text-lg-right text-center"><a href="<?php echo Yii::$app->request->BaseUrl.'/site/contact/'; ?>" class="btn btn-outline-light"><?php echo Yii::t('common', 'Contact Us'); ?></a></div>
    </div>
  </div>
</div>
<div class="container">
  <div class="row align-items-center mt-5 py-lg-3 py-2">
    <div class="col-lg-6 col-md-4 text-center order-md-1 order-2 mt-md-0 mt-4">
      <div class="p-2 viewpoint-animate d03s" data-animation="fadeIn">
        <div class="holder img-4by3">
          <img src="../images/about-vision.jpg" class="img-fluid" alt="safebox thailand vision">
        </div>
      </div>
    </div>
    <div class="col-lg-6 col-md-8 order-md-2 order-1 text-center">
      <div class="section-title viewpoint-animate d03s" data-animation="fadeInDown">
        <h2 class="letter-spacing-1 font-playfair"><?php echo Yii::t('common', 'mission'); ?></h2>
        <hr class="mx-auto">
      </div>
      <div class="mt-4 viewpoint-animate d03s" data-animation="fadeIn">
        <p><?php echo Yii::t('common', 'mission_content'); ?></p>
      </div>
    </div>
  </div>
  <div class="row align-items-center mb-5 py-lg-3 py-2">
    <div class="col-lg-6 col-md-4 text-center order-md-2 order-1 mt-md-0 mt-4">
      <div class="p-2 viewpoint-animate d03s" data-animation="fadeIn">
        <div class="holder img-4by3">
          <img src="../images/about-mission.jpg" class="img-fluid" alt="safebox thailand mission">
        </div>
      </div>
    </div>
    <div class="col-lg-6 col-md-8 order-md-1 order-2 text-center">
      <div class="section-title viewpoint-animate d03s" data-animation="fadeInDown">
        <h2 class="letter-spacing-1 font-playfair"><?php echo Yii::t('common', 'vision'); ?></h2>
        <hr class="mx-auto">
      </div>
      <div class="mt-4 viewpoint-animate d03s" data-animation="fadeIn">
        <p><?php echo Yii::t('common', 'vision_content'); ?></p>
      </div>  
    </div>
  </div>
</div>
<div class="bg-light-blue">
  <div class="container">
    <div class="row justify-content-center py-5">
      <div class="col-12">
        <div class="section-title text-center mt-3 viewpoint-animate d03s" data-animation="fadeInDown">
          <span class="product-tag bg-blue-light"><?php echo Yii::t('common', 'tag_unique_selling'); ?></span>
          <h2 class="letter-spacing-1 font-playfair mt-3"><?php echo Yii::t('common', 'why_us'); ?></h2>
          <hr class="mx-auto">
        </div>
      </div>
      <div class="col-md-4 text-center mt-4 good-point viewpoint-animate d03s" data-animation="fadeIn">
        <div class="good-icon shadow">
          <img src="../images/icons/shopping-bag-outline.svg" height="54px;">
        </div>
        <p class="text-uppercase bold bigger-110 my-3"><?php echo Yii::t('common', 'why_point_1'); ?></p>
       
      </div>
      <div class="col-md-4 text-center mt-4 good-point viewpoint-animate d03s" data-animation="fadeIn">
        <div class="good-icon shadow">
          <img src="../images/icons/heart-outline.svg" height="54px;">
        </div>
        <p class="text-uppercase bold bigger-110 my-3"><?php echo Yii::t('common', 'why_point_2'); ?></p>
        
      </div>
    </div>
  </div>
</div>