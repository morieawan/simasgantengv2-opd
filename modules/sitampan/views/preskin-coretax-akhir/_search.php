<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var app\modules\sitampan\models\PreskinCoretaxAkhirSearch $model */
/** @var yii\widgets\ActiveForm $form */

$this->title = 'Coretax Akhir Masa Pajak';
?>

<div class="preskin-coretax-akhir-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'id' => 'form-horizontal',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'horizontalCssClasses' => [
                'label' => 'col-sm-3',
                'offset' => 'col-sm-offset-3',
                'wrapper' => 'col-md-9',
            ],
        ],
    ]); ?>

    <?php // echo  $form->field($model, 'pemberi_kerja') ?>

    <?php // echo $form->field($model, 'masa_awal') ?>

    <?php // echo  $form->field($model, 'masa_akhir') ?>

    <?= $form->field($model, 'tahun_pajak')->textInput(['value' => date('Y')]) ?>

    <?= $form->field($model, 'tablok')->widget(Select2::class, [
        'data' => ArrayHelper::map($skpd, 'KDSKPD', 'tablok'),
        'options' => [
            'placeholder' => 'Pilih ...',
        ],
        'pluginOptions' => [
            'allowClear' => false,
        ],
    ]); ?>

    <?= $form->field($model, 'npwp') ?>

    <?= $form->field($model, 'nip') ?>

    <?= $form->field($model, 'nama') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'posisi') ?>

    <?php // echo $form->field($model, 'pangkat_gol') ?>

    <?php // echo $form->field($model, 'kd_obj_pajak') ?>

    <?php // echo $form->field($model, 'bupot') ?>

    <?php // echo $form->field($model, 'jml_bln') ?>

    <?php // echo $form->field($model, 'gaji') ?>

    <?php // echo $form->field($model, 'tunj_istri') ?>

    <?php // echo $form->field($model, 'tunj_anak') ?>

    <?php // echo $form->field($model, 'tpp') ?>

    <?php // echo $form->field($model, 'tunj_jabatan') ?>

    <?php // echo $form->field($model, 'tunj_beras') ?>

    <?php // echo $form->field($model, 'tunj_khusus') ?>

    <?php // echo $form->field($model, 'tunj_lain') ?>

    <?php // echo $form->field($model, 'iuran_pensiun') ?>

    <?php // echo $form->field($model, 'zakat') ?>

    <?php // echo $form->field($model, 'no_bupot_sebelumnya') ?>

    <?php // echo $form->field($model, 'pph_terbayar') ?>

    <?php // echo $form->field($model, 'id_tku') ?>

    <?php // echo $form->field($model, 'tgl_potong') ?>

    <?php // echo $form->field($model, 'tablok') ?>

    <?php // echo $form->field($model, 'satker') ?>

    <?php // echo $form->field($model, 'bruto_gaji') ?>

    <?php // echo $form->field($model, 'jkk') ?>

    <?php // echo $form->field($model, 'jkm') ?>

    <?php // echo $form->field($model, 'bpjs4') ?>

    <?php // echo $form->field($model, 'tjstruk') ?>

    <?php // echo $form->field($model, 'tjfung') ?>

    <?php // echo $form->field($model, 'tjumum') ?>

    <?php // echo $form->field($model, 'tjbulat') ?>

    <?php // echo $form->field($model, 'bruto_total') ?>

    <?php // echo $form->field($model, 'pot_bea_jabatan') ?>

    <?php // echo $form->field($model, 'pot_iuran_pensiun') ?>

    <?php // echo $form->field($model, 'netto') ?>

    <?php // echo $form->field($model, 'ptkp') ?>

    <?php // echo $form->field($model, 'pkp_total') ?>

    <?php // echo $form->field($model, 'pkp5') ?>

    <?php // echo $form->field($model, 'pkp15') ?>

    <?php // echo $form->field($model, 'pkp25') ?>

    <?php // echo $form->field($model, 'pkp30') ?>

    <?php // echo $form->field($model, 'pkp35') ?>

    <?php // echo $form->field($model, 'pph5') ?>

    <?php // echo $form->field($model, 'pph15') ?>

    <?php // echo $form->field($model, 'pph25') ?>

    <?php // echo $form->field($model, 'pph30') ?>

    <?php // echo $form->field($model, 'pph35') ?>

    <?php // echo $form->field($model, 'pph_total') ?>

    <?php // echo $form->field($model, 'pph_gaji_terbayar') ?>

    <?php // echo $form->field($model, 'pph_tpp_terbayar') ?>

    <?php // echo $form->field($model, 'pph_gaji_akhir_masa') ?>

    <?php // echo $form->field($model, 'pph_terhutang') ?>

    <?php // echo $form->field($model, 'jenis') ?>

    <?php // echo $form->field($model, 'flag') ?>

    <?php // echo $form->field($model, 'updated') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
