<?php
use common\models\BlogSearch;

define('PAGE_NAME', 'news');

$searchModel_news = new BlogSearch();
$dataProvider_news = $searchModel_news->search(Yii::$app->request->queryParams);

$news = $dataProvider_news->query->where([])->one();
$related_photos = $news->getBlogPhotos()->where(['blog_id' => $news->id])->all();
?>
<div id="page-content">
    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-8 col-md-7 col-12 order-md-1 order-2">
                <img class="img-fluid" src="../backend/uploads/blog/<?= $news->main_photo;?>">
                <div style="margin-bottom:20px;"></div>
                <?php foreach($related_photos as $photo){ ?>
                <img class="img-fluid" src="../backend/uploads/blog/related_photo/<?= $photo->photo_url;?>">
                    <div style="margin-bottom:20px;"></div>
                <?php } ?>
            </div>
            <div class="col-lg-4 col-md-5 col-12 order-md-2 order-1">
                <div class="side-box bg-white-trans d-md-block d-none">
                    <div class="card-body">
                        <p><?= $news->headline ?></p>
                        <p><?= $news->description; ?></p>
                    </div>
                </div>
                <div class="d-md-none d-block">
                    <div class="card-body bg-white-trans mb-4">
                        <p><?= $news->headline ?></p>
                        <p><?= $news->description; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>