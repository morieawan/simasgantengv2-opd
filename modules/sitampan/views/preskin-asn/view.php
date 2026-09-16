<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\sitampan\models\PreskinAsn */

$this->title = $model->nip;
$this->params['breadcrumbs'][] = ['label' => 'Preskin Asns', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="preskin-asn-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->nip], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->nip], [
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
            'nip',
            'idpns',
            'kode_kelas_jab',
            'kode_jadwal',
            'pres',
            'kin',
            'tpp',
            'tmt_stop:date',
            'status',
            'updated',
        ],
    ]) ?>

</div>
