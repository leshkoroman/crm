<?php

use \yiister\gentelella\widgets\Panel;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\MeraDomains;

/* @var $this yii\web\View */
/* @var $model common\models\Agents */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="agents-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <?php
        Panel::begin([
            'header' => 'Личные данные',
        ])
        ?>
        <div class="col-md-4 col-xs-12">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>   
            <?=
            $form->field($model, 'phone')->textInput(['maxlength' => true])->widget(\yii\widgets\MaskedInput::className(), [
                'mask' => '999-999-9999',
            ])
            ?>
        </div>
        <div class="col-md-4 col-xs-12">
            <?php echo $form->field($model, 'surname')->textInput(['maxlength' => true]) ?>
            <?php
            $tt = ArrayHelper::map(MeraDomains::find()->all(), 'id', 'domain_name');
            $tt[0] = 'ВСЕ';
            ksort($tt);
            ?>
            <?= $form->field($model, 'id_domain')->dropDownList($tt) ?>
        </div>
        <div class="col-md-4 col-xs-12">
            <?= $form->field($model, 'patronymic')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4 col-xs-12">
            <?= $form->field($model, 'date_add')->textInput(['disabled' => true]) ?>
        </div>
        <?php Panel::end() ?>
    </div>

    <div class="row" style='border:solid; margin-bottom:10px;'>
        <?php
        Panel::begin([
            'header' => 'Тариф',
            'options' => ['style' => 'padding-bottom: 50px;'],
        ])
        ?>

        <?php if (!$model->isNewRecord): ?>
            <?php echo $form->field($tarifOrder, 'id_tarif')->dropDownList(ArrayHelper::map($tarif, 'id', 'name'), ['prompt' => 'Выбрать', 'id' => 'id_user_m', 'data-id' => $model->id])->label(false) ?>
        <?php endif; ?>

        <?php Panel::end() ?>
    </div>

    <?php
    echo \yii\bootstrap\Tabs::widget([
        'items' => [
            [
                'label' => 'Мерапоиск',
                'content' => $this->render('tabs/_mera', ['model' => $model, 'form' => $form, 'MeraUsersAccessControl' => $MeraUsersAccessControl,]),
                'active' => true
            ],
            [
                'label' => 'Витрина',
                'content' => $this->render('tabs/_vitrina', [
                    'model' => $model,
                    'form' => $form,
                    'MeraUsersAccessControl' => $MeraUsersAccessControl,
                    'MeraUsersAccessControl2' => $MeraUsersAccessControl2,
                    'Sagent' => $Sagent,
                ]),
            ],
        ],
    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
