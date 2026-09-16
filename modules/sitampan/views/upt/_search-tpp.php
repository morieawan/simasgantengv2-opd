<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\modules\sitampan\models\PreskinAsnSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="preskin-asn-search">

    <?php $form = ActiveForm::begin([
        'action' => ['penerima-tpp'],
        'method' => 'get',
        'id' => 'cari-form', 
    ]); ?>

    <?= $form->field($model, 'nip') ?>

    <?= $form->field($model, 'nama') ?>

    <?= $form->field($model, 'tablok')->widget(Select2::classname(), [
        'data' => ArrayHelper::map($opd, "KOLOK", "UNOR"),
        'options' => ['placeholder' => 'Pilih ....'],
        'pluginOptions' => ['allowClear' => false],
    ])->label('UNOR');?>

    <?= '<label class="form-label">Periode</label>'; ?>
    <?= DatePicker::widget([
        'name' => 'periode',
        'value' => $model['bulan'].'-'.$model['tahun'],
        'removeButton' => false,
        'options' => [
            'placeholder' => 'Pilih ....', 'id' => 'jadwal', 'class' => 'form-control', 'readonly' => true,
        ],
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'mm-yyyy',
            'minViewMode' => 'months',
        ]
    ]);?>

    <div class="form-group mt-2">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary mr-1']) ?>
        <?= Html::a('Clear', ['penerima-tpp'], ['class' => 'btn btn-danger', 'title' => 'Clear']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
