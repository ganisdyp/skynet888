<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use frontend\models\DC;
use common\models\BlogtypeSearch;
use common\models\BlogSearch;

define('PAGE_NAME', 'blog');
$this->title = Yii::t('common', 'Blog');
$this->params['breadcrumbs'][] = $this->title;

//$category_list = DC::get_menu_brands();
$searchModel = new BlogtypeSearch();
$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
$blog_categories = $dataProvider->getModels();

$searchModel_blog = new BlogSearch();
$dataProvider_blog = $searchModel_blog->search(Yii::$app->request->queryParams);

$blog_list = $dataProvider_blog->query->where([])->all();
?>
<div id="blog-page" class="container">
    <nav class="mt-2 fadeIn animated d07s">
      <ol class="breadcrumb smaller-90">
        <li class="breadcrumb-item"><a href="<?php echo Yii::$app->request->BaseUrl.'/site/index'; ?>"><?= Yii::t('common', 'Home'); ?></a></li>
        <li class="breadcrumb-item active"><?= Yii::t('common', 'Blog'); ?></li>
      </ol>
    </nav>
    <div class="row fadeIn animated d03s mt-3 mb-4">
      <?php /* foreach ($blog_categories as $blog_category) { ?>
      <div class="col-lg-4 col-md-6 col-12">
        <div class="card dc-card mb-4 corner-0 z-shadow fadeIn animated d03s">
          <a href="blog-list?id=<?= $blog_category->id; ?>&c=all" class="hover-box">
            <div class="img-16by9 holder">
              <img class="card-img-top img-responsive corner-0"
                src="/backend/uploads/blog_type/<?= $blog_category->main_photo; ?>">
            </div>
          </a>
          <div class="card-body text-center">
            <a href="blog-list?id=<?= $blog_category->id; ?>&c=all"
              class="card-title font-weight-normal bigger-110 my-0 block"><?= $blog_category->name; ?></a>
          </div>
        </div>
      </div>
      <?php } */ ?>
      <?php foreach ($blog_list as $blog) { ?>
      <div class="col-md-6 mb-lg-0 mb-4 viewpoint-animate d03s" data-animation="fadeIn">
        <a href="<?php echo Yii::$app->request->BaseUrl.'/site/blog-view?id='.$blog->id; ?>">
          <div class="card card-event">
            <div class="card-image pos-rel">
              <div class="media-wrapper">
                <?php if ($blog->media_type == 1) { ?>
                <iframe width="100%" height="220" src="<?= $blog->main_photo; ?>"
                  allowfullscreen></iframe>
                <?php } else { ?>
                  <div class="img-4by3 holder">
                    <img class="card-img-top img-fluid"
                      src="/backend/uploads/blog/<?= $blog->main_photo; ?>">
                  </div>
                <?php } ?>
              </div>
            </div>
            <div class="card-body">
              <?php $date_published = date_create($blog->date_published); ?>
              <div class="card-datetime smaller-90"><?php echo date_format($date_published, "j F Y"); ?></div>
              <div class="card-title bold"><?php echo $blog->headline; ?></div>
              <div class="card-detail">
                <?php
                  $string = strip_tags($blog->description);
                  if (strlen($string) > 450) {
                    // truncate string
                    $stringCut = substr($string, 0, 450);
                    $endPoint = strrpos($stringCut, ' ');

                    //if the string doesn't contain any space then it will cut without word basis.
                    $string = $endPoint? substr($stringCut, 0, $endPoint):substr($stringCut, 0);
                    $string .= '...';
                  }
                  echo $string;
                ?>
              </div>
              <div class="text-center mt-4">
                <div class="btn btn-outline-dark btn-block px-5"><?php echo Yii::t('common', 'read_more'); ?></div>
              </div>
            </div>
          </div>
        </a>
      </div>
      <?php } ?>
      <div class="clearfix"></div>
    </div>
</div>