<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>    

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php
    if (!$model->isNewRecord) {
        echo $form->field($model, 'main_photo')->widget(\kartik\file\FileInput::classname(), [
            'options' => [
                'accept' => 'image/*',
            ],
            'pluginOptions' => [
                'uploadUrl' => \yii\helpers\Url::to(['file-upload-general']),
                'uploadExtraData' => [
                    'main_photo' => $model->main_photo,
                    'id' => $model->id,
                ],
                'allowedFileExtensions' => ['jpg', 'png', 'gif'],                
                'initialPreview' => ($model->main_photo)?'<img src="' . $model->main_photo . '" width=125>':'',
                'showUpload' => true,
                'showRemove' => false,
                'dropZoneEnabled' => false,
                'overwriteInitial' => false
            ]
        ]);
    }
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
