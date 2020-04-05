<?php
use backend\modules\content\models\ContactSearch;
define('PAGE_NAME', 'contact-us');

$searchModel_contact = new ContactSearch();
$dataProvider_contact = $searchModel_contact->search(Yii::$app->request->queryParams);

$contact = $dataProvider_contact->query->where([])->one();
$related_photos = $contact->getContactPhotos()->where(['contact_id' => $contact->id])->all();

?>
<div id="page-content">
  <div class="container">
      <div class="row mt-5">
          <div class="col-lg-8 col-md-7 col-12">
              <?php foreach($related_photos as $photo){ ?>
                  <img class="img-fluid" src="../backend/uploads/contact/related_photo/<?= $photo->photo_url;?>">
                  <div style="margin-bottom:20px;"></div>
              <?php } ?>
          </div>
          <div class="col-lg-4 col-md-5 col-12">
              <div class="side-box bg-white-trans d-md-block d-none">
                  <div class="card-body">
                      <p><?= $contact->content; ?></p>
                  </div>
              </div>
              <div class="d-md-none d-block">
                  <div class="card-body bg-white-trans mb-4">
                      <p><?= $contact->content; ?></p>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>