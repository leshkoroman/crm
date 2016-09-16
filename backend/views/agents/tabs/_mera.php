<?php

use \yiister\gentelella\widgets\Panel;
use kartik\date\DatePickerAsset;
use kartik\date\DatePicker;
?>
<div class="row">
    <?php
    Panel::begin([
        'header' => 'Пароли',
        'expandable' => true,
        'id'=>'pasw',
    ])
    ?>
    <div class="col-md-12 col-xs-12">

        <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'password')->textInput(['maxlength' => true]) ?>


        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'mail_service_password')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'mail_service_type')->dropDownList(['yandex' => 'yandex', 'gmail' => 'gmail', 'mail.ru' => 'mail.ru']) ?>
        <?= $form->field($model, 'vk_login')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'vk_password')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'ap_login')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'ap_password')->textInput(['maxlength' => true]) ?>


    </div>
    <?php Panel::end() ?>
</div>
<div class="row">
    <?php
    Panel::begin([
        'header' => 'Модуль "АРЕНДА"',
        'expandable' => true,
    ])
    ?>
    <div class="col-md-12 col-xs-12">
        <?= $form->field($model, 'objects_rent_module')->dropDownList([0 => 'Выкл.', 1 => 'Вкл.']) ?>
    
        <?= $form->field($model, 'objects_rent_limit_phones_daily')->textInput() ?>
    
        <?= $form->field($model, 'objects_rent_limit_phones_daily_archive')->textInput() ?>    
        <?php
        if (isset($MeraUsersAccessControl->date_end_object) && $MeraUsersAccessControl->date_end_object) {
            $vall = date("d.m.Y", $MeraUsersAccessControl->date_end_object);
        } else {
            $vall = (isset($MeraUsersAccessControl->date_end) && $MeraUsersAccessControl->date_end) ? date("d.m.Y", strtotime($MeraUsersAccessControl->date_end)) : '';
        }
        echo '<label class="control-label">Заканчивается</label>';
        echo DatePicker::widget([
            'name' => 'MeraUsersAccessControl[date_end_object]',
            'value' => $vall,
            'options' => ['placeholder' => 'Введите дату ...'],
            'pluginOptions' => [
                'format' => 'dd.mm.yyyy',
                'todayHighlight' => true
            ]
        ]);
        ?>        
    </div>
    <?php Panel::end() ?>
</div>

<div class="row">
    <?php
    Panel::begin([
        'header' => 'Модуль "XML"',
        'expandable' => true,
    ])
    ?>
    <div class="col-md-12 col-xs-12">
        <?= $form->field($model, 'xml_feed_on_off')->dropDownList([0 => 'Выкл.', 1 => 'Вкл.']) ?>
    
        <?= $form->field($model, 'xml_feed_count_max')->textInput() ?>    
    </div>
    <?php Panel::end() ?>
</div>