<?php
use backend\modules\content\models\HomeSearch;
define('PAGE_NAME', 'index');

$searchModel_home = new HomeSearch();
$dataProvider_home = $searchModel_home->search(Yii::$app->request->queryParams);

$home = $dataProvider_home->query->where(['id'=>'1'])->one();
$related_photos = $home->getHomePhotos()->where(['home_id' => $home->id])->all();

?>
<div id="page-content">
    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-8 col-md-7 col-12">
                <?php foreach($related_photos as $photo){ ?>
                    <img class="img-fluid" src="../backend/uploads/home/related_photo/<?= $photo->photo_url;?>">
                    <div style="margin-bottom:20px;"></div>
                <?php } ?>
            </div>
            <div class="col-lg-4 col-md-5 col-12">
                <div class="side-box bg-white-trans d-md-block d-none">
                    <div class="card-body">
                        <p><?= $home->content; ?></p>
                    </div>
                </div>
                <div class="d-md-none d-block">
                    <div class="card-body bg-white-trans mb-4">
                        <p><?= $home->content; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>