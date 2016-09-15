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
<div class="row agents-form">
    <div class="col-md-4 col-xs-12">
        <?php $form = ActiveForm::begin(); ?>
        <div class="row">
            <?php
            Panel::begin([
                'header' => 'Личные данные',
//                'collapsable' => true,
                'expandable' => true,
            ])
            ?>
            <div class="col-md-12 col-xs-12">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>   
                <?php echo $form->field($model, 'surname')->textInput(['maxlength' => true]) ?>
                <?=
                $form->field($model, 'phone')->textInput(['maxlength' => true])->widget(\yii\widgets\MaskedInput::className(), [
                    'mask' => '999-999-9999',
                ])
                ?>
                <?= $form->field($model, 'date_add')->textInput(['disabled' => true]) ?>
                <?php
                $tt = ArrayHelper::map(MeraDomains::find()->all(), 'id', 'domain_name');
                $tt[0] = 'ВСЕ';
                ksort($tt);
                ?>
                <?= $form->field($model, 'id_domain')->dropDownList($tt) ?>
            </div>        
            <?php Panel::end() ?>
        </div>

        <div class="row" style='//border:solid; margin-bottom:10px;'>
            <?php
            Panel::begin([
                'header' => 'Тариф',
                    //'options' => ['style' => 'padding-bottom: 50px;'],
            ])
            ?>

            <?php if (!$model->isNewRecord): ?>
                <?php echo $form->field($tarifOrder, 'id_tarif')->dropDownList(ArrayHelper::map($tarif, 'id', 'name'), ['prompt' => 'Выбрать', 'id' => 'id_user_m', 'data-id' => $model->id])->label(false) ?>
            <?php endif; ?>

            <?php Panel::end() ?>
        </div>
        <div class="row">
            <?php
            Panel::begin([
                'header' => 'МЕРА И ВИТРИНА',
//            'collapsable' => true,
                'expandable' => true,
                'id' => 'mv',
            ])
            ?>    
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
            <?php Panel::end() ?>
        </div>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
    <div class="col-md-8 col-xs-12">
        <?php
        Panel::begin([
            'removable' => true,
            'options' => [
                'class' => 'x_panel',
                'style' => 'border:solid green',
            ],
            'header' => 'Позвонить клиенту',
            'headerMenu' => [
                [
                    'label' => 'дествия 1',
                    'url' => '#',
                ],
                [
                    'label' => 'действия 2',
                    'url' => '#',
                ],
            ],
        ])
        ?>
        <div class="row">
            <div class="col-md-10 col-xs-12">
                <div class="row">
                    <div class="col-md-12 col-xs-12">
                        <span><?= date('Y-m-d H:i:s', time()) ?>. </span>
                        <span>Кто написал задачу.</span>
                        <span>Кому написно задачу, по какому вопросу</span>
                    </div>
                    <hr/>
                    <div class="row">
                        <div class="col-md-12 col-xs-12">
                            ТЕКСТ ТЕКСТ ТЕКСТ ТЕКСТ ТЕКСТ ТЕКСТ ТЕКСТ ТЕКСТ ТЕКСТ ТЕКСТ ТЕКСТ ТЕКСТ ТЕКСТ ТЕКСТ ТЕКСТ ТЕКСТ ТЕКСТ ТЕКСТ ТЕКСТ ТЕКСТ ТЕКСТ ТЕКСТ ТЕКСТ ТЕКСТ ТЕКСТ ТЕКСТ ТЕКСТ ТЕКСТ ТЕКСТ ТЕКСТ ТЕКСТ ТЕКСТ 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php Panel::end() ?>
        <div class="bs-glyphicons">
            <div class="bs-docs-section">
                <div class="bs-glyphicons">
                    <ul class="bs-glyphicons-list my-bs-glyphicons-list">
                        <li>
                            <span title="Добавить примечание" class="glyphicon glyphicon-align-justify" aria-hidden="true"></span>
                            <!--<span class="glyphicon-class">glyphicon glyphicon-time</span>-->
                        </li>
                        <li>
                            <span title="Добавить задачу" class="glyphicon glyphicon-time" aria-hidden="true"></span>
                            <!--<span class="glyphicon-class">glyphicon glyphicon-time</span>-->
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <?php foreach ([1, 2, 3, 4, 5] as $i): ?>
            <?php
            Panel::begin([
                'removable' => true,
            ])
            ?>
            <div class="row">
                <div class="col-md-10 col-xs-12">
                    <div class="row">
                        <div class="col-md-12 col-xs-12">
                            <span><?= date('Y-m-d H:i:s', time()) ?>. </span>
                            <span>Кто написал примечание.</span>
                            <span>Кому написно примечание</span>
                        </div>
                        <hr/>
                        <div class="row">
                            <div class="col-md-12 col-xs-12">
                                ТЕКСТ ТЕКСТ ТЕКСТ ТЕКСТ ТЕКСТ ТЕКСТ ТЕКСТ ТЕКСТ ТЕКСТ ТЕКСТ ТЕКСТ ТЕКСТ ТЕКСТ ТЕКСТ ТЕКСТ ТЕКСТ ТЕКСТ ТЕКСТ ТЕКСТ ТЕКСТ ТЕКСТ ТЕКСТ ТЕКСТ ТЕКСТ ТЕКСТ ТЕКСТ ТЕКСТ ТЕКСТ ТЕКСТ ТЕКСТ ТЕКСТ ТЕКСТ 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 col-xs-12">
                    <ul id="w13" class="nav navbar-right panel_toolbox" style="min-width:0px;">
                        <li>
                            <a class="update-link"><i class="fa fa-edit"></i></a>
                        </li>
                        <li>                        
                            <a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
            <?php Panel::end() ?>
        <?php endforeach; ?>
    </div>
</div>
