<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Agents */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="agents-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_sex')->textInput() ?>

    <?= $form->field($model, 'surname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'patronymic')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hash')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_type')->textInput() ?>

    <?= $form->field($model, 'date_add')->textInput() ?>

    <?= $form->field($model, 'access')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'online')->textInput() ?>

    <?= $form->field($model, 'last_computer_info')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'count_times_view_clients')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'clients_rent_limit_phones_daily')->textInput() ?>

    <?= $form->field($model, 'clients_rent_module')->textInput() ?>

    <?= $form->field($model, 'clients_rent_phones')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'count_times_view_objects')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'objects_rent_limit_phones_daily')->textInput() ?>

    <?= $form->field($model, 'count_times_view_objects_archive')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'objects_rent_limit_phones_daily_archive')->textInput() ?>

    <?= $form->field($model, 'objects_rent_module')->textInput() ?>

    <?= $form->field($model, 'count_times_view_objects_sale')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'objects_sale_limit_phones_daily')->textInput() ?>

    <?= $form->field($model, 'calls_module')->textInput() ?>

    <?= $form->field($model, 'objects_rent_phones')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'mail_service_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mail_service_password')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mail_service_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'notify_module')->textInput() ?>

    <?= $form->field($model, 'id_domain')->textInput() ?>

    <?= $form->field($model, 'xml_feed_time_to')->textInput() ?>

    <?= $form->field($model, 'xml_feed_on_off')->textInput() ?>

    <?= $form->field($model, 'xml_feed_max')->textInput() ?>

    <?= $form->field($model, 'vk_login')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'vk_password')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'xml_feed_count_max')->textInput() ?>

    <?= $form->field($model, 'ap_login')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ap_password')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
