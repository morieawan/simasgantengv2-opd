<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\modules\sitampan\models\PreskinWfh $model */

$this->title = $model->id_wfh;
$this->params['breadcrumbs'][] = ['label' => 'Preskin Wfhs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="preskin-wfh-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id_wfh' => $model->id_wfh], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id_wfh' => $model->id_wfh], [
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
            'id_wfh',
            'nip',
            'tgl',
        ],
    ]) ?>

</div>
