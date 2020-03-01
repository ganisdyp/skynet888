<?php
use backend\modules\content\models\AboutSearch;
define('PAGE_NAME', 'index');

$searchModel_about = new AboutSearch();
$dataProvider_about = $searchModel_about->search(Yii::$app->request->queryParams);

$about = $dataProvider_about->query->where([])->one();
$related_photos = $about->getAboutPhotos()->where(['about_id' => $about->id])->all();

?>
<div id="page-content">
    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-8 col-md-7 col-12 order-md-1 order-2">
                <?php foreach($related_photos as $photo){ ?>
                    <img class="img-fluid" src="../backend/uploads/about/related_photo/<?= $photo->photo_url;?>">
                    <div style="margin-bottom:20px;"></div>
                <?php } ?>
            </div>
            <div class="col-lg-4 col-md-5 col-12 order-md-2 order-1">
                <div class="side-box bg-white-trans d-md-block d-none">
                    <div class="card-body">
                        <p><?= $about->content; ?></p>
                    </div>
                </div>
                <div class="d-md-none d-block">
                    <div class="card-body bg-white-trans mb-4">
                        <p><?= $about->content; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
/*
<div id="page-content">
  <div class="container">
    <div class="row my-5">
      <div class="col-12 mb-3">
        <h2>About Us Page</h2>
      </div>
      <div class="col-lg-7 col-md-6 order-md-1 order-2">
        <div style="width: 100%; height: 40vh; background-color: #fff; margin-bottom: 30px;"></div>
        <div style="width: 100%; height: 40vh; background-color: #fff; margin-bottom: 30px;"></div>
      </div>
      <div class="col-lg-5 col-md-6 order-md-2 order-1">
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nec feugiat nisl pretium fusce. Ornare aenean euismod elementum nisi quis eleifend quam. Tellus in hac habitasse platea dictumst vestibulum rhoncus est. Velit euismod in pellentesque massa placerat. Amet tellus cras adipiscing enim. Sit amet porttitor eget dolor morbi non arcu risus quis. Id faucibus nisl tincidunt eget nullam non nisi. Elit eget gravida cum sociis natoque penatibus et magnis. Vitae congue eu consequat ac felis. Eget nunc lobortis mattis aliquam faucibus purus in.</p>
        <p>Ornare massa eget egestas purus viverra accumsan in nisl nisi. Nisi quis eleifend quam adipiscing vitae proin sagittis nisl. Pretium quam vulputate dignissim suspendisse in est ante. Suspendisse potenti nullam ac tortor vitae purus faucibus ornare. Mattis aliquam faucibus purus in massa tempor nec feugiat nisl. Ut tortor pretium viverra suspendisse potenti nullam ac tortor. Turpis massa tincidunt dui ut ornare lectus sit. Lectus nulla at volutpat diam ut.</p>
      </div>
    </div>
  </div>
</div>
*/
?>