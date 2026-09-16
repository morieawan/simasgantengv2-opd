<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\widgets\ActiveForm;
use kartik\number\NumberControl;
use kartik\select2\Select2;
use kartik\datecontrol\DateControl;
use kartik\daterange\DateRangePicker;
use kartik\field\FieldRange;

/* @var $this yii\web\View */
/* @var $model app\models\kinerja\KinTahunan */
/* @var $form yii\widgets\ActiveForm */

$dispOptions = ['class' => 'form-control kv-monospace']; 
$saveOptions = [
    'type' => 'hidden',
    'readonly' => true, 
    'tabindex' => 1000
];
$saveCont = ['class' => 'kv-saved-cont'];
   
?>

<div class="kin-tahunan-form">

<?php $form = ActiveForm::begin([
        'id' => 'login-form', 
        'type' => ActiveForm::TYPE_VERTICAL
    ]); ?>
    
    <?= $form->field($model, 'tgl')->widget(DateControl::classname(), [
        'type'=>DateControl::FORMAT_DATE,
        'id' => 'tgls',
        'readonly' => true,
    ]); ?>
    
    <?= $form->field($model, 'uraian_keg_h')->textarea(['rows' => 1]) ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'target_kuan_h')->widget(NumberControl::classname(), [
                'options' => $saveOptions,
                'displayOptions' => $dispOptions,
                'saveInputContainer' => $saveCont,
                'maskedInputOptions' => [
                    'allowMinus' => false,
                    'rightAlign' => false
                ]
            ]);?>
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'target_output_h')->widget(Select2::classname(), [
                'data' => ArrayHelper::map($output, 'jenis_output', 'jenis_output'),
                'language' => 'id',
                'options' => [
                    'placeholder' => '- Pilih -',  
                    'autocomplete' => 'off',
                ],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])->label('Satuan Output');
            ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'target_waktu_h')->widget(NumberControl::classname(), [
                'options' => $saveOptions + ['id' => 'twaktu'],
                'displayOptions' => $dispOptions,
                'saveInputContainer' => $saveCont,
                'maskedInputOptions' => [
                    'allowMinus' => false,
                    'rightAlign' => false
                ]
            ]);?> 
        </div>

        <div class="col-md-6">
        <?= $form->field($model, 'target_waktu_h')->textInput(['value' => 'Menit', 'disabled' => true])->label('Satuan Waktu'); ?>
        </div>
    </div>

    <?= $form->field($model, 'tgl_target', ['showLabels' => false])->hiddenInput(['value' => date('Y-m-d H:i:s')]); ?>

    <div class="form-group">
        <?= Html::submitButton('<i class="fas fa-save"></i> Simpan', ['class' => 'btn btn-success']) ?>
        <?= Html::a('<i class="fas fa-minus-circle"></i> Batal',' ', ['class' => 'btn btn-danger', 'data-dismis' => 'modal']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
