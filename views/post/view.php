<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Post */

$this->title = $model->getTitle();


$tags = \yii\helpers\ArrayHelper::map(\app\models\TagAssign::find()->where(['post_id'=>$model->id])->all(),'id','tag.name');
$tags_str = implode(',',$tags);


$this->registerMetaTag([ 'name'=>"description", 'content'=>Html::encode(\yii\helpers\StringHelper::truncateWords(strip_tags($model->getDescription()),30))]);
$this->registerMetaTag([ 'name'=>"keywords", 'content'=>$tags_str]);
$this->registerMetaTag([ 'name'=>"author", 'content'=>$model->user->full_name]);


?>
<div class="single-page">
    <div class="single-page-artical">
        <div class="artical-content">
            <h2 class="font-size-25 m-b-20 m-t-15 text-center"><?=$this->title?></h2>

            <?php if($model->image){ ?>
                <img class="width-100prs" src="<?=Yii::$app->homeUrl?>uploads/<?=$model->image?>" title="banner1">
            <?php } ?>
            <div>
                <?=$model->getContent()?>
            </div>
        </div>
        <div class="artical-links">
            <ul>
                <li><a href="#"><i class="fa fa-user"></i> <span><?=$model->user->full_name?></span></a></li>
                <li><a href="#"><i class="fa fa-folder-open"></i> <span><?= $model->category->name ?></span></a></li>
                <li><a href="#"><i class="fa fa-calendar"></i> <span><?= date('d-m-Y, H:i',strtotime($model->created_at)) ?></span></a></li>
                <li><a href="#"><i class="fa fa-eye"></i> <span><?= $model->count_view ?></span></a></li>
                <li><a href="#"><i class="fa fa-tags"></i> <span><?= $tags_str ?></span></a></li>
            </ul>
        </div>
        <div class="clear"> </div>
    </div>
</div>