<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Agents */

$this->title = 'Изменить агента: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Agents', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="agents-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $this->render('_form', [
        'model' => $model,
        'tarif' => $tarif,
        'tarifOrder' => $tarifOrder,
        'MeraUsersAccessControl' => $MeraUsersAccessControl,
        'MeraUsersAccessControl2' => $MeraUsersAccessControl2,
        'Sagent' => $Sagent,
        'UserInfo'=>$UserInfo,
        'ManagerComments'=>$ManagerComments,
        'ManagerTask'=>$ManagerTask,
    ])
    ?>

</div>
