<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Post */

$this->title = $model->title;

?>
<div class="single-page">
    <div class="single-page-artical">
        <div class="artical-content">
            <h2 class="font-size-25 m-b-20 m-t-15 text-center"><?=$this->title?></h2>

            <div>
                <?=$model->content?>
            </div>
        </div>
    </div>
</div>