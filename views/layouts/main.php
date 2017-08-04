<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="<?= Yii::$app->homeUrl?>frontend/images/fav-icon.png" />
    <?= Html::csrfMetaTags() ?>

    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

        <?php
            $this->registerJs("
                $(function() {
                    $('#activator').click(function(){
                        $('#box').animate({'top':'0px'},500);
                    });
                    $('#boxclose').click(function(){
                        $('#box').animate({'top':'-700px'},500);
                    });
                });
                $(\".toggle_container\").hide();
                $(\".trigger\").click(function(){
                    $(this).toggleClass(\"active\").next().slideToggle(\"slow\");
                    return false;
                });

            ");
        ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

    <!---start-wrap---->
    <!---start-header---->
    <div class="header">
        <div class="wrap">
            <div class="logo">
                <a href="<?= Yii::$app->homeUrl?>"><img src="<?= Yii::$app->homeUrl?>frontend/images/logo.png" title="pinbal" /></a>
            </div>
            <div class="nav-icon">
                <a href="#" class="right_bt" id="activator"><span> </span> </a>
            </div>
            <div class="box" id="box">
                <div class="box_content">
                    <div class="box_content_center">
                        <div class="form_content">
                            <div class="menu_box_list">
                                <ul>
                                    <li><a href="<?=Yii::$app->homeUrl?>"><span>Bosh sahifa</span></a></li>
                                    <li><a href="<?=\yii\helpers\Url::to(['site/index','category'=>1])?>"><span>Texnologiyalar</span></a></li>
                                    <li><a href="<?=\yii\helpers\Url::to(['site/index','category'=>2])?>"><span>Sport</span></a></li>
                                    <li><a href="<?=\yii\helpers\Url::to(['site/index','category'=>3])?>"><span>Jamiyat</span></a></li>
                                    <li><a href="<?=\yii\helpers\Url::to(['site/index','category'=>4])?>"><span>Iqtisod</span></a></li>
                                    <li><a href="<?=\yii\helpers\Url::to(['site/index','category'=>5])?>"><span>Siyosat</span></a></li>
                                    <li><a href="<?=\yii\helpers\Url::to(['site/view','id'=>1])?>"><span>Biz haqimizda</span></a></li>
                                    <li><a href="<?=\yii\helpers\Url::to(['site/contact'])?>"><span>Bog'lanish</span></a></li>
                                    <div class="clear"> </div>
                                </ul>
                            </div>
                            <a class="boxclose" id="boxclose"> <span> </span></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="top-searchbar">
                <form>
                    <input type="text" /><input type="submit" value="" />
                </form>
                <?= \app\components\LanguageWidget::widget()?>
            </div>

            <div class="clear"> </div>
        </div>
    </div>
    <!---//End-header---->
    <!---start-content---->
    <div class="content">
        <div class="wrap">
            <?= $content ?>
        </div>
    </div>
    <!---//End-content---->


<?php
$this->registerJs("
    (function ($){
        var tiles = $('#tiles'),
            handler = $('li', tiles),
            main = $('#main'),
            window = $(window),
            document = $(document),
            options = {
                autoResize: true, // This will auto-update the layout when the browser window is resized.
                container: main, // Optional, used for some extra CSS styling
                offset: 20, // Optional, the distance between grid items
                itemWidth:280 // Optional, the width of a grid item
            };
        function applyLayout() {
            tiles.imagesLoaded(function() {
                // Destroy the old handler
                if (handler.wookmarkInstance) {
                    handler.wookmarkInstance.clear();
                }

                // Create a new layout handler.
                handler = $('li', tiles);
                handler.wookmark(options);
            });
        }
                function onScroll() {
            // Check if we're within 100 pixels of the bottom edge of the broser window.
            var winHeight = window.innerHeight ? window.innerHeight : window.height(), // iphone fix
                closeToBottom = (window.scrollTop() + winHeight > document.height() - 100);

            if (closeToBottom) {
                // Get the first then items from the grid, clone them, and add them to the bottom of the grid
                var items = $('li', tiles),
                    firstTen = items.slice(0, 10);
                tiles.append(firstTen.clone());

                applyLayout();
            }
        };

        applyLayout();

        // Capture scroll event.
        window.bind('scroll.wookmark', onScroll);
    })(jQuery);
");

?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
