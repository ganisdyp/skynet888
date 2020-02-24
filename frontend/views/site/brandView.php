<?php
/**
 * Created by PhpStorm.
 * User: clbs
 * Date: 5/4/2018
 * Time: 2:52 AM
 */

use common\models\BrandSearch;
use common\models\ProductTypeSearch;
use yii\helpers\Html;

$this->title = Yii::t('common', 'Brands');

$searchModel = new BrandSearch();
$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
$brand = $dataProvider->query->where(['id' => $_GET['c']])->one();

$searchModel = new ProductTypeSearch();
$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
$product_categories = $dataProvider->query->where([])->all();
//$product_categories = $dataProvider->getModels();
define('PAGE_NAME', 'brand');
?>
<div id="brand-page" class="container">
    <nav class="mt-2 fadeIn animated d07s">
        <ol class="breadcrumb smaller-90">
            <li class="breadcrumb-item"><a href="/site/index"><?php echo Yii::t('common', 'Home');?></a></li>
            <li class="breadcrumb-item"><a href="/site/brand"><?php echo Yii::t('common', 'Brands');?></a></li>
            <li class="breadcrumb-item active"><?php echo $brand->name ." | ". $brand->code; ?></li>
        </ol>
    </nav>
    <div class="row mb-4">
        <div class="col-12 mb-3 fadeIn animated d03s">
            <p class="bigger-160 font-weight-normal text-purple mb-0"><?php echo $brand->name . " | " . $brand->code; ?></p>
        </div>
        <div class="col-lg-8 col-12 fadeIn animated d03s">
            <div class="pb-3 font-chatthai"><?php echo $brand->description; ?></div>
        </div>
        <div class="col-lg-4 col-12 fadeIn animated d03s">
            <p class="bigger-110 bold mb-2"><?php echo Yii::t('common', 'Product');?></p>
            <div class="card">
                <ul class="list-group list-group-flush link-to-product">
                    <?php foreach($product_categories as $category){ ?>
                    <li class="list-group-item corner-0">
                        <a href="product-list?id=<?= $category->id; ?>&c=<?= $brand->id; ?>" class="clearfix block">
                            <div class="float-left"><?= $category->name; ?></div>
                            <div class="float-right">
                                <i class="fa fa-angle-right"></i>
                            </div>
                        </a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
            <div class="mt-3">
                <a href="/backend/uploads/brand/<?php echo $brand->main_photo; ?>" class="mt-3 hover-box" data-lightbox="true">
                    <div class="img-4by3 holder">
                        <img class="card-img-top img-responsive corner-0" src="/backend/uploads/brand/<?php echo $brand->main_photo; ?>">
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
