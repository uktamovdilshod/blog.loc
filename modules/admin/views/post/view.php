<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Post */



$this->title = $model->getTitle();
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-view">

    <h2 class="text-center "><?= Html::encode($this->title) ?></h2>
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php
    $tags = \yii\helpers\ArrayHelper::map(\app\models\TagAssign::find()->where(['post_id'=>$model->id])->all(),'id','tag.name');
    $tags_str = implode(', ',$tags);
    ?>

    <?php
    $languages = Yii::$app->params['languages'];
    ?>
    <div class="tab-content">
            <?php foreach ($languages as $language => $label) { ?>
            <table class="table table-striped table-bordered detail-view">
                <div id="<?=$language?>" class="tab-pane fade">
                            <tr>
                                <th class="width-20prs"><?=Yii::t('yii','Title',null,$language)?></th>
                                <td><?=$model->getTitle($language)?></td>
                            </tr>
                            <tr>
                                <th class="width-20prs"><?=Yii::t('yii','Description',null,$language)?></th>
                                <td><?=$model->getDescription($language)?></td>
                            </tr>
                            <tr>
                                <th class="width-20prs"><?=Yii::t('yii','Content',null,$language)?></th>
                                <td><?=$model->getContent($language)?></td>
                            </tr>
                    </div>
            </table>

            <?php } ?>

    </div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'user.full_name',
            'category.name',
            [
                'attribute'=>'tag',
                'value'=>$tags_str,
                'format'=>'raw',
            ],
            [
                'attribute'=>'image',
                'value'=>($model->image)?Html::img('/uploads/'.$model->image,['style'=>'width:200px']):null,
                'format'=>'raw',

            ],
            'count_view',
            'status',
            'created_at',
        ],
    ]) ?>

</div>
