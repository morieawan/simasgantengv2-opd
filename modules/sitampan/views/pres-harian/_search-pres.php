<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\modules\sitampan\models\PreskinAsnSearch */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Cari Data Presensi ASN';

?>

<div class="preskin-asn-search">

    <?php $form = ActiveForm::begin([
        'action' => ['pres-opd'],
        'method' => 'get',
        'id' => 'cari-form', 
        //'type' => ActiveForm::TYPE_HORIZONTAL,
        //'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL]
    ]); ?>

    <?= $form->field($model, 'nip')->textInput(['id' => 'nip']) ?>

    <?= $form->field($model, 'nama')->textInput(['id' => 'nama']) ?>

    <?= $form->field($model, 'opd')->widget(Select2::classname(), [
        'data' => ArrayHelper::map($opd, "KOLOK", "UNOR"),
        'options' => [
            'placeholder' => 'Pilih ....',
        ],
        'pluginOptions' => [
            'allowClear' => true,
        ]
        
    ])->label('Unit Kerja');?>

    <?= '<label class="form-label">Periode</label>'; ?>
    <?= DatePicker::widget([
        'name' => 'periode',
        'value' => date('m-Y'),
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
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary mr-1', 'id' => 'search']) ?>
        <?= Html::a('Clear', ['jadwal-opd'], ['class' => 'btn btn-danger', 'title' => 'Clear']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php 
$script = <<< JS

$('#search').click(function(){
    if($('#nip').val() == '' && $('#nama').val() == ''){    
        Swal.fire({
            icon: 'error',
            title: 'Gagal !!!',
            text: "NIP atau Nama harus diisi",
            showConfirmButton: false,
            timer: 2000
        });
        return false;
        //$('#nama_atasan').attr('value','');
    }else{
        return true;
    }
});


JS;
$this->registerJs($script);
?>
