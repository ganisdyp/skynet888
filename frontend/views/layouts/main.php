<?php

/* @var $this \yii\web\View */
/* @var $content string */
use frontend\config\DefImport;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language; ?>">
<head>
  <meta charset="<?= Yii::$app->charset; ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?= Html::csrfMetaTags() ?>
  <title><?= Html::encode($this->title); ?></title>
  <?php $this->head() ?>
    <meta name="google-site-verification" content="bWJzp1M0m4qpJozmEFu5iQj6nfnzpLYPE9tG0bb18fI" />
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-151865490-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-151865490-1');
    </script>

</head>
<body>
<?php $this->beginBody() ?>
<?php
  // if ($this->title == 'Home' || $this->title == 'หน้าหลัก') {
    // echo $this->render('header.php');
  // } else {
    echo $this->render('header_sub.php');
  // }
?>
<?= Alert::widget() ?>
<?= $content ?>

<?php echo $this->render('footer.php'); ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
