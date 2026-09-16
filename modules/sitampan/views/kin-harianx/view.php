<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\sitampan\models\KinHarian */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Kin Harians', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="kin-harian-view">

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
            'id_pns',
            'nip',
            'nama',
            'tablok',
            'tablokb',
            'tgl:date',
            'kode_kegiatan_h',
            'uraian_keg_h:ntext',
            'tgl_target',
            'target_kuan_h',
            'target_output_h',
            'target_waktu_h',
            'target_sat_waktu_h:integer',
            'tgl_real',
            'real_kuan_h',
            'real_output_h:integer',
            'real_waktu_h',
            'real_sat_waktu_h:integer',
            'tgl_ok',
            'ok_kuan_h',
            'ok_output_h:integer',
            'ok_waktu_h',
            'ok_sat_waktu_h:integer',
            'penilai_nip',
            'penilai_nama',
            'penilai_tablok',
            'penilai_tablokb',
            'flag:integer',
        ],
    ]) ?>

</div>
