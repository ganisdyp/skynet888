<?php
/**
 * Created by PhpStorm.
 * User: clbs
 * Date: 5/4/2018
 * Time: 1:25 AM
 */
use common\models\ProductSearch;
use common\components\Content;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = Yii::t('common', 'Product');
$searchModel = new ProductSearch();
$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
$product = $dataProvider->query->where(['id' => $_GET['id']])->one();
define('PAGE_NAME', 'product');
?>
<style>
    p{
        font-size:1rem !important;
    }
</style>
<div id="product-page" class="container">
    <nav class="mt-2">
        <ol class="breadcrumb smaller-90 mb-2">
            <li class="breadcrumb-item"><a
                        href="<?php echo Yii::$app->request->BaseUrl . '/site/index'; ?>"><?php echo Yii::t('common', 'Home'); ?></a>
            </li>
            <li class="breadcrumb-item"><a
                        href="<?php echo Yii::$app->request->BaseUrl . '/site/product-category'; ?>"><?php echo Yii::t('common', 'Product'); ?></a>
            </li>
            <li class="breadcrumb-item bold"><a
                        href="/site/product-list?id=<?php echo $product->productType->id; ?>"><?= $product->productType->name; ?></a>
            </li>
            <li class="breadcrumb-item active"><?php echo $product->name; ?></li>
        </ol>
    </nav>

    <div class="clearfix"></div>
    <div class="row mt-3 mb-5">
        <div class="col-lg-5 col-12">
            <?php $media_type = $product->media_type;
            if ($media_type == 1) { ?>
                <iframe width="100%" height="280" src="<?= $product->main_photo; ?>" frameborder="0"
                        allow="autoplay; encrypted-media" allowfullscreen="allowfullscreen"></iframe>
            <?php } else { ?>
                <a href="<?= Yii::$app->request->BaseUrl; ?>/backend/uploads/product/<?= $product->main_photo; ?>"
                   data-lightbox="trip">
                    <div class="img-1by1 holder">
                        <img class="card-img-top img-responsive corner-0"
                             src="<?= Yii::$app->request->BaseUrl; ?>/backend/uploads/product/<?= $product->main_photo; ?>">
                    </div>
                </a>
            <?php } ?>
            <div class="row no-gutters mt-3">
                <?php
                $related_photos = $product->getProductPhotos()->where(['product_id' => $product->id])->all();
                $max = count($related_photos);
                $i=0;
                $table_photo = null;
                foreach ($related_photos as $photo) {

                    if($i==($max-1)){
$table_photo = $photo->photo_url;
                    }else{?>
                    <div class="col-3 pr-2 mb-2">
                        <a href="<?= Yii::$app->getHomeUrl() . 'backend/uploads/product/related_photo/' . $photo->photo_url; ?>"
                           data-lightbox="trip">
                            <div class="img-1by1 holder">
                                <?= Html::img(Yii::$app->getHomeUrl() . 'backend/uploads/product/related_photo/' . $photo->photo_url,
                                    ['class' => 'thumbnail inline', 'width' => '200']) . " "; ?>
                            </div>
                        </a>
                    </div>
                <?php
                    }
                $i++;
                } ?>
            </div>
        </div>
        <div class="col-lg-7 col-12">
            <p class="bigger-160 mb-1 text-purple font-weight-normal"><?php echo $product->name; ?></p>
            <div class="row mb-2">
                <div class="col-md-6 col-12">
                    <span><?= $product->brand->name . " (" . $product->brand->code . ")"; ?></span>
                </div>

            </div>
            <hr class="d-lg-none d-block">
            <div class=""> <?= $product->description; ?> </div>
            <?php if (isset($table_photo)){?>
            <img class="card-img-top img-responsive corner-0"
                 src="<?= Yii::$app->request->BaseUrl; ?>/backend/uploads/product/related_photo/<?= $table_photo; ?>">
            <?php } ?>
            <hr>
            <div>
                <span><?= Yii::t('common', 'tag') . ':' ?></span>
                <?php
                if ($product->keyword) {
                    $keywords = explode(",", $product->keyword);
                    foreach ($keywords as $keyword) {
                        echo "<span title='Keyword' class='badge badge-info' style='font-size:11pt; font-weight:normal;'> <b>" . ltrim(rtrim($keyword)) . " </b></span> ";
                    }
                }
                echo "<br>";
                ?>
            </div>
            <div class="col-lg-10">
                <br>
                <a href="<?php echo Yii::$app->request->BaseUrl.'/site/enquiry?product_id='.$_GET['id']; ?>" class="btn btn-info">SEND AN ENQUIRY</a>
                <?//= Html::button('SEND AN ENQUIRY', ['value' => Url::to('/site/enquiry?product_id=' . $_GET['id']), 'class' => 'btn btn-primary', 'id' => 'modalButton']); ?>
            </div>
            <div class="col-12 mb-2 fadeIn animated d03s">
                <br>
                <?php if (Yii::$app->session->hasFlash('successEnquiry') || Yii::$app->session->hasFlash('errorEnquiry')) { ?>
                    <?php if (Yii::$app->session->hasFlash('successEnquiry')) { ?>
                        <div class="alert alert-success">
                            Thank you for contacting us. We will respond to you as soon as possible.
                        </div>
                    <?php } elseif (Yii::$app->session->hasFlash('errorEnquiry')) { ?>
                        <div class="alert alert-warning">
                            There was an error sending your message.
                        </div>
                    <?php } ?>
                <?php } else {
                } ?>
            </div>
        </div>
        <?php // Modal::begin(['header' => '<h3>SEND AN ENQUIRY</h3>', 'id' => 'modal', 'size' => 'modal-lg']);
        ?>
     <!--   <div class="row" id="modalContent"></div> -->
        <?php
       // Modal::end();
        ?>
    </div>

</div>
