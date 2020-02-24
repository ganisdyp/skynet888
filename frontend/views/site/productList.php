<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use frontend\models\DC;
use common\models\BrandSearch;
use common\models\ProductSearch;
use common\models\ProductTypeSearch;
define('PAGE_NAME', 'product');
$this->title = Yii::t('common', 'Product');
$this->params['breadcrumbs'][] = $this->title;
$category_list = DC::get_menu_brands();

$searchModel = new ProductTypeSearch();
$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
$product_category = $dataProvider->query->where(['id' => $_GET['id']])->one();

// $searchModel = new BrandSearch();
// $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
// $brands = $dataProvider->query->where([])->orderBy(['code'=>SORT_ASC])->all();

$searchModel = new ProductSearch();
$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

//$products_per_category = $dataProvider->getModels();

$filter = '';

/* if (isset($_GET['c']) && $_GET['c']!='all') {
    $filter = $_GET['c'];
?>
<div id="product-page" class="container">
    <nav class="mt-2 fadeIn animated d07s">
        <ol class="breadcrumb smaller-90 mb-0">
            <li class="breadcrumb-item"><a href="/site/index"><?php echo Yii::t('common', 'Home');?></a></li>
            <li class="breadcrumb-item"><a href="/site/product-category"><?php echo Yii::t('common', 'Product');?></a></li>
            <li class="breadcrumb-item active"><?= $product_category->name; ?></li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-12 fadeIn animated d03s">
            <p class="bigger-160 font-weight-normal text-purple mb-1"><?= $product_category->name; ?></p>
            <div class=""><?= $product_category->description; ?></div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <ul class="nav nav-pills nav-fill">
                <?php foreach ($brands as $brand) { ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($brand->id == $filter) ? 'active' : ''; ?>"
                        href="/site/product-list?id=<?php echo $_GET['id']; ?>&c=<?= $brand->id; ?>"><?= $brand->name; ?></a>
                </li>
                <?php } ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo ('all' == $filter) ? 'active' : ''; ?>"
                        href="/site/product-list?id=<?php echo $_GET['id']; ?>&c=all"><?php echo Yii::t('common', 'all');?></a>
                </li>
            </ul>
        </div>
    </div>
    <div class="row mt-4 mb-4">
        <?php $products_per_category = $dataProvider->query->where(['product_type_id' => $_GET['id'], 'brand_id' => $_GET['c']])->all(); ?>
        <?php foreach ($products_per_category as $product) { ?>
            <div class="col-lg-3 col-md-4 col-12 fadeIn animated d03s">
                <a href="/site/product-view?id=<?php echo $product->id; ?>" class="block">
                    <div class="media-wrapper corner-1">
                        <?php $media_type = $product->media_type;
                        if ($media_type == 1) { ?>
                            <iframe width="100%" height="150" src="<?= $product->main_photo;?>" allowfullscreen></iframe>
                        <?php } else { ?>
                            <div class="img-16by9 holder corner-1">
                                <img class="card-img-top img-responsive" src="/backend/uploads/product/<?= $product->main_photo; ?>">
                            </div>
                        <?php } ?>
                        <div class="media-overlay corner-1"></div>
                    </div>
                </a>
                <a href="/site/product-view?id=<?= $product->id; ?>" class="mt-2 mb-3 block bold"><?= $product->name; ?></a>
            </div>
        <?php } ?>
    </div>
    <div class="clearfix"></div>
</div>
<?php } elseif(isset($_GET['c']) && $_GET['c']=='all'){ */
    $filter = 'all';
?>
<div id="product-page" class="container">
    <nav class="mt-2 fadeIn animated d07s">
        <ol class="breadcrumb smaller-90">
            <li class="breadcrumb-item"><a href="<?php echo Yii::$app->request->BaseUrl; ?>/site/index"><?php echo Yii::t('common', 'Home');?></a></li>
            <li class="breadcrumb-item"><a href="<?php echo Yii::$app->request->BaseUrl; ?>/site/product-category"><?php echo Yii::t('common', 'Product');?></a></li>
            <li class="breadcrumb-item active"><?= $product_category->name; ?></li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-12 fadeIn animated d03s">
            <img src="">
            <p class="h4 bold mb-2"><?= $product_category->name; ?></p>
            <div class=""><?= $product_category->description; ?></div>
        </div>
    </div>
    <?php /*
    <div class="row">
        <div class="col-12">
            <ul class="nav nav-pills nav-fill">
                <?php foreach ($brands as $brand) { ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($brand->id == $filter) ? 'active' : ''; ?>"
                        href="/site/product-list?id=<?php echo $_GET['id']; ?>&c=<?= $brand->id; ?>"><?= $brand->name; ?></a>
                </li>
                <?php } ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo ('all' == $filter) ? 'active' : ''; ?>"
                        href="/site/product-list?id=<?php echo $_GET['id']; ?>&c=all"><?php echo Yii::t('common', 'all');?></a>
                </li>
            </ul>
        </div>
    </div> */ ?>
    <div class="row mt-4 mb-4">
        <?php $products_per_category = $dataProvider->query->where(['product_type_id' => $_GET['id']])->all(); ?>
        <?php foreach ($products_per_category as $product) { ?>
            <div class="col-lg-3 col-md-4 col-12 fadeIn animated d03s">
                <a href="<?php echo Yii::$app->request->BaseUrl; ?>/site/product-view?id=<?php echo $product->id; ?>" class="block">
                    <div class="media-wrapper corner-1">
                        <?php $media_type = $product->media_type;
                        if ($media_type == 1) { ?>
                            <!--  <div class="card-img-top img-responsive corner-0">-->
                            <iframe width="100%" height="150" src="<?= $product->main_photo;?>" allowfullscreen></iframe>
                            <!-- </div>-->
                        <?php } else { ?>
                            <div class="img-1by1 holder corner-1">
                                <img class="card-img-top img-responsive" src="<?php echo Yii::$app->request->BaseUrl; ?>/backend/uploads/product/<?= $product->main_photo; ?>">
                            </div>
                        <?php } ?>
                        <div class="media-overlay corner-1"></div>
                    </div>
                </a>
                <a href="<?php echo Yii::$app->request->BaseUrl; ?>/site/product-view?id=<?= $product->id; ?>" class="mt-2 mb-3 block bold"><?= $product->name; ?></a>
            </div>
        <?php } ?>
    </div>
    <div class="clearfix"></div>
</div>
<?php //} ?>
