<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use app\assets\BackendAsset;
use yii\helpers\Url;

BackendAsset::register($this);

$url = Yii::$app->homeUrl.'backend/';

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<section id="container" >
    <!-- **********************************************************************************************************************************************************
    TOP BAR CONTENT & NOTIFICATIONS
    *********************************************************************************************************************************************************** -->
    <!--header start-->
    <header class="header black-bg">
        <div class="sidebar-toggle-box">
            <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
        </div>
        <!--logo start-->
        <a href="<?= Yii::$app->homeUrl?>" class="logo"><b>BlOG.UZ</b></a>
        <!--logo end-->
        <div class="top-menu">
            <ul class="nav pull-right top-menu">
                <li><a data-method="POST" class="logout" href="<?= Url::to(['/site/logout'])?>">Tizimdan chiqish</a></li>
            </ul>
        </div>
    </header>
    <!--header end-->

    <!-- **********************************************************************************************************************************************************
    MAIN SIDEBAR MENU
    *********************************************************************************************************************************************************** -->
    <!--sidebar start-->
    <aside>
        <div id="sidebar"  class="nav-collapse ">
            <!-- sidebar menu start-->
            <ul class="sidebar-menu" id="nav-accordion">

                <p class="centered"><a href="profile.html"><img src="<?= $url?>assets/img/ui-sam.jpg" class="img-circle" width="60"></a></p>
                <h5 class="centered"><?= Yii::$app->user->identity->full_name?></h5>

                <?php $controller = Yii::$app->controller->id; ?>
                <li class="mt">
                    <a class="<?= ($controller=='default')?'active':''?>" href="<?= Url::to(['default/'])?>">
                        <i class="fa fa-dashboard"></i>
                        <span>Bosh sahifa</span>
                    </a>
                </li>

                <li class="sub-menu">
                    <a class="<?= ($controller=='post')?'active':''?>" href="<?= Url::to(['post/'])?>" >
                        <i class="fa fa-newspaper-o"></i>
                        <span>Postlar</span>
                    </a>
                </li>

                <li>
                    <a  class="<?= ($controller=='category')?'active':''?>" href="<?= Url::to(['category/'])?>">
                        <i class="fa fa-list"></i>
                        <span>Kategoriyalar</span>
                    </a>
                </li>
                <li>
                    <a  class="<?= ($controller=='tag')?'active':''?>"  href="<?= Url::to(['tag/'])?>">
                        <i class="fa fa-tags"></i>
                        <span>Kalit so'zlar</span>
                    </a>
                </li>
                <li>
                    <a  class="<?= ($controller=='page')?'active':''?>"  href="<?= Url::to(['page/'])?>">
                        <i class="fa fa-file-text-o"></i>
                        <span>Sahifalar</span>
                    </a>
                </li>
                <li>
                    <a  class="<?= ($controller=='user')?'active':''?>"  href="<?= Url::to(['user/'])?>">
                        <i class="fa fa-users"></i>
                        <span>Foydalanuvchilar</span>
                    </a>
                </li>
            </ul>
            <!-- sidebar menu end-->
        </div>
    </aside>
    <!--sidebar end-->

    <!-- **********************************************************************************************************************************************************
    MAIN CONTENT
    *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">

            <?= $content ?>

        </section>
    </section>


</section>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
