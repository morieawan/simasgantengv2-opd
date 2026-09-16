<?php

use yii\helpers\Html;
use yii\helpers\Url;
//use yii\helpers\ArrayHelper;
use kartik\widgets\ActiveForm;
use kartik\number\NumberControl;
//use kartik\select2\Select2;
use kartik\datecontrol\DateControl;

/* @var $this yii\web\View */
/* @var $model app\modules\gaji\models\SimasGajiMstpegawai */
/* @var $form yii\widgets\ActiveForm */

$dispOptions = ['class' => 'form-control kv-monospace']; 
$saveOptions = [
    'type' => 'hidden', 
    'readonly' => true, 
    'tabindex' => 1000
];
 
$saveCont = ['class' => 'kv-saved-cont'];
?>

<div class="simas-gaji-mstpegawai-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'NIP')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NAMA')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'GLRDEPAN')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'GLRBELAKANG')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'KDJENKEL')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TEMPATLHR')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TGLLHR')->widget(DateControl::classname(), [
                'type'=>DateControl::FORMAT_DATE,
            ]) ?>

    <?= $form->field($model, 'AGAMA')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'zakat_dg')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PENDIDIKAN')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TMTCAPEG')->widget(DateControl::classname(), [
                'type'=>DateControl::FORMAT_DATE,
            ]) ?>

    <?= $form->field($model, 'TMTSKMT')->widget(DateControl::classname(), [
                'type'=>DateControl::FORMAT_DATE,
            ]) ?>

    <?= $form->field($model, 'KDSTAWIN')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'JISTRI')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'JANAK')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'KDSTAPEG')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TMTSTOP')->widget(DateControl::classname(), [
                'type'=>DateControl::FORMAT_DATE,
            ]) ?>

    <?= $form->field($model, 'KDPANGKAT')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'MKGOLT')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BLGOLT')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'GAPOK')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'MASKER')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PRSNGAPOK')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TMTTABEL')->widget(DateControl::classname(), [
                'type'=>DateControl::FORMAT_DATE,
            ]) ?>

    <?= $form->field($model, 'TMTKGB')->widget(DateControl::classname(), [
                'type'=>DateControl::FORMAT_DATE,
            ]) ?>

    <?= $form->field($model, 'TMTKGBYAD')->widget(DateControl::classname(), [
                'type'=>DateControl::FORMAT_DATE,
            ]) ?>

    <?= $form->field($model, 'KDESELON')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TJESELON')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'KDFUNGSI1')->widget(NumberControl::classname(), [
                'options' => $saveOptions,
                'displayOptions' => $dispOptions,
                'saveInputContainer' => $saveCont,
                'maskedInputOptions' => [
                    'allowMinus' => false,
                    'rightAlign' => false
                ]
            ]) ?>

    <?= $form->field($model, 'KDFUNGSI')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TJFUNGSI')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BUP')->widget(NumberControl::classname(), [
                'options' => $saveOptions,
                'displayOptions' => $dispOptions,
                'saveInputContainer' => $saveCont,
                'maskedInputOptions' => [
                    'allowMinus' => false,
                    'rightAlign' => false
                ]
            ]) ?>

    <?= $form->field($model, 'KDSTRUK')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TJSTRUK')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'KDGURU')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TJGURU')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'KDBERAS')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'KDLANGKA')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TJLANGKA')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'KDTKD')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TJTKD')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'KDTERPENCIL')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TJTERPENCIL')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'KDTJKHUSUS')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TJKHUSUS')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'KDKORPRI')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PKORPRI')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'KDKOPERASI')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PKOPERASI')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'KDIRDHATA')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PIRDHATA')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TAPERUM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PSEWA')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NODOSIR')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'KDCABTASPEN')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'KDSSBP')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'KDSKPD')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'KDSATKER')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ALAMAT')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'KDDATI4')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'KDDATI3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'KDDATI2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'KDDATI1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NOTELP')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NOKTP')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NPWP')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NPWPZ')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NIPLAMA')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'KDHITUNG')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'KODEBYR')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'induk_bank')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NOREK')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TMTBERLAKU')->widget(DateControl::classname(), [
                'type'=>DateControl::FORMAT_DATE,
            ]) ?>

    <?= $form->field($model, 'CATATAN')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'KDJNSTRANS')->widget(NumberControl::classname(), [
                'options' => $saveOptions,
                'displayOptions' => $dispOptions,
                'saveInputContainer' => $saveCont,
                'maskedInputOptions' => [
                    'allowMinus' => false,
                    'rightAlign' => false
                ]
            ]) ?>

    <?= $form->field($model, 'UPDSTAMP')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'INPUTER')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kd_infaq')->widget(NumberControl::classname(), [
                'options' => $saveOptions,
                'displayOptions' => $dispOptions,
                'saveInputContainer' => $saveCont,
                'maskedInputOptions' => [
                    'allowMinus' => false,
                    'rightAlign' => false
                ]
            ]) ?>

    <?= $form->field($model, 'NOKARPEG')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jnsguru')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'EMAIL')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'KD_JNS_PEG')->widget(NumberControl::classname(), [
                'options' => $saveOptions,
                'displayOptions' => $dispOptions,
                'saveInputContainer' => $saveCont,
                'maskedInputOptions' => [
                    'allowMinus' => false,
                    'rightAlign' => false
                ]
            ]) ?>

    <?= $form->field($model, 'updated')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?=  Html::submitButton('<i class=\"fas fa-save\"></i> Simpan', ['class' => 'btn btn-success']) ?>
        <?=  Html::a('<i class=\"fas fa-minus-circle\"></i> Batal',' ', ['class' => 'btn btn-danger', 'data-dismis' => 'modal']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
