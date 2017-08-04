<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class BackendAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        "backend/assets/css/bootstrap.css",
        "backend/assets/font-awesome/css/font-awesome.css",
        "backend/assets/css/zabuto_calendar.css",
        "backend/assets/js/gritter/css/jquery.gritter.css",
        "backend/assets/lineicons/style.css",
        "backend/assets/css/style.css",
        "backend/assets/css/style-responsive.css",
        "backend/assets/css/custom.css",
        "css/custom.mine.css",
    ];
    public $js = [
        "backend/assets/js/bootstrap.min.js",
        "backend/assets/js/jquery.dcjqaccordion.2.7.js",
        "backend/assets/js/jquery.scrollTo.min.js",
        "backend/assets/js/jquery.nicescroll.js",
        "backend/assets/js/jquery.sparkline.js",
        "backend/assets/js/common-scripts.js",
        "backend/assets/js/gritter/js/jquery.gritter.js",
        "backend/assets/js/gritter-conf.js",
    ];
    public $depends = [
        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
    ];
}
