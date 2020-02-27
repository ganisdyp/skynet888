<?php
namespace frontend\models;
use Yii;
use yii\base\Model;
use common\models\ProjectSearch;
use common\models\CharacterTypeSearch;

class DC extends Model {
  public static function get_menu() {
    $menu = array(
      array(
        'text' => Yii::t('common', 'Home'),
        'link' => Yii::$app->request->BaseUrl.'/site/index',
        'pagename' => 'index',
      ),
      array(
        'text' => Yii::t('common', 'About'),
        'link' => Yii::$app->request->BaseUrl.'/site/about',
        'pagename' => 'about',
      ),
      array(
        'text' => Yii::t('common', 'Services'),
        'link' => Yii::$app->request->BaseUrl.'/site/services',
        'pagename' => 'services',
      ),
      array(
        'text' => Yii::t('common', 'Character'),
        'link' => Yii::$app->request->BaseUrl.'/site/character-category',
        'pagename' => 'character',
        // 'subpage' => self::get_menu_character(),
      ),
      array(
        'text' => Yii::t('common', 'Blogs'),
        'link' => Yii::$app->request->BaseUrl.'/site/blog-category',
        'pagename' => 'blog',
        // 'subpage' => self::get_menu_blogs(),
      ),
      array(
        'text' => Yii::t('common', 'Contact'),
        'link' => Yii::$app->request->BaseUrl.'/site/contact',
        'pagename' => 'contact',
      )
    );

      return $menu;
  }

  public static function get_menu_projects() {
      $searchModel = new BrandSearch();
      $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
      $projects = $dataProvider->query->where(['<>','code', '--'])->orderBy(['code'=>SORT_ASC])->all();
      $menu = array();
      foreach($projects as $project){
          $arr_detail = array(
              'id' => $project->id,
              'text' => $project->name,
              'code' => $project->code,
              'link' => Yii::$app->request->BaseUrl.'/site/character-category?id='.$project->id,
              'main_photo' => $project->main_photo,
              'pagename' => 'project'
          );
          array_push($menu,$arr_detail);
      }

      return $menu;
  }

  public static function get_menu_character() {
      $searchModel = new CharacterTypeSearch();
      $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
      $character_category = $dataProvider->query->all();
      $menu = array();
      foreach($character_category as $category){
          $arr_detail = array(
              'text' => $category->name,
              'link' => Yii::$app->request->BaseUrl.'/site/character-list?id='.$category->id,
              'main_photo' => $category->main_photo,
              'pagename' => 'character'
          );
          array_push($menu,$arr_detail);
      }
      
      return $menu;
    }

    // public static function get_menu_blogs() {
    //     $searchModel = new BlogtypeSearch();
    //     $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    //     $blog = $dataProvider->query->all();
    //     $menu = array();
    //     foreach($blog as $trip){
    //         $arr_detail = array(
    //             'text' => $trip->name,
    //             'link' => '/site/blog-list?id='.$trip->id.'&c=all',
    //             'pagename' => 'blog'
    //         );
    //         array_push($menu,$arr_detail);
    //     }

    //     return $menu;
    // }

}
?>