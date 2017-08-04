<?php

/* @var $this yii\web\View */

$this->title = 'Bosh sahifa';
?>
<div id="main" role="main">
    <ul id="tiles">
        <?php foreach ($dataProvider->getModels() as $model) { ?>
            <li onclick="location.href='<?=\yii\helpers\Url::to(['post/view','id'=>$model->id])?>';">
                <img src="<?=Yii::$app->homeUrl?>uploads/<?=$model->image?>" >
                <div class="post-info">
                    <div class="post-basic-info">
                        <h3><a href="#"><?= $model->getTitle()?></a></h3>
                        <span><a href="#"><label> </label><?= $model->category->name?></a></span>
                        <p><?= $model->getDescription()?></p>
                    </div>
                </div>
            </li>
        <?php } ?>
    </ul>
</div>
<div class="clearfix"></div>
<div class="row text-center">
    <?php
    echo \yii\widgets\ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
    ]);
    ?>
</div>

<style>
    .summary{
        display: none;
    }
    .list-view .item{
        display: none;
    }
</style>