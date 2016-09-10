<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?php if (isset($profile) && $profile): ?>            
            <?= Html::a('Настройки', ['/user/settings'], ['class' => 'btn btn-info']) ?>                        
        <?php else: ?>
            <?= Html::a('Просмотр всех', ['index'], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
            <?=
            Html::a('Удалить', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ])
            ?>
        <?php endif; ?>
    </p>
    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            // 'auth_key',
            // 'password_hash',
            'password',
            //'password_reset_token',
            'email:email',
            //'status',
            // 'created_at',
            // 'updated_at',
            // 'role',
            'name',
            [
                'attribute' => 'main_photo',
                'value' => $model->main_photo,
                'format' => ['image', ['width' => '100', 'height' => '100']],
            ],
        ],
    ])
    ?>

</div>
