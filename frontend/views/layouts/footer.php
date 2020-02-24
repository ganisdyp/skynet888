<?php
use yii\helpers\Html;
use frontend\models\DC;
use common\models\BlogtypeSearch;
use common\models\BlogSearch;

//$category_list = DC::get_menu_brands();
$searchModel = new BlogtypeSearch();
$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
$blog_categories = $dataProvider->getModels();

$searchModel_blog = new BlogSearch();
$dataProvider_blog = $searchModel_blog->search(Yii::$app->request->queryParams);

$blog_list = $dataProvider_blog->query->where([])->orderBy(['date_published' => SORT_DESC])->all();
$menu_list = DC::get_menu();
$brands = DC::get_menu_brands();
echo '</div>';

?>
<footer>
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-6 order-md-1 order-2 text-lg-left text-center my-2">
        <img src="../images/logo.png" height="67px;" alt="safebox siam">
      </div>
      <div class="col-md-6 order-md-2 order-1 text-lg-right text-center my-2">
        <div class="social">
          <a href="https://web.facebook.com/SAFEBOXSIAMTH/?__tn__=%2Cd%2CP-R&eid=ARB8Yfn6Ewu4t0Lkr8QlRdZS79AzV4BpTF376uWgcgwOMOU2Y78QZWUkQm0Ksb5KSmoBcOG7iaEtqJ3b" class="fa-stack mx-1" style="vertical-align: top;">
            <i class="fa fa-circle fa-stack-2x"></i>
            <i class="fa fa-facebook-f fa-stack-1x fa-inverse"></i>
          </a>
          <a href="https://www.instagram.com/invites/contact/?i=1m3zu9sqnfm6b&utm_content=6ni9928" class="fa-stack mx-1" style="vertical-align: top;">
            <i class="fa fa-circle fa-stack-2x"></i>
            <i class="fa fa-instagram fa-stack-1x fa-inverse"></i>
          </a>
          <a href="http://nav.cx/cEPLK0u" class="fa-stack mx-1" style="vertical-align: top;">
            <i class="fa fa-circle fa-stack-2x"></i>
            <i class="fa fa-phone fa-stack-1x fa-inverse"></i>
          </a>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-3 smaller-90 my-2">
        <p class="text-uppercase bigger-120 mb-2"><?php echo Yii::t('common', 'Product'); ?></p>
          <?php for ($i = 0; $i < count($brands); $i++) {
          $brand = $brands[$i];
          // print_r($product_c);
          ?>
       
        <ul class="footer-nav nav flex-column align-items-start">
          <li class="nav-item"><a href="<?= $brand['link'] ?>" class="nav-link"><?= $brand['text'] ?></a></li>
        </ul>
          <?php } ?>
      </div>
      <div class="col-md-3 smaller-90 my-2">
        <p class="text-uppercase bigger-120 mb-2"><?php echo Yii::t('common', 'site_map'); ?></p>
        <ul class="footer-nav nav flex-column align-items-start">
        <?php foreach ($menu_list as $menu) { ?>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo $menu['link']; ?>"><?php echo $menu['text']; ?></a>
          </li>
        <?php } ?>
        </ul>
      </div>
      <div class="col-md-3 smaller-90 my-2">
        <p class="text-uppercase bigger-120 mb-2"><?php echo Yii::t('common', 'Latest Blogs'); ?></p>
        <ul class="footer-nav nav flex-column align-items-start">
          <li class="nav-item"><a href="<?= Yii::$app->request->BaseUrl.'/site/blog-view?id='.$blog_list[0]->id ?>" class="nav-link"><?= $blog_list[0]->headline; ?></a></li>
        </ul>
      </div>
      <div class="col-md-3 smaller-90 my-2">
        <p class="text-uppercase bigger-120 mb-2"><?php echo Yii::t('common', 'Contact'); ?></p>
        <div class="d-flex my-1">
          <img src="../images/icons/pin-outline.svg" height="24px" class="mr-1">
          <div>
            <div class="smaller-90"><?php echo Yii::t('common', 'address_content_1'); ?></div>
          </div>
        </div>
        <div class="d-flex my-2">
          <img src="../images/icons/phone-outline.svg" height="24px" class="mr-1">
          <div>062-886-8999</div>
        </div>
        <div class="d-flex my-1">
          <img src="../images/icons/email-outline.svg" height="24px" class="mr-1">
          <div>safeboxsiam@gmail.com</div>
        </div>
      </div>
      <div class="col-12">
        <hr class="mt-1">
        <div class="d-flex justify-content-between text-gray smaller-80">
          <p><?php echo Yii::t('common', 'Allright'); ?></p>
        </div>
      </div>
    </div>
  </div>
</footer>