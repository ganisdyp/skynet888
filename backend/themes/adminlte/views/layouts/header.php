<?php
use yii\helpers\Html;
use common\models\Profile;
/* @var $this \yii\web\View */
/* @var $content string */
?>
<header class="main-header">

    <?= Html::a('<span class="logo-mini">SBS</span><span class="logo-lg">' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->
                <!-- User Account: style can be found in dropdown.less -->
                <?php $profile_img = Profile::findByUserId(Yii::$app->user->identity->getId())->profile_photo; ?>
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?= Yii::$app->getHomeUrl();?>/web/uploads/profile/<?= $profile_img ?>" class="user-image"
                             alt="User Image"/>
                        <?php
                        $profile_id = Profile::findByUserId(Yii::$app->user->identity->getId())->id;
                        $first_name = Profile::findByUserId(Yii::$app->user->identity->getId())->first_name;
                        $last_name = Profile::findByUserId(Yii::$app->user->identity->getId())->last_name;
                        $fullname = $first_name . ' ' . $last_name;
                        if (strlen($fullname) >= 20) {
                            $abbre_last_name = substr($last_name, 0, 1);
                            $abbrename = $first_name . ' ' . $abbre_last_name . '.';
                        } else {
                            $abbrename = $fullname;
                        }
                        //   $member_since = Yii::$app->user->identity->getCreatedAt();
                        ?>
                        <span class="hidden-xs"><?= $abbrename ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?= Yii::$app->getHomeUrl();?>/web/uploads/profile/<?= $profile_img ?>" class="img-circle"
                                 alt="User Image"/>
                            <p>
                                <?= $fullname ?>
                                <small>Member
                                    since <?= date('M.Y', Yii::$app->user->identity->getCreatedAt()) ?></small>
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <!-- <li class="user-body">
                             <div class="col-xs-4 text-center">
                                 <a href="#">Followers</a>
                             </div>
                             <div class="col-xs-4 text-center">
                                 <a href="#">Sales</a>
                             </div>
                             <div class="col-xs-4 text-center">
                                 <a href="#">Friends</a>
                             </div>
                         </li>-->
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="<?= Yii::$app->getHomeUrl();?>personal/profile/view?id=<?= $profile_id; ?>&user_id=<?= Yii::$app->user->identity->getId() ?>"
                                   class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <?= Html::a(
                                    'Sign out',
                                    ['/site/logout'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                        </li>
                    </ul>
                </li>

                <!-- User Account: style can be found in dropdown.less -->
                <?php /*
                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
                */ ?>
            </ul>
        </div>
    </nav>
</header>
