<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\AgentsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="agents-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'username') ?>

    <?= $form->field($model, 'id_sex') ?>

    <?= $form->field($model, 'surname') ?>

    <?= $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'patronymic') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'password') ?>

    <?php // echo $form->field($model, 'hash') ?>

    <?php // echo $form->field($model, 'id_type') ?>

    <?php // echo $form->field($model, 'date_add') ?>

    <?php // echo $form->field($model, 'access') ?>

    <?php // echo $form->field($model, 'online') ?>

    <?php // echo $form->field($model, 'last_computer_info') ?>

    <?php // echo $form->field($model, 'count_times_view_clients') ?>

    <?php // echo $form->field($model, 'clients_rent_limit_phones_daily') ?>

    <?php // echo $form->field($model, 'clients_rent_module') ?>

    <?php // echo $form->field($model, 'clients_rent_phones') ?>

    <?php // echo $form->field($model, 'count_times_view_objects') ?>

    <?php // echo $form->field($model, 'objects_rent_limit_phones_daily') ?>

    <?php // echo $form->field($model, 'count_times_view_objects_archive') ?>

    <?php // echo $form->field($model, 'objects_rent_limit_phones_daily_archive') ?>

    <?php // echo $form->field($model, 'objects_rent_module') ?>

    <?php // echo $form->field($model, 'count_times_view_objects_sale') ?>

    <?php // echo $form->field($model, 'objects_sale_limit_phones_daily') ?>

    <?php // echo $form->field($model, 'calls_module') ?>

    <?php // echo $form->field($model, 'objects_rent_phones') ?>

    <?php // echo $form->field($model, 'mail_service_email') ?>

    <?php // echo $form->field($model, 'mail_service_password') ?>

    <?php // echo $form->field($model, 'mail_service_type') ?>

    <?php // echo $form->field($model, 'notify_module') ?>

    <?php // echo $form->field($model, 'id_domain') ?>

    <?php // echo $form->field($model, 'xml_feed_time_to') ?>

    <?php // echo $form->field($model, 'xml_feed_on_off') ?>

    <?php // echo $form->field($model, 'xml_feed_max') ?>

    <?php // echo $form->field($model, 'vk_login') ?>

    <?php // echo $form->field($model, 'vk_password') ?>

    <?php // echo $form->field($model, 'xml_feed_count_max') ?>

    <?php // echo $form->field($model, 'ap_login') ?>

    <?php // echo $form->field($model, 'ap_password') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
