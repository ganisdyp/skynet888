<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = Yii::t('common', 'Contact');
$this->params['breadcrumbs'][] = $this->title;
define('PAGE_NAME', 'contact');
?>
<div id="contact-page" class="container mb-5 pb-4">
  <div class="row">
      <div class="col-12">
          <div class="section-title text-center viewpoint-animate d03s" data-animation="fadeInDown">
              <h2 class="letter-spacing-1 font-playfair"><?php echo Yii::t('common', 'Contact Us'); ?></h2>
              <hr class="mx-auto">
          </div>
          <div class="mt-4 viewpoint-animate d03s" data-animation="fadeIn">
              <?php
              echo '<center><p>'.Yii::t('common', 'service_content_3').'</p></center>';
              ?>
          </div>
      </div>
    <div class="offset-md-3 col-md-6 text-center mb-4 viewpoint-animate d03s" data-animation="fadeInDown">
      <div class="my-4"><?php echo Yii::t('common', 'contact_content'); ?></div>
    </div>
    <div class="col-md-4 text-center mb-2 fadeIn animated d03s">
      <img src="../images/icons/pin-outline-dark.svg" height="90px" class="mb-3">
      <p class="bold bigger-120"><?php echo Yii::t('common', 'address'); ?></p>
      <div>
        <?php echo Yii::t('common', 'address_content_1'); ?>

      </div>
    </div>
    <div class="col-md-4 text-center mb-2 fadeIn animated d03s">
      <img src="../images/icons/email-outline-dark.svg" height="90px" class="mb-3">
      <p class="bold bigger-120"><?php echo Yii::t('common', 'contact_header'); ?></p>
      <div>
        <div><?php echo Yii::t('common', 'email'); ?> : safeboxsiam@gmail.com</div>
        <div><?php echo Yii::t('common', 'phone'); ?> : 062-886-8999</div>
      </div>
    </div>
    <div class="col-md-4 text-center mb-2 fadeIn animated d03s">
      <img src="../images/icons/phone-outline-dark.svg" height="90px" class="mb-3">
      <p class="bold bigger-120"><?php echo Yii::t('common', 'business_hour'); ?></p>
      <div>
          <?php echo Yii::t('common', 'business_hour_1'); ?>
        <br> <?php echo Yii::t('common', 'business_hour_2'); ?>
      </div>
    </div>
  </div>
  <hr class="my-5">
  <div class="row">
    <div class="col-12 mb-2 fadeIn animated d03s">
      <?php if (Yii::$app->session->hasFlash('successContact') || Yii::$app->session->hasFlash('errorContact')): ?>
        <?php  if (Yii::$app->session->hasFlash('successContact')): ?>
          <div class="alert alert-success">
            Thank you for contacting us. We will respond to you as soon as possible.
          </div>
        <?php elseif(Yii::$app->session->hasFlash('errorContact')): ?>
          <div class="alert alert-warning">
            There was an error sending your message.
          </div>
        <?php endif; ?>
      <?php else: ?>
      <h4 class="mb-3"><?php echo Yii::t('common', 'send_email');?></h4>
      <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
      <div class="row">
        <div class="col-lg-4 col-md-6">
          <div class="form-group">
            <label><?php echo Yii::t('common', 'company_name'); ?></label>
            <?= $form->field($model, 'company_name')->textInput(['autofocus' => true, 'class' => 'form-control', 'max-length' => '30', 'placeholder' => Yii::t('common', 'company_name').' *', 'aria-required' => true])->label(false) ?>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="form-group">
            <label><?php echo Yii::t('common', 'contact_person'); ?></label>
            <?= $form->field($model, 'name')->textInput(['autofocus' => true, 'class' => 'form-control', 'max-length' => '30', 'placeholder' => Yii::t('common', 'contact_person').' *', 'aria-required' => true])->label(false) ?>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="form-group">
            <label><?php echo Yii::t('common', 'email'); ?></label>
            <?= $form->field($model, 'email')->textInput(['type' => 'email', 'autofocus' => true, 'class' => 'form-control', 'max-length' => '30', 'placeholder' => Yii::t('common', 'email').' *', 'aria-required' => true])->label(false) ?>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="form-group">
            <label><?php echo Yii::t('common', 'phone_number'); ?></label>
            <?= $form->field($model, 'tel')->textInput(['type' => 'tel', 'autofocus' => true, 'class' => 'form-control', 'max-length' => '10', 'placeholder' => Yii::t('common', 'phone_number').' *', 'aria-required' => true])->label(false) ?>
          </div>
        </div>
        <div class="col-lg-8">
          <div class="form-group">
            <label><?php echo Yii::t('common', 'subject'); ?></label>
            <?= $form->field($model, 'subject')->textInput(['autofocus' => true, 'class' => 'form-control', 'max-length' => '40', 'placeholder' => Yii::t('common', 'subject').' *', 'aria-required' => true])->label(false) ?>
          </div>
        </div>
      </div>

      <div class="form-group">
        <label><?php echo Yii::t('common', 'message'); ?></label>
        <?= $form->field($model, 'body')->textarea(['rows' => 6, 'placeholder' => Yii::t('common', 'message').' *'])->label(false) ?>
      </div>

      <div class="row">
        <div class="col-lg-6">
          <div class="form-group">
            <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), ['options' => [
              'placeholder' => 'Enter the letters displayed',
              'class' => 'form-control form-custom',
            ],
              'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>'])->label(false) ?>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="text-right">
            <?= Html::submitButton(Yii::t('common', 'submit'), ['class' => 'btn btn-primary', 'name' => 'contact-submit']) ?>
          </div>
        </div>
      </div>
      
      <?php ActiveForm::end(); ?>
      <?php endif; ?>
    </div>
  </div>
</div>

<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15480.686023410137!2d100.5965716!3d14.0670477!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x1ebfbb66fbb33d2b!2sSAFE%20BOX%20SIAM%20CO.%2CLTD.!5e0!3m2!1sen!2sth!4v1572682837271!5m2!1sen!2sth" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
<div class="clearfix"></div>