<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Postlar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h2 class="text-center "><?= Html::encode($this->title) ?></h2>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('<i class="fa fa-plus"></i>', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php

    $category = \yii\helpers\ArrayHelper::map(\app\models\Category::find()->all(),'id','name');
    $user = \yii\helpers\ArrayHelper::map(\app\models\User::find()->all(),'id','full_name')
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute'=>'category_id',
                'value'=> function ($model) {
                    return $model->getTitle();
                },
                'filter'=>$category,
            ],
            [
                'attribute'=>'category_id',
                'value'=> function ($model) {
                    return $model->category->name;
                },
                'filter'=>$category,
            ],
            [
                'attribute'=>'user_id',
                'value'=> function ($model) {
                    return $model->user->full_name;
                },
                'filter'=>$user,
            ],
             'count_view',
            [
                'attribute'=>'status',
                'value'=> function ($model) {
                    return $model->status;
                },
                'filter'=>['active'=>'Active','inactive'=>'Inactive'],
            ],
             'created_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
