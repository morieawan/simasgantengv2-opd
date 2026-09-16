<?php

use yii\helpers\Html;
use yii\helpers\Url;
//use yii\helpers\ArrayHelper;
use kartik\widgets\ActiveForm;
use kartik\number\NumberControl;
//use kartik\select2\Select2;
use kartik\datecontrol\DateControl;

/* @var $this yii\web\View */
/* @var $model app\modules\sitampan\models\PreskinTppHitung */
/* @var $form yii\widgets\ActiveForm */

$dispOptions = ['class' => 'form-control kv-monospace']; 
$saveOptions = [
    'type' => 'hidden', 
    'readonly' => true, 
    'tabindex' => 1000
];
 
$saveCont = ['class' => 'kv-saved-cont'];
?>

<div class="preskin-tpp-hitung-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php //echo $form->field($model, 'id')->textInput(['maxlength' => true, 'readonly' => true]) ?>

    <?= $form->field($model, 'tahun')->textInput(['maxlength' => true, 'readonly' => true]) ?>

    <?= $form->field($model, 'bulan')->textInput(['maxlength' => true, 'readonly' => true]) ?>

    <?php //echo $form->field($model, 'jtrans')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'idpns')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nip')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'jenis_jab')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'kode_jab')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'nama_jab')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kelas_jab_tpp')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'tablok')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama_opd')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'tablokb')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'nama_unor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gol')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'nama_gol')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'pagu')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'persen_tpp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kinerja')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cuti')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hukdis')->textInput(['maxlength' => true]) ?>


    <?php //echo $form->field($model, 'beban_jab')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'beban_opd')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'kondisi_jab')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'kondisi_opd')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'pol_jab')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'pol_opd')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'prestasi_jab')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'prestasi_opd')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'tempat_jab')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'tempat_opd')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'profesi_jab')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'persen_tpp_rp')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'beban_jab_rp')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'beban_opd_rp')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'kondisi_jab_rp')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'kondisi_opd_rp')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'pol_jab_rp')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'pol_opd_rp')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'prestasi_jab_rp')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'prestasi_opd_rp')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'tempat_jab_rp')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'tempat_opd_rp')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'profesi_jab_rp')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'pagu_total')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'pagu_tpp')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'beban_kerja')->textInput(['maxlength' => true]) ?>

    <?php /* $form->field($model, 'produktivitas_kerja')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kinerja')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'presensi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sakip')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rb')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kinerja_rp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'presensi_rp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sakip_rp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rb_rp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tpp_jumlah')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tgr')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lhkpn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'aset')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cuti_rp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hukdis_rp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tgr_rp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pengurangan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tpp_total')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pph')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pph_rp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bpjs4')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tpp_bruto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bpjs1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pot_jml')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tpp_net')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tgl_cetak')->widget(DateControl::classname(), [
                'type'=>DateControl::FORMAT_DATE,
            ]) ?>

    <?= $form->field($model, 'updated')->textInput(['maxlength' => true]) */?>

    <div class="form-group">
        <?=  Html::submitButton('<i class=\"fas fa-save\"></i> Simpan', ['class' => 'btn btn-success']) ?>
        <?=  Html::a('<i class=\"fas fa-minus-circle\"></i> Batal',' ', ['class' => 'btn btn-danger', 'data-dismis' => 'modal']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
