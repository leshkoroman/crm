<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AgentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Агенты';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="agents-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php //echo Html::a('Создать агента', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php \yii\widgets\Pjax::begin(['id' => 'agents']); ?>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'id',
                'contentOptions' => ['style' => 'width:100px;'],
            ],
            
            [
                'attribute' => 'data_to',
                'contentOptions' => ['style' => 'text-align:center;width:200px;'],
            ],
            
            [
                'attribute' => 'spy',
                'contentOptions' => function($data) {
                    if ($data->spy == 'не входил') {
                        return ['style' => 'color:red'];
                    } else {
                        return ['style' => 'color:green'];
                    }
                }
            ],
                    
            [
                'attribute' => 'domain',
                'contentOptions' => ['style' => 'text-align:left;width:150px;'],
            ],
            [
                'attribute' => 'meraOnOff',
                'contentOptions' => function($data) {
                    if ($data->meraOnOff == 'вкл') {
                        return ['style' => 'color:green'];
                    } else {
                        return ['style' => 'color:red'];
                    }
                }
            ],
                    //'username',
                    //'id_sex',
                    //'surname',
                    'name:ntext',
                    // 'patronymic',
                    // 'phone',
                    // 'email:email',
                    // 'password',
                    // 'hash',
                    // 'id_type',
                    // 'date_add',
                    // 'access:ntext',
                    // 'online',
                    // 'last_computer_info',
                    // 'count_times_view_clients',
                    // 'clients_rent_limit_phones_daily',
                    // 'clients_rent_module',
                    // 'clients_rent_phones:ntext',
                    // 'count_times_view_objects',
                    // 'objects_rent_limit_phones_daily',
                    // 'count_times_view_objects_archive',
                    // 'objects_rent_limit_phones_daily_archive',
                    // 'objects_rent_module',
                    // 'count_times_view_objects_sale',
                    // 'objects_sale_limit_phones_daily',
                    // 'calls_module',
                    // 'objects_rent_phones:ntext',
                    // 'mail_service_email:email',
                    // 'mail_service_password',
                    // 'mail_service_type',
                    // 'notify_module',
                    // 'id_domain',
                    // 'xml_feed_time_to:datetime',
                    // 'xml_feed_on_off',
                    // 'xml_feed_max',
                    // 'vk_login',
                    // 'vk_password',
                    // 'xml_feed_count_max',
                    // 'ap_login',
                    // 'ap_password',
                    ['class' => 'yii\grid\ActionColumn',
                        'template' => '',
                    ],
        ],
    ]);
    ?>
    <?php \yii\widgets\Pjax::end(); ?>
</div>

