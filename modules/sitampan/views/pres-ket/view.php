<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\sitampan\models\PresKet */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pres Kets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="pres-ket-view">

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
            'opd',
            'jenis_ket:integer',
            'no_surat',
            'tgl_surat:date',
            'tgl_awal:date',
            'tgl_akhir:date',
            'nip:ntext',
            'detail:ntext',
            'flag:integer',
            'updated',
        ],
    ]) ?>

</div>
