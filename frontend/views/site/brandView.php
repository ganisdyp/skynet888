<?php
/**
 * Created by PhpStorm.
 * User: clbs
 * Date: 5/4/2018
 * Time: 2:52 AM
 */

use common\models\ProjectSearch;
use common\models\CharacterTypeSearch;
use yii\helpers\Html;

$this->title = Yii::t('common', 'Projects');

$searchModel = new ProjectSearch();
$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
$project = $dataProvider->query->where(['id' => $_GET['c']])->one();

$searchModel = new CharacterTypeSearch();
$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
$character_categories = $dataProvider->query->where([])->all();
//$character_categories = $dataProvider->getModels();
define('PAGE_NAME', 'project');
?>
<div id="project-page" class="container">
    <nav class="mt-2 fadeIn animated d07s">
        <ol class="breadcrumb smaller-90">
            <li class="breadcrumb-item"><a href="/site/index"><?php echo Yii::t('common', 'Home');?></a></li>
            <li class="breadcrumb-item"><a href="/site/project"><?php echo Yii::t('common', 'Projects');?></a></li>
            <li class="breadcrumb-item active"><?php echo $project->name ." | ". $project->code; ?></li>
        </ol>
    </nav>
    <div class="row mb-4">
        <div class="col-12 mb-3 fadeIn animated d03s">
            <p class="bigger-160 font-weight-normal text-purple mb-0"><?php echo $project->name . " | " . $project->code; ?></p>
        </div>
        <div class="col-lg-8 col-12 fadeIn animated d03s">
            <div class="pb-3 font-chatthai"><?php echo $project->description; ?></div>
        </div>
        <div class="col-lg-4 col-12 fadeIn animated d03s">
            <p class="bigger-110 bold mb-2"><?php echo Yii::t('common', 'Character');?></p>
            <div class="card">
                <ul class="list-group list-group-flush link-to-character">
                    <?php foreach($character_categories as $category){ ?>
                    <li class="list-group-item corner-0">
                        <a href="character-list?id=<?= $category->id; ?>&c=<?= $project->id; ?>" class="clearfix block">
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
                <a href="/backend/uploads/project/<?php echo $project->main_photo; ?>" class="mt-3 hover-box" data-lightbox="true">
                    <div class="img-4by3 holder">
                        <img class="card-img-top img-responsive corner-0" src="/backend/uploads/project/<?php echo $project->main_photo; ?>">
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
