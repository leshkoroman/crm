<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Agents */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Agents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="agents-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'id_sex',
            'surname',
            'name',
            'patronymic',
            'phone',
            'email:email',
            'password',
            'hash',
            'id_type',
            'date_add',
            'access:ntext',
            'online',
            'last_computer_info',
            'count_times_view_clients',
            'clients_rent_limit_phones_daily',
            'clients_rent_module',
            'clients_rent_phones:ntext',
            'count_times_view_objects',
            'objects_rent_limit_phones_daily',
            'count_times_view_objects_archive',
            'objects_rent_limit_phones_daily_archive',
            'objects_rent_module',
            'count_times_view_objects_sale',
            'objects_sale_limit_phones_daily',
            'calls_module',
            'objects_rent_phones:ntext',
            'mail_service_email:email',
            'mail_service_password',
            'mail_service_type',
            'notify_module',
            'id_domain',
            'xml_feed_time_to:datetime',
            'xml_feed_on_off',
            'xml_feed_max',
            'vk_login',
            'vk_password',
            'xml_feed_count_max',
            'ap_login',
            'ap_password',
        ],
    ]) ?>

</div>
