<?php

use \yiister\gentelella\widgets\Panel;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\MeraDomains;
use kartik\date\DatePicker;

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
    <div class="col-md-8 col-xs-12 my_comments_task">
        <?php foreach ($ManagerTask as $mt): ?>
            <?php
            Panel::begin([
                'id' => 'tt_' . $mt->id,
                //'removable' => true,
                'options' => [
                    'class' => 'x_panel',
                    'style' => (strtotime($mt->date_to) > time()) ? 'border:solid green' : 'border:solid red',
                ],
                'header' => $mt->tasks->name . ': исполнить до ' . date('Y-m-d', strtotime($mt->date_to)),
//            'headerMenu' => [
//                [
//                    'label' => 'сделать',
//                    'url' => '#',
//                ],
//                [
//                    'label' => 'действия 2',
//                    'url' => '#',
//                ],
//            ],
            ])
            ?>
            <input type='hidden' name="ddd" value="<?= $mt->tasks->name ?>" id='hidden_tasks_name<?= $mt->id ?>'>
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <div class="row">
                        <div class="col-md-12 col-xs-12">
                            <span>Добавил <?= $mt->date_add ?>. </span>
                            <span><?= $UserInfo->name ?>.</span>
                            <span>По агенту <?= $model->name ?></span>
                        </div>
                        <hr/>
                        <div class="row">
                            <div class="col-md-12 col-xs-12" id="task_comment_<?= $mt->id ?>">
                                <?= $mt->comment ?>
                            </div>
                        </div>
                    </div>
                </div>                
            </div>
            <div class="row">
                <div class="form-group" style="margin-bottom: 0px;">
                    <input type=text" id="text_task_result" class="form-control text_task_result" name="task_result" rows="6" placeholder="Добавить результат" style="resize:none">
                    <button data-id="<?= $mt->id ?>" type="button" onclick="task_do(<?= $mt->id ?>, $(this))" class="btn my_button_save_comment">Выполнить</button>
                </div>
            </div>
            <?php Panel::end() ?>
        <?php endforeach; ?>

        <div class="bs-glyphicons">
            <div class="bs-docs-section">
                <div class="bs-glyphicons">
                    <ul class="bs-glyphicons-list my-bs-glyphicons-list">
                        <li>
                            <span title="Добавить примечание" id="add_comment" class="glyphicon glyphicon-align-justify" aria-hidden="true"></span>
                            <!--<span class="glyphicon-class">glyphicon glyphicon-time</span>-->
                        </li>
                        <li>
                            <span title="Добавить задачу" id="add_task" class="glyphicon glyphicon-time" aria-hidden="true"></span>
                            <!--<span class="glyphicon-class">glyphicon glyphicon-time</span>-->
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row comment" id="comment">
            <div class="col-md-12 col-xs-12">
                <?php
                Panel::begin([
                    'removable' => true,
                ])
                ?>
                <div>
                    <span>Сегодня</span> <span><?= date('H:i:s', time()) ?>. </span> 
                    <span>Добавил: <b><i><?= $UserInfo->name ?></i></b>,</span>
                    <span>для агента: <b><i><?= $model->name ?>.</i></b></span>
                </div>
                <div class="row">
                    <div class="form-group">
                        <textarea id="text_comment" class="form-control" name="comment" rows="6" style="resize:none"></textarea>                        
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <button data-id="<?= $model->id ?>" type="button" id="button_text_comment" class="btn btn-primary">Сохранить</button>
                    </div>
                </div>
                <?php Panel::end() ?>
            </div>                
        </div>
        <div class="row task" id="task">
            <div class="col-md-12 col-xs-12">
                <?php
                Panel::begin([
                    'removable' => true,
                    'options' => [
                    'class' => 'x_panel',
                    'style' => 'border:solid green',
                ],
                ])
                ?>
                <div class="row">
                    <div class="col-md-6 col-xs-12">
                        <div class="form-group">
                            <?php
                            echo DatePicker::widget([
                                'name' => 'task_date',
                                'value' => '',
                                'options' => ['placeholder' => 'Введите дату ...', 'id'=>'task_date'],
                                'pluginOptions' => [
                                    'format' => 'dd.mm.yyyy',
                                    'todayHighlight' => true
                                ]
                            ]);
                            ?>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <div class="form-group">
                            <?= yii\bootstrap\Html::dropDownList('task_type', null, ArrayHelper::map(\common\models\TaskTypes::find()->all(), 'id', 'name'), ['prompt' => 'Выбрать', 'class' => 'form-control', 'id'=>'task_type']) ?>
                        </div>                        
                    </div>
                    <div class="col-md-12 col-xs-12">
                        <div class="form-group">
                            <textarea id="task_text_comment" class="form-control" name="task_comment" rows="5" style="resize:none"></textarea>    
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-xs-12">
                        <div class="form-group">
                            <button data-id="<?= $model->id ?>" type="button" id="button_text_task" class="btn btn-primary">Сохранить</button>
                            <button data-id="<?= $model->id ?>" type="button" id="button_text_task_close" class="btn my_button_save_comment">Отмена</button>
                        </div>
                    </div>
                </div>
                <?php Panel::end() ?>
            </div>                
        </div>
        <div class="row" id="list_comments">
            <?php foreach ($ManagerComments as $mc): ?>
                <?php
                Panel::begin([
                    'removable' => true,
                    'options' => [
                        'class' => 'x_panel',
                    ],
                    'id' => "w_" . $mc->id,
                ])
                ?>
                <div class="row">
                    <div class="col-md-10 col-xs-12">
                        <div class="row">
                            <div class="col-md-12 col-xs-12">
                                <span class="<?= ($mc->from_task) ? 'task_footer' : 'comment_footer' ?>"><?= ($mc->from_task) ? 'Задача ' : 'Комментарий ' ?></span>
                                <span><?= $mc->date_add ?>. </span>
                                <span>Добавил: <b><i><?= $mc->user->name ?>.</i></b></span>
                                <span>для агента: <b><i><?= $mc->agent->name ?></i></b></span>
                            </div>
                            <hr/>
                            <div class="row">
                                <div class="col-md-12 col-xs-12 <?= ($mc->from_task) ? 'task_decor' : '' ?>">
                                    <?= $mc->comment ?>
                                </div>
                                <?php if ($mc->from_task): ?>
                                    <hr/>
                                    <div class="col-md-12 col-xs-12">
                                        <span>Задача: <b><?= $mc->task->name ?>.</b></span> <span>Результат: <b><?= $mc->from_task_result ?></b></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-xs-12">
                        <ul id="w13" class="nav navbar-right panel_toolbox" style="min-width:0px;">
                            <!--                        <li>
                                                        <a class="update-link"><i class="fa fa-edit"></i></a>
                                                    </li>-->
                            <li>                        
                                <a onclick="my_close(<?= $mc->id ?>)" data-id="<?= $mc->id ?>" class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <?php Panel::end() ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>
