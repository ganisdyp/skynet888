<?php
use backend\modules\content\models\CareerSearch;
define('PAGE_NAME', 'careers');

$searchModel_career = new CareerSearch();
$dataProvider_career = $searchModel_career->search(Yii::$app->request->queryParams);

$career = $dataProvider_career->query->where([])->one();
$related_photos = $career->getCareerPhotos()->where(['career_id' => $career->id])->all();

?>
<div id="page-content">
  <div class="container">
      <div class="row mt-5">
          <div class="col-lg-8 col-md-7 col-12">
              <?php foreach($related_photos as $photo){ ?>
                  <img class="img-fluid" src="../backend/uploads/career/related_photo/<?= $photo->photo_url;?>">
                  <div style="margin-bottom:20px;"></div>
              <?php } ?>
          </div>
          <div class="col-lg-4 col-md-5 col-12">
              <div class="side-box bg-white-trans d-md-block d-none">
                  <div class="card-body">
                      <p><?= $career->content; ?></p>
                  </div>
              </div>
              <div class="d-md-none d-block">
                  <div class="card-body bg-white-trans mb-4">
                      <p><?= $career->content; ?></p>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>