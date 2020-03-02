<?php

use backend\modules\content\models\ProjectovSearch;
use common\models\ProjectSearch;

define('PAGE_NAME', 'projects');

$searchModel_project = new ProjectSearch();
$dataProvider_project = $searchModel_project->search(Yii::$app->request->queryParams);
$projects = $dataProvider_project->query->where(['status'=>'Active'])->all();

$searchModel_projectov = new ProjectovSearch();
$dataProvider_projectov = $searchModel_projectov->search(Yii::$app->request->queryParams);
$projectov = $dataProvider_projectov->query->where([])->one();
?>
<div id="page-content">
  <div class="container">
    <div class="row mt-5">
      <div class="col-lg-8">
        <div class="row">
            <?php foreach ($projects as $project) { ?>
          <div class="col-lg-4 col-6">
            <a href="project-detail?id=<?= $project->id ?>">
              <div class="box-project"><div class="holder img-1by1"><img class="img-fluid" src="../backend/uploads/project/<?= $project->main_photo; ?>"></div></div>
            </a>
          </div>
            <?php } ?>
        </div>
      </div>
      <div class="col-lg-4 col-md-5 col-12 order-md-2 order-1">
        <div class="side-box bg-white-trans d-md-block d-none">
          <div class="card-body">
              <p><?= $projectov->content ?></p>
          </div>
        </div>
        <div class="d-md-none d-block">
          <div class="card-body bg-white-trans mb-4">
              <p><?= $projectov->content ?></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>