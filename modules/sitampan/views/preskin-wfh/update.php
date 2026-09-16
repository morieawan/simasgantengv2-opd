<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\sitampan\models\PreskinWfh $model */

$this->title = 'Update Preskin Wfh: ' . $model->id_wfh;
$this->params['breadcrumbs'][] = ['label' => 'Preskin Wfhs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_wfh, 'url' => ['view', 'id_wfh' => $model->id_wfh]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="preskin-wfh-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
