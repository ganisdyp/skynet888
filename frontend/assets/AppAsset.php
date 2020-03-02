<?php

namespace frontend\assets;

use yii\web\AssetBundle;
use frontend\models\System;
/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
       // 'css/site.css',
        'css/bootstrap4.min.css',
      //  'css/font-awesome.min.css',
        'lib/fontawesome/css/all.min.css',
        'lib/animate.css/animate.min.css',
        'lib/lightbox2/lightbox.min.css',
        'lib/fancybox/jquery.fancybox.min.css',
        'css/helper.css',
        'css/style.css',

    ];

    public $js = [
        'js/polyfill.js',
        'js/bootstrap4.bundle.min.js',
        'js/EQCSS.min.js',
        'lib/moment/moment.js',
        'lib/SmoothScroll/SmoothScroll.js',
        'lib/lightbox2/lightbox.min.js',
        'lib/fancybox/jquery.fancybox.min.js',
        'lib/waypoint/jquery.waypoints.min.js',
      //  'js/jquery-3.2.1.min.js',
        'js/script.js',

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'frontend\assets\FontAwesomeAsset',
      //  'yii\bootstrap\BootstrapAsset',
    ];
}
