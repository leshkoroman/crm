<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Agents */

$this->title = 'Create Agents';
$this->params['breadcrumbs'][] = ['label' => 'Agents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="agents-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $this->render('_form', [
        'model' => $model,
        'tarif' => $tarif,
        'tarifOrder' => $tarifOrder,
        'MeraUsersAccessControl' => $MeraUsersAccessControl,
        'MeraUsersAccessControl2' => $MeraUsersAccessControl2,
        'Sagent' => $Sagent,
    ])
    ?>

</div>
