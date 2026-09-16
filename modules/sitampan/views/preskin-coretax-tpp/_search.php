<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var app\modules\sitampan\models\PreskinCoretaxTppSearch $model */
/** @var yii\widgets\ActiveForm $form */

$this->title = 'Coretax';
$this->params['breadcrumbs'][] = $this->title;

$model['masa_pajak'] = date('n');
?>

<div class="preskin-coretax-tpp-search">

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

    
    <?= $form->field($model, 'tahun_pajak')->textInput(['type' => 'number', 'required' => true, 'value' => date('Y')])->label('Tahun Penerimaan <span class="text-danger">*</span>') ?>

    <?= $form->field($model, 'masa_pajak')->widget(Select2::class, [
        'data' => [1=>'Januari', 2=>'Februari', 3=>'Maret', 4=>'April', 5=>'Mei', 6=>'Juni', 7=>'Juli', 8=>'Agustus', 9=>'September', 10=>'Oktober', 11=>'November', 12=>'Desember'],
        'options' => [
            'placeholder' => 'Pilih ...',
            'required' => true,
        ],
        'pluginOptions' => [
            'allowClear' => false,
        ],
    ])->label('Bulan Penerimaan <span class="text-danger">*</span>'); ?>

    <?= $form->field($model, 'tablok')->widget(Select2::class, [
        'data' => ArrayHelper::map($skpd, 'KDSKPD', 'tablok'),
        'options' => [
            'placeholder' => 'Pilih ...',
            'required' => true,
        ],
        'pluginOptions' => [
            'allowClear' => false,
        ],
    ])->label('OPD <span class="text-danger">*</span>'); ?>

    <?= $form->field($model, 'nip') ?>

    <?= $form->field($model, 'nama') ?>

    <?php // echo $form->field($model, 'nik') ?>

    <?php // echo $form->field($model, 'passport') ?>

    <?php // echo $form->field($model, 'stapeg') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'posisi') ?>

    <?php // echo $form->field($model, 'fasilitas') ?>

    <?php // echo $form->field($model, 'kode_op') ?>

    <?php // echo $form->field($model, 'bruto') ?>

    <?php // echo $form->field($model, 'tarif') ?>

    <?php // echo $form->field($model, 'id_tku') ?>

    <?php // echo $form->field($model, 'tgl_potong') ?>

    <?php // echo $form->field($model, 'nip') ?>

    <?php // echo $form->field($model, 'nama') ?>

    <?php // echo $form->field($model, 'bruto_gaji') ?>

    <?php // echo $form->field($model, 'bruto_tpp') ?>

    <?php // echo $form->field($model, 'pph_gaji') ?>

    <?php // echo $form->field($model, 'pph_tpp') ?>

    <?php // echo $form->field($model, 'pph_total') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
