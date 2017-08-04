<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data'
        ]
    ]); ?>

    <?= $form->errorSummary($model)?>

    <div class="col-md-9">
        <?php
        $languages = Yii::$app->params['languages'];
        $i = 0;
        ?>
        <ul class="nav nav-tabs">
            <?php foreach ($languages as $language => $label) { ?>
                <li class="<?= ($i==0)?'active':'' ?>"><a data-toggle="tab" href="#<?=$language?>"><?=$label?></a></li>
            <?php $i++; } ?>
        </ul>
        <div class="tab-content">
            <?php $j=0; foreach ($languages as $language => $label) { ?>
                <div id="<?=$language?>" class="tab-pane fade in <?= ($j==0)?'active':'' ?>">

                    <?= $form->field($model, 'translate_title['.$language.']')->textInput(['maxlength' => true])->label(Yii::t('yii','Title',null,$language)) ?>
                    <?= $form->field($model, 'translate_description['.$language.']')->textarea(['row'=>2,'maxlength' => true])->label(Yii::t('yii','Description',null,$language)) ?>
                    <?= $form->field($model, 'translate_content['.$language.']')->widget(\dosamigos\tinymce\TinyMce::className(), [
                        'options' => ['rows' =>15 ],
                        'clientOptions' => [
                            'plugins' => [
                                "advlist autolink lists link charmap print preview anchor",
                                "searchreplace visualblocks code fullscreen",
                                "insertdatetime media table contextmenu paste"
                            ],
                            'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
                        ]
                    ])->label(Yii::t('yii','Content',null,$language));?>

                </div>
            <?php $j++; } ?>
        </div>

    </div>
    <div class="col-md-3 bg-info p-t-20 p-b-20 p-l-15 p-r-15" style="background-color: rgba(208, 208, 208, 0.38);">
        <?php
        $data = \yii\helpers\ArrayHelper::map(\app\models\Category::find()->all(),'id','name')
        ?>
        <?= $form->field($model, 'category_id')->dropDownList($data) ?>
        <?php if ($model->isNewRecord) {
                    $model->status = 'active';
              }
        ?>
        <?= $form->field($model, 'status')->dropDownList([ 'active' => 'Active', 'inactive' => 'Inactive', ], ['prompt' => '']) ?>

        <?php
        if (!$model->isNewRecord) {
            $tags = \yii\helpers\ArrayHelper::map(\app\models\TagAssign::find()->where(['post_id'=>$model->id])->all(),'id','tag.name');
            $tags_str = implode(',',$tags);
        }else{
            $tags_str = '';
        }
        echo \dosamigos\selectize\SelectizeTextInput::widget([
            'name' => 'Post[tag]',
            'loadUrl' => ['tag/list'],
            'value' =>$tags_str,
            'clientOptions' => [
                'plugins' => ['remove_button'],
                'valueField' => 'keyword',
                'labelField' => 'keyword',
                'searchField' => ['keyword'],
                'create' => true,
                'delimiter' => ',',
                'persist' => false,
                'createOnBlur' => true,
                'preload'=> false
            ]
        ]);

        ?>
        <?= $form->field($model, 'image')->fileInput(); ?>

        <?php if ($model->image) { ?>
            <img src="/uploads/<?=$model->image?>" style="max-width: 100%">
        <?php }?>

        <div class="form-group m-t-20">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success btn-block' : 'btn  btn-block btn-primary']) ?>
        </div>
    </div>


    <?php ActiveForm::end(); ?>

</div>
