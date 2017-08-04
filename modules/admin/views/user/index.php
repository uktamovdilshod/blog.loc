<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Foydalanuvchilar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h2 class="text-center "><?= Html::encode($this->title) ?></h2>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('<i class="fa fa-plus"></i>', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute'=>'full_name',
                'value'=> function ($model) {
                    return $model->full_name.' - '.$model->username;
                },
            ],
            [
                'attribute'=>'role',
                'value'=> function ($model) {
                    return $model->role;
                },
                'filter'=>['admin'=>'Admin','user'=>'Foydalanuvchi'],
            ],
            [
                'attribute'=>'status',
                'value'=> function ($model) {
                    return $model->status;
                },
                'filter'=>['active'=>'Active','inactive'=>'Inactive'],
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
