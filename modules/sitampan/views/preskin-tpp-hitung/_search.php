<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\sitampan\models\PreskinTppHitungSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="preskin-tpp-hitung-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'id' => 'cari-form', 
        'type' => ActiveForm::TYPE_INLINE,
        'fieldConfig' => ['options' => ['class' => 'form-group mr-2 mb-3']], 
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'tahun') ?>

    <?= $form->field($model, 'bulan') ?>

    <?= $form->field($model, 'jtrans') ?>

    <?= $form->field($model, 'idpns') ?>

    <?php // echo $form->field($model, 'nip') ?>

    <?php // echo $form->field($model, 'nama') ?>

    <?php // echo $form->field($model, 'jenis_jab') ?>

    <?php // echo $form->field($model, 'kode_jab') ?>

    <?php // echo $form->field($model, 'nama_jab') ?>

    <?php // echo $form->field($model, 'kelas_jab_tpp') ?>

    <?php // echo $form->field($model, 'tablok') ?>

    <?php // echo $form->field($model, 'nama_opd') ?>

    <?php // echo $form->field($model, 'tablokb') ?>

    <?php // echo $form->field($model, 'nama_unor') ?>

    <?php // echo $form->field($model, 'gol') ?>

    <?php // echo $form->field($model, 'nama_gol') ?>

    <?php // echo $form->field($model, 'pagu') ?>

    <?php // echo $form->field($model, 'persen_tpp') ?>

    <?php // echo $form->field($model, 'beban_jab') ?>

    <?php // echo $form->field($model, 'beban_opd') ?>

    <?php // echo $form->field($model, 'kondisi_jab') ?>

    <?php // echo $form->field($model, 'kondisi_opd') ?>

    <?php // echo $form->field($model, 'pol_jab') ?>

    <?php // echo $form->field($model, 'pol_opd') ?>

    <?php // echo $form->field($model, 'prestasi_jab') ?>

    <?php // echo $form->field($model, 'prestasi_opd') ?>

    <?php // echo $form->field($model, 'tempat_jab') ?>

    <?php // echo $form->field($model, 'tempat_opd') ?>

    <?php // echo $form->field($model, 'profesi_jab') ?>

    <?php // echo $form->field($model, 'persen_tpp_rp') ?>

    <?php // echo $form->field($model, 'beban_jab_rp') ?>

    <?php // echo $form->field($model, 'beban_opd_rp') ?>

    <?php // echo $form->field($model, 'kondisi_jab_rp') ?>

    <?php // echo $form->field($model, 'kondisi_opd_rp') ?>

    <?php // echo $form->field($model, 'pol_jab_rp') ?>

    <?php // echo $form->field($model, 'pol_opd_rp') ?>

    <?php // echo $form->field($model, 'prestasi_jab_rp') ?>

    <?php // echo $form->field($model, 'prestasi_opd_rp') ?>

    <?php // echo $form->field($model, 'tempat_jab_rp') ?>

    <?php // echo $form->field($model, 'tempat_opd_rp') ?>

    <?php // echo $form->field($model, 'profesi_jab_rp') ?>

    <?php // echo $form->field($model, 'pagu_total') ?>

    <?php // echo $form->field($model, 'pagu_tpp') ?>

    <?php // echo $form->field($model, 'beban_kerja') ?>

    <?php // echo $form->field($model, 'produktivitas_kerja') ?>

    <?php // echo $form->field($model, 'kinerja') ?>

    <?php // echo $form->field($model, 'presensi') ?>

    <?php // echo $form->field($model, 'sakip') ?>

    <?php // echo $form->field($model, 'rb') ?>

    <?php // echo $form->field($model, 'kinerja_rp') ?>

    <?php // echo $form->field($model, 'presensi_rp') ?>

    <?php // echo $form->field($model, 'sakip_rp') ?>

    <?php // echo $form->field($model, 'rb_rp') ?>

    <?php // echo $form->field($model, 'tpp_jumlah') ?>

    <?php // echo $form->field($model, 'cuti') ?>

    <?php // echo $form->field($model, 'hukdis') ?>

    <?php // echo $form->field($model, 'tgr') ?>

    <?php // echo $form->field($model, 'lhkpn') ?>

    <?php // echo $form->field($model, 'aset') ?>

    <?php // echo $form->field($model, 'cuti_rp') ?>

    <?php // echo $form->field($model, 'hukdis_rp') ?>

    <?php // echo $form->field($model, 'tgr_rp') ?>

    <?php // echo $form->field($model, 'pengurangan') ?>

    <?php // echo $form->field($model, 'tpp_total') ?>

    <?php // echo $form->field($model, 'pph') ?>

    <?php // echo $form->field($model, 'pph_rp') ?>

    <?php // echo $form->field($model, 'bpjs4') ?>

    <?php // echo $form->field($model, 'tpp_bruto') ?>

    <?php // echo $form->field($model, 'bpjs1') ?>

    <?php // echo $form->field($model, 'pot_jml') ?>

    <?php // echo $form->field($model, 'tpp_net') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'tgl_cetak') ?>

    <?php // echo $form->field($model, 'updated') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
