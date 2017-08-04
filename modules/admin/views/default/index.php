<?php

$url = Yii::$app->homeUrl.'backend/';
/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */


$this->title = 'Bosh sahifa';
?>
<div class="row">
    <h2 class="text-center "><?= \yii\helpers\Html::encode($this->title) ?></h2>
    <div class="col-lg-12 col-md-12 main-chart">

        <div class="mtbox">
            <div class="col-md-3 col-sm-2  box0">
                <div class="box1">
                    <span class="fa fa-newspaper-o"></span>
                    <h3><?= \app\models\Post::find()->count()?></h3>
                </div>
                <p><?= Yii::t('yii','Postlar')?></p>
            </div>
            <div class="col-md-3 col-sm-2 box0">
                <div class="box1">
                    <span class="fa fa-file-text-o"></span>
                    <h3><?= \app\models\Page::find()->count()?></h3>
                </div>
                <p><?= Yii::t('yii','Sahifalar')?></p>
            </div>
            <div class="col-md-3 col-sm-2 box0">
                <div class="box1">
                    <span class="fa fa-tags"></span>
                    <h3><?= \app\models\Tag::find()->count()?></h3>
                </div>
                <p><?= Yii::t('yii','Kalit so\'zlar')?></p>
            </div>
            <div class="col-md-3 col-sm-2 box0">
                <div class="box1">
                    <span class="fa fa-users"></span>
                    <h3><?= \app\models\User::find()->count()?></h3>
                </div>
                <p><?= Yii::t('yii','Foydalanuvchilar')?></p>
            </div>
        </div><!-- /row mt -->
    </div>
</div>