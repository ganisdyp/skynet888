<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use common\models\ProductSearch;
$this->title = Yii::t('common', 'Contact');
$this->params['breadcrumbs'][] = $this->title;
define('PAGE_NAME', 'enquiry');


$searchModel = new ProductSearch();
$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
$product = $dataProvider->query->where(['id' => $product_id])->one();
?>
<div id="contact-page" class="container mb-5 pb-4">
  <div class="row">
    <div class="col-12 mb-2 fadeIn animated d03s">
      <?php if (Yii::$app->session->hasFlash('successEnquiry') || Yii::$app->session->hasFlash('errorEnquiry')): ?>
        <?php  if (Yii::$app->session->hasFlash('successEnquiry')): ?>
          <div class="alert alert-success">
            Thank you for contacting us. We will respond to you as soon as possible.
          </div>
        <?php elseif(Yii::$app->session->hasFlash('errorEnquiry')): ?>
          <div class="alert alert-warning">
            There was an error sending your message.
          </div>
        <?php endif; ?>
      <?php else: ?>
      <h4 class="mb-3"><?php echo Yii::t('common', 'send_enquiry');?></h4>
      <?php $form = ActiveForm::begin(['id' => 'enquiry-form']); ?>
      <div class="row">
          <div class="col-lg-8">
              <div class="form-group">
                  <label><?php echo Yii::t('common', 'subject'); ?></label>
                  <?= $form->field($model, 'subject')->textInput(['autofocus' => true, 'class' => 'form-control', 'max-length' => '40','value'=>Yii::t('common','enquiry_about').' '.$product->name, 'placeholder' => Yii::t('common', 'subject').' *', 'aria-required' => true])->label(false) ?>
              </div>
          </div>
        <div class="col-lg-6 col-md-6">
          <div class="form-group">
            <label><?php echo Yii::t('common', 'contact_person'); ?></label>
            <?= $form->field($model, 'name')->textInput(['autofocus' => true, 'class' => 'form-control', 'max-length' => '30', 'placeholder' => Yii::t('common', 'contact_person').' *', 'aria-required' => true])->label(false) ?>
          </div>
        </div>
        <div class="col-lg-6 col-md-6">
          <div class="form-group">
            <label><?php echo Yii::t('common', 'email'); ?></label>
            <?= $form->field($model, 'email')->textInput(['type' => 'email', 'autofocus' => true, 'class' => 'form-control', 'max-length' => '30', 'placeholder' => Yii::t('common', 'email').' *', 'aria-required' => true])->label(false) ?>
          </div>
        </div>
        <div class="col-lg-6 col-md-6">
          <div class="form-group">
            <label><?php echo Yii::t('common', 'phone_number'); ?></label>
            <?= $form->field($model, 'tel')->textInput(['type' => 'tel', 'autofocus' => true, 'class' => 'form-control', 'max-length' => '10', 'placeholder' => Yii::t('common', 'phone_number').' *', 'aria-required' => true])->label(false) ?>
          </div>
        </div>
          <div class="col-lg-6 col-md-6">
              <div class="form-group">
                  <label><?php echo Yii::t('common', 'address'); ?></label>
                  <?= $form->field($model, 'address')->textInput(['autofocus' => true, 'class' => 'form-control', 'max-length' => '30', 'placeholder' => Yii::t('common', 'address').' (Optional)'])->label(false) ?>
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
          <?= $form->field($model, 'product_id')->hiddenInput(['class' => 'form-control', 'value' => $product->id])->label(false) ?>
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

<div class="clearfix"></div>