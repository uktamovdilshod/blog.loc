<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row m-0">
        <div class="col-md-12">
            <?= $form->field($model, 'full_name')->textInput(['maxlength' => true]) ?>
        </div>

    </div>
    <div class="row m-0">
        <div class="col-md-6">
            <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'new_password')->passwordInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row m-0">
        <div class="col-md-6">
            <?= $form->field($model, 'role')->dropDownList([ 'admin' => 'Admin', 'user' => 'User', ], ['prompt' => '']) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'status')->dropDownList([ 'active' => 'Active', 'inactive' => 'Inactive', ], ['prompt' => '']) ?>
        </div>
    </div>

    <div class="row m-0 col-md-12 form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
