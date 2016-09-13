<div class="row">
    <div class="col-md-4 col-xs-12">
        <?=
        $form->field($MeraUsersAccessControl2, 'phone_1')->textInput(['maxlength' => true])->widget(\yii\widgets\MaskedInput::className(), [
            'mask' => '999-999-9999',
        ])
        ?>
    </div>
    <div class="col-md-4 col-xs-12">
        <?= $form->field($Sagent, 'email')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-4 col-xs-12">

    </div>

</div>

<div class="row">
    <div class="col-md-4 col-xs-12">
        <?= $form->field($Sagent, 'domain')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-4 col-xs-12">
        <?= $form->field($Sagent, 'status')->dropDownList([0 => 'Выкл.', 1 => 'Вкл.']) ?>
    </div>
    <div class="col-md-4 col-xs-12">

    </div>

</div>

<div class="row">
    <div class="col-md-12 col-xs-12">
        <?= $form->field($Sagent, 'site_header1')->textInput(['maxlength' => true]) ?>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-xs-12">
        <?= $form->field($Sagent, 'site_header2')->textInput(['maxlength' => true]) ?>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-xs-12">
        <?= $form->field($Sagent, 'agent_info')->textArea(['rows' => 6, 'style'=>'resize:none']) ?>
    </div>
</div>

<div class="row">
    <div class="col-md-3 col-xs-12">
        <?= $form->field($Sagent, 'g_link')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-3 col-xs-12">
        <?= $form->field($Sagent, 'v_link')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-3 col-xs-12">
        <?= $form->field($Sagent, 't_link')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-3 col-xs-12">
        <?= $form->field($Sagent, 'f_link')->textInput(['maxlength' => true]) ?>
    </div>
</div>