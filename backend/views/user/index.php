<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use yiister\gentelella\widgets\grid;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Менеджеры';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p>
        <?= Html::a('Создать менеджера', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>    <?=
    grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'username',
            'name',
            //'auth_key',
            'password',
            //'password_reset_token',
            'email:email',
            //'status',
            // 'created_at',
            // 'updated_at',            
            // 'main_photo',
            [
                'header' => 'Фото',
                'format' => 'html',
                'value' => function($searchModel) {
                    if (isset($searchModel->main_photo) && $searchModel->main_photo) {
                        return '<img style="width:40px; text-align:center;" src="' . $searchModel->main_photo . '">';
                    } else {
                        return '<img style="width:40px; text-align:center;" src="http://merapoisk.ru/img/noimage.png">';
                    }
                },
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
    <?php Pjax::end(); ?></div>
