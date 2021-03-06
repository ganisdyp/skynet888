<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use frontend\models\DC;
use common\models\CharacterTypeSearch;
use common\models\CharacterSearch;
use common\models\ProjectSearch;

define('PAGE_NAME', 'character');
$this->title = Yii::t('common', 'Character');
$this->params['breadcrumbs'][] = $this->title;

$projects = DC::get_menu_projects();

$searchModel = new CharacterTypeSearch();
$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
$character_categories = $dataProvider->getModels();

$searchModel_character = new CharacterSearch();
$dataProvider_character = $searchModel_character->search(Yii::$app->request->queryParams);

$searchModel_project = new ProjectSearch();
$dataProvider_project = $searchModel_project->search(Yii::$app->request->queryParams);

$project_id = 0;
$character_list = [];
$category_list = [];
if (isset($_GET['id']) && trim($_GET['id']) != '') {
    $project_id = $_GET['id'];
    /**  Find category from project */
    $category_list = $dataProvider_character->query->leftJoin('character_type_lang','character.character_type_id = character_type_lang.character_type_id AND character_type_lang.language = \'en\'')->where(['project_id' => $project_id])->groupBy('character_type_id')->orderBy(['character_type_lang.name' => SORT_ASC])->all();
    $selected_project = $dataProvider_project->query->where(['id' => $project_id])->one();

} else {
    $selected_project = null;
    $category_list = $dataProvider_character->query->leftJoin('character_type_lang','character.character_type_id = character_type_lang.character_type_id AND character_type_lang.language = \'en\'')->where([])->groupBy('character_type_id')->orderBy(['project_id'=> SORT_ASC,'character_type_lang.name' => SORT_ASC])->all();
}
?>
<div id="character-page" class="container">
    <?php /*
  <div class="page-header has-right-content fadeIn animated d03s" style="background-image: url(http://smartyschool.stylemixthemes.com/university/wp-content/uploads/2016/09/bg-shop.jpg);">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 col-12 align-self-center">
          <div class="header-content">
            <p class="title h3 bold text-uppercase">Character</p>
            <p class="mb-lg-0 mb-2">Lorem ipsum dolor sit amet</p>
          </div>
        </div>
        <div class="col-lg-6 col-12">
          <div class="right-content text-lg-right">
            <p class="mb-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit Nulla viverra tellus efficitur mau</p>
            <p class="mb-0 smaller-90">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In dui turpis, pretium nec velit vitae, dictum mollis metus. Integer ut est quis odio euismod
venenatis et at orci.</p>
          </div>
        </div>
      </div>
    </div>
    <div class="page-header-overlay"></div>
  </div>
  */ ?>
    <nav class="mt-2 fadeIn animated d07s">
        <ol class="breadcrumb smaller-90">
            <?php if ($project_id == 0) { ?>
                <li class="breadcrumb-item"><a
                            href="<?php echo Yii::$app->request->BaseUrl . '/site/index'; ?>"><?php echo Yii::t('common', 'Home'); ?></a>
                </li>
                <li class="breadcrumb-item active"><?php echo Yii::t('common', 'Character'); ?></li>
            <?php } else { ?>
                <li class="breadcrumb-item"><a
                            href="<?php echo Yii::$app->request->BaseUrl . '/site/index'; ?>"><?php echo Yii::t('common', 'Home'); ?></a>
                </li>
                <li class="breadcrumb-item bold"><a
                            href="<?php echo Yii::$app->request->BaseUrl . '/site/product-category'; ?>"><?php echo Yii::t('common', 'Character'); ?></a>
                </li>
                <li class="breadcrumb-item active"><?php echo $selected_project->name; ?></li>
            <?php } ?>
        </ol>
    </nav>
    <div class="row fadeIn animated d03s mt-3 mb-4">
        <div class="col-lg-3">
            <div class="card product-category">
                <div class="card-header text-center bold">
                    Character Projects
                </div>
                <div class="card-body">
                    <ul>
                        <li class="<?php echo ($project_id == 0) ? 'active' : ''; ?>">
                            <a href="<?php echo Yii::$app->request->BaseUrl . '/site/product-category'; ?>">All</a>
                        </li>
                        <?php foreach ($projects as $cate) {
                            $selected = ($project_id == $cate["id"]) ? 'active' : '';
                            echo '<li class="' . $selected . '">
                  <a href="' . Yii::$app->request->BaseUrl . '/site/product-category?id=' . $cate["id"] . '">' . $cate["text"] . '</a>
                  </li>';
                        } ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="row">
                <?php /*
          <div class="col-12 mb-3">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                Showing 1-12 of 30 results
              </div>
              <div>
                <form action="" method="get">
                  <select name="orderby" class="form-control">
                    <option value="date">Sort by newness</option>
                    <option value="price">Sort by price : low to high</option>
                    <option value="price-desc">Sort by price : high to low</option>
                  </select>
                </form>
              </div>
            </div>
          </div>
          */ ?>
                <?php /* foreach ($product_categories as $product_category) { ?>
          <div class="col-lg-4 col-md-6 col-12">
            <div class="card dc-card mb-4 corner-0 z-shadow fadeIn animated d03s">
              <a href="<?php echo Yii::$app->request->BaseUrl; ?>/site/product-list?id=<?= $product_category->id; ?>" class="hover-box">
                <div class="img-1by1 holder">
                  <img class="card-img-top img-responsive corner-0"
                    src="<?php echo Yii::$app->request->BaseUrl; ?>/backend/uploads/product_type/<?= $product_category->main_photo; ?>">
                </div>
              </a>
              <div class="card-body text-center">
                <a href="<?php echo Yii::$app->request->BaseUrl; ?>/site/product-list?id=<?= $product_category->id; ?>"
                class="card-title font-weight-normal bigger-110 my-0 block"><?= $product_category->name;?></a>
              </div>
            </div>
          </div>
          <?php } */ ?>
                <?php foreach ($category_list as $category) {
                    $selected_category = $dataProvider->query->where(['id' => $category->product_type_id])->one();
                    ?>
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="card dc-card mb-4 corner-0 z-shadow fadeIn animated d03s">
                            <a href="<?php echo Yii::$app->request->BaseUrl; ?>/site/product-list?id=<?php echo $selected_category->id; ?>"
                               class="hover-box">
                                <div class="media-wrapper corner-1">
                                    <div class="img-1by1 holder corner-1">
                                        <img class="card-img-top img-responsive"
                                             src="<?php echo Yii::$app->request->BaseUrl; ?>/backend/uploads/product_type/<?= $selected_category->main_photo; ?>">
                                    </div>
                                    <div class="media-overlay corner-1"></div>
                                </div>
                            </a>
                            <div class="card-body text-center py-3">
                                <a href="<?php echo Yii::$app->request->BaseUrl; ?>/site/product-list?id=<?= $selected_category->id; ?>"
                                   class="card-title font-weight-normal smaller-90 my-0 block"><?= $selected_category->name; ?></a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    <?php /*
    <div class="row fadeIn animated d03s mt-3 mb-4">
        <?php foreach ($product_categories as $product_category) { ?>
            <div class="col-md-4 col-12">
                <a href="product-list?id=<?= $product_category->id; ?>&c=all" class="block mb-3">
                    <div class="media-wrapper corner-1">
                        <div class="img-16by9 holder corner-1">
                            <img class="card-img-top img-responsive" src="/backend/uploads/product_type/<?= $product_category->main_photo; ?>">
                        </div>
                        <p class="mb-0 bigger-120 font-weight-normal center bold"><?= $product_category->name;?></p>
                        <div class="media-overlay corner-1"></div>
                    </div>
                </a>
            </div>

        <?php } ?>
        <div class="clearfix"></div>
    </div>
    */ ?>
</div>