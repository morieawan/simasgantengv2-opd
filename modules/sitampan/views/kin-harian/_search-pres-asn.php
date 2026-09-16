<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\modules\sitampan\models\PreskinAsnSearch */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Kinerja';

?>

<div class="preskin-asn-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'id' => 'cari-form', 
    ]); ?>

    <?= $form->field($model, 'nip')->textInput(['id' => 'formnip']) ?>

    <?= $form->field($model, 'nama')->textInput(['id' => 'formnama']) ?>

    <?= $form->field($model, 'opd')->widget(Select2::classname(), [
        'data' => ArrayHelper::map($opd, "KOLOK", "UNOR"),
        'options' => ['placeholder' => 'Pilih ....', 'id' => 'formopd'],
        'pluginOptions' => ['allowClear' => true],
    ])->label('UNOR <span style="color:red">*</span>');?>

    <?= '<label class="form-label">Periode</label>'; ?>
    <?= DatePicker::widget([
        'name' => 'periode',
        'value' => $bln.'-'.$thn,
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
        <?= Html::a('Clear', ['search'], ['class' => 'btn btn-danger', 'title' => 'Clear']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
// $script = <<<JS
// $('#cari-form').on('submit', function(e) {
//     let input = $('#formopd').val(); 
//     let nip = $('#formnip').val(); 
//     let nama = $('#formnama').val();

//     if (
//         (!input || input.trim() === '') &&
//         (!nip || nip.trim() === '') &&
//         (!nama || nama.trim() === '')
//     ) {
//         e.preventDefault();

//         Swal.fire({
//             icon: 'warning',
//             title: 'Oops...',
//             text: 'Unor tidak boleh kosong!',
//             confirmButtonText: 'OK'
//         });

//         return false;
//     }
// });
// JS;

// $this->registerJs($script);
?>