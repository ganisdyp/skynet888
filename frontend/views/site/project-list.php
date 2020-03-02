<?php
use common\models\ProjectSearch;

define('PAGE_NAME', 'projects');

$searchModel_project = new ProjectSearch();
$dataProvider_project = $searchModel_project->search(Yii::$app->request->queryParams);
$projects = $dataProvider_project->query->where(['status'=>'Active'])->all();
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
            <p>Our Projects</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Interdum varius sit amet mattis vulputate enim nulla aliquet. Duis tristique sollicitudin nibh sit amet commodo nulla. Mattis nunc sed blandit libero volutpat sed cras ornare. Aliquam vestibulum morbi blandit cursus risus. Id cursus metus aliquam eleifend. Ac auctor augue mauris augue neque. Congue eu consequat ac felis donec et odio pellentesque. Tincidunt vitae semper quis lectus nulla at volutpat diam ut. At urna condimentum mattis pellentesque id nibh.</p>
            <p>Sit amet consectetur adipiscing elit. Scelerisque fermentum dui faucibus in ornare quam viverra orci sagittis. Ante in nibh mauris cursus mattis molestie a. Dictum sit amet justo donec enim. Vestibulum sed arcu non odio euismod lacinia at quis. Nunc lobortis mattis aliquam faucibus purus in massa. Sit amet mattis vulputate enim nulla aliquet porttitor lacus luctus. Volutpat blandit aliquam etiam erat. Sit amet risus nullam eget felis eget nunc lobortis mattis. Tincidunt dui ut ornare lectus sit amet. Urna cursus eget nunc scelerisque viverra mauris in aliquam. Natoque penatibus et magnis dis. Justo donec enim diam vulputate ut pharetra sit amet. Sit amet venenatis urna cursus eget nunc scelerisque viverra. Nibh sit amet commodo nulla facilisi nullam vehicula ipsum. Non nisi est sit amet facilisis. Erat imperdiet sed euismod nisi. Mi proin sed libero enim sed faucibus turpis. Pulvinar elementum integer enim neque volutpat. Mi tempus imperdiet nulla malesuada pellentesque elit eget gravida cum.</p>
          </div>
        </div>
        <div class="d-md-none d-block">
          <div class="card-body bg-white-trans mb-4">
            <p>Our Projects</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Interdum varius sit amet mattis vulputate enim nulla aliquet. Duis tristique sollicitudin nibh sit amet commodo nulla. Mattis nunc sed blandit libero volutpat sed cras ornare. Aliquam vestibulum morbi blandit cursus risus. Id cursus metus aliquam eleifend. Ac auctor augue mauris augue neque. Congue eu consequat ac felis donec et odio pellentesque. Tincidunt vitae semper quis lectus nulla at volutpat diam ut. At urna condimentum mattis pellentesque id nibh.</p>
            <p>Sit amet consectetur adipiscing elit. Scelerisque fermentum dui faucibus in ornare quam viverra orci sagittis. Ante in nibh mauris cursus mattis molestie a. Dictum sit amet justo donec enim. Vestibulum sed arcu non odio euismod lacinia at quis. Nunc lobortis mattis aliquam faucibus purus in massa. Sit amet mattis vulputate enim nulla aliquet porttitor lacus luctus. Volutpat blandit aliquam etiam erat. Sit amet risus nullam eget felis eget nunc lobortis mattis. Tincidunt dui ut ornare lectus sit amet. Urna cursus eget nunc scelerisque viverra mauris in aliquam. Natoque penatibus et magnis dis. Justo donec enim diam vulputate ut pharetra sit amet. Sit amet venenatis urna cursus eget nunc scelerisque viverra. Nibh sit amet commodo nulla facilisi nullam vehicula ipsum. Non nisi est sit amet facilisis. Erat imperdiet sed euismod nisi. Mi proin sed libero enim sed faucibus turpis. Pulvinar elementum integer enim neque volutpat. Mi tempus imperdiet nulla malesuada pellentesque elit eget gravida cum.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>