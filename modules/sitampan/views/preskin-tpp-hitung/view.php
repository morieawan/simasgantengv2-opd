<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\sitampan\models\PreskinTppHitung */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Preskin Tpp Hitungs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="preskin-tpp-hitung-view">

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
            'tahun',
            'bulan',
            'jtrans',
            'idpns',
            'nip',
            'nama',
            'jenis_jab',
            'kode_jab',
            'nama_jab',
            'kelas_jab_tpp',
            'tablok',
            'nama_opd',
            'tablokb',
            'nama_unor',
            'gol',
            'nama_gol',
            'pagu',
            'persen_tpp',
            'beban_jab',
            'beban_opd',
            'kondisi_jab',
            'kondisi_opd',
            'pol_jab',
            'pol_opd',
            'prestasi_jab',
            'prestasi_opd',
            'tempat_jab',
            'tempat_opd',
            'profesi_jab',
            'persen_tpp_rp',
            'beban_jab_rp',
            'beban_opd_rp',
            'kondisi_jab_rp',
            'kondisi_opd_rp',
            'pol_jab_rp',
            'pol_opd_rp',
            'prestasi_jab_rp',
            'prestasi_opd_rp',
            'tempat_jab_rp',
            'tempat_opd_rp',
            'profesi_jab_rp',
            'pagu_total',
            'pagu_tpp',
            'beban_kerja',
            'produktivitas_kerja',
            'kinerja',
            'presensi',
            'sakip',
            'rb',
            'kinerja_rp',
            'presensi_rp',
            'sakip_rp',
            'rb_rp',
            'tpp_jumlah',
            'cuti',
            'hukdis',
            'tgr',
            'lhkpn',
            'aset',
            'cuti_rp',
            'hukdis_rp',
            'tgr_rp',
            'pengurangan',
            'tpp_total',
            'pph',
            'pph_rp',
            'bpjs4',
            'tpp_bruto',
            'bpjs1',
            'pot_jml',
            'tpp_net',
            'status',
            'tgl_cetak:date',
            'updated',
        ],
    ]) ?>

</div>
