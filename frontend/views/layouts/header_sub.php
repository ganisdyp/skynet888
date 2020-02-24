<?php
use frontend\models\DC;
use yii\helpers\Url;
use yii\helpers\Html;

$menu_list = DC::get_menu();
echo '<div class="view-content">';
?>
<nav class="navbar navbar-expand-lg navbar-light navbar-sub fixed-top bg-white shadow">
  <div class="container">
    <a class="navbar-brand bold" href="<?php echo Yii::$app->request->BaseUrl.'/site/index'; ?>">
      <img src="../images/logo.png" alt="safebox thailand">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsub" aria-controls="navbarsub" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarsub">
      <ul class="navbar-nav ml-auto">
      <?php
        foreach ($menu_list as $menu) {
        $active = (PAGE_NAME == $menu['pagename']) ? 'active' : '';
        $is_subpage = (isset($menu['subpage'])) ? 'dropdown' : '';
        $menu_html = '<li class="nav-item '.$active.' '.$is_subpage.'">';

        if(isset($menu['subpage'])) {
          $subpage_list = $menu['subpage'];
          $menu_html .= '<a class="nav-link dropdown-toggle" href="'.$menu['link'].'" id="'.$menu['text'].'" role="button" aria-haspopup="true" aria-expanded="false">'.$menu['text'].'</a>';

          $menu_html .= '<div class="dropdown-menu" aria-labelledby="'.$menu['text'].'">';
          foreach ($subpage_list as $subpage) {
            $menu_html .= '<a class="dropdown-item" href="'.$subpage['link'].'">'.$subpage['text'].'</a>';
          }
          $menu_html .= '</div>';
        } else {
          $menu_html .= '<a class="nav-link" href="'.$menu['link'].'">'.$menu['text'].'</a></li>';
        }
        echo $menu_html;
        }

        echo '<li class="nav-item">'.Html::a('TH', Url::current(['language' => 'th-TH']), ['class' => 'nav-link '.(Yii::$app->request->cookies['language']=='th-TH' ? 'active' : '')]);
        echo '<li class="nav-item">'.Html::a('EN', Url::current(['language' => 'en-UK']), ['class' => 'nav-link '.(Yii::$app->request->cookies['language']=='en-UK' ? 'active' : '')]);
      ?>
      </ul>
    </div>
  </div>
</nav>
<?php if ($this->title != 'Home' && $this->title != 'หน้าหลัก') {
  echo '<div class="navbar-sub-hero image-section"></div>';
} else {
  echo '<div style="height: 86px;"></div>';
} ?>