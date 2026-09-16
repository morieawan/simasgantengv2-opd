<?php

use yii\helpers\Html;
use yii\helpers\Url;
//use yii\helpers\ArrayHelper;
use kartik\widgets\ActiveForm;
use kartik\number\NumberControl;
//use kartik\select2\Select2;
use kartik\datecontrol\DateControl;

/* @var $this yii\web\View */
/* @var $model app\modules\simpeg\models\EpsMastfip */
/* @var $form yii\widgets\ActiveForm */

$dispOptions = ['class' => 'form-control kv-monospace']; 
$saveOptions = [
    'type' => 'hidden', 
    'readonly' => true, 
    'tabindex' => 1000
];
 
$saveCont = ['class' => 'kv-saved-cont'];
?>

<div class="eps-mastfip-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'A_00')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'A_01')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'A_02')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'A_03')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'A_04')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'B_01')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'B_02')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'B_03A')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'B_03')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'B_03B')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'B_04')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'B_05')->widget(DateControl::classname(), [
                'type'=>DateControl::FORMAT_DATE,
            ]) ?>

    <?= $form->field($model, 'B_06')->widget(NumberControl::classname(), [
                'options' => $saveOptions,
                'displayOptions' => $dispOptions,
                'saveInputContainer' => $saveCont,
                'maskedInputOptions' => [
                    'allowMinus' => false,
                    'rightAlign' => false
                ]
            ]) ?>

    <?= $form->field($model, 'B_07')->widget(NumberControl::classname(), [
                'options' => $saveOptions,
                'displayOptions' => $dispOptions,
                'saveInputContainer' => $saveCont,
                'maskedInputOptions' => [
                    'allowMinus' => false,
                    'rightAlign' => false
                ]
            ]) ?>

    <?= $form->field($model, 'B_08')->widget(NumberControl::classname(), [
                'options' => $saveOptions,
                'displayOptions' => $dispOptions,
                'saveInputContainer' => $saveCont,
                'maskedInputOptions' => [
                    'allowMinus' => false,
                    'rightAlign' => false
                ]
            ]) ?>

    <?= $form->field($model, 'B_09')->widget(NumberControl::classname(), [
                'options' => $saveOptions,
                'displayOptions' => $dispOptions,
                'saveInputContainer' => $saveCont,
                'maskedInputOptions' => [
                    'allowMinus' => false,
                    'rightAlign' => false
                ]
            ]) ?>

    <?= $form->field($model, 'B_10')->widget(NumberControl::classname(), [
                'options' => $saveOptions,
                'displayOptions' => $dispOptions,
                'saveInputContainer' => $saveCont,
                'maskedInputOptions' => [
                    'allowMinus' => false,
                    'rightAlign' => false
                ]
            ]) ?>

    <?= $form->field($model, 'B_11')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'B_12')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'B_13')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'B_14')->widget(NumberControl::classname(), [
                'options' => $saveOptions,
                'displayOptions' => $dispOptions,
                'saveInputContainer' => $saveCont,
                'maskedInputOptions' => [
                    'allowMinus' => false,
                    'rightAlign' => false
                ]
            ]) ?>

    <?= $form->field($model, 'B_15')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'B_16')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'B_17')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'C_00')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'C_01')->widget(DateControl::classname(), [
                'type'=>DateControl::FORMAT_DATE,
            ]) ?>

    <?= $form->field($model, 'C_02')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'C_03')->widget(DateControl::classname(), [
                'type'=>DateControl::FORMAT_DATE,
            ]) ?>

    <?= $form->field($model, 'C_04')->widget(NumberControl::classname(), [
                'options' => $saveOptions,
                'displayOptions' => $dispOptions,
                'saveInputContainer' => $saveCont,
                'maskedInputOptions' => [
                    'allowMinus' => false,
                    'rightAlign' => false
                ]
            ]) ?>

    <?= $form->field($model, 'D_00')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'D_01')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'D_02')->widget(DateControl::classname(), [
                'type'=>DateControl::FORMAT_DATE,
            ]) ?>

    <?= $form->field($model, 'D_03')->widget(NumberControl::classname(), [
                'options' => $saveOptions,
                'displayOptions' => $dispOptions,
                'saveInputContainer' => $saveCont,
                'maskedInputOptions' => [
                    'allowMinus' => false,
                    'rightAlign' => false
                ]
            ]) ?>

    <?= $form->field($model, 'D_04')->widget(DateControl::classname(), [
                'type'=>DateControl::FORMAT_DATE,
            ]) ?>

    <?= $form->field($model, 'D_05')->widget(NumberControl::classname(), [
                'options' => $saveOptions,
                'displayOptions' => $dispOptions,
                'saveInputContainer' => $saveCont,
                'maskedInputOptions' => [
                    'allowMinus' => false,
                    'rightAlign' => false
                ]
            ]) ?>

    <?= $form->field($model, 'E_01')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'E_02')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'E_03')->widget(DateControl::classname(), [
                'type'=>DateControl::FORMAT_DATE,
            ]) ?>

    <?= $form->field($model, 'E_04')->widget(NumberControl::classname(), [
                'options' => $saveOptions,
                'displayOptions' => $dispOptions,
                'saveInputContainer' => $saveCont,
                'maskedInputOptions' => [
                    'allowMinus' => false,
                    'rightAlign' => false
                ]
            ]) ?>

    <?= $form->field($model, 'E_05')->widget(DateControl::classname(), [
                'type'=>DateControl::FORMAT_DATE,
            ]) ?>

    <?= $form->field($model, 'E_06')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'E_07')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'F_01')->widget(DateControl::classname(), [
                'type'=>DateControl::FORMAT_DATE,
            ]) ?>

    <?= $form->field($model, 'F_02')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'F_02A')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'F_03')->widget(NumberControl::classname(), [
                'options' => $saveOptions,
                'displayOptions' => $dispOptions,
                'saveInputContainer' => $saveCont,
                'maskedInputOptions' => [
                    'allowMinus' => false,
                    'rightAlign' => false
                ]
            ]) ?>

    <?= $form->field($model, 'F_04')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'F_05')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'F_06')->widget(DateControl::classname(), [
                'type'=>DateControl::FORMAT_DATE,
            ]) ?>

    <?= $form->field($model, 'F_07')->widget(NumberControl::classname(), [
                'options' => $saveOptions,
                'displayOptions' => $dispOptions,
                'saveInputContainer' => $saveCont,
                'maskedInputOptions' => [
                    'allowMinus' => false,
                    'rightAlign' => false
                ]
            ]) ?>

    <?= $form->field($model, 'G_01')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'G_02')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'G_03')->widget(DateControl::classname(), [
                'type'=>DateControl::FORMAT_DATE,
            ]) ?>

    <?= $form->field($model, 'G_04')->widget(DateControl::classname(), [
                'type'=>DateControl::FORMAT_DATE,
            ]) ?>

    <?= $form->field($model, 'G_05')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'G_05A')->widget(NumberControl::classname(), [
                'options' => $saveOptions,
                'displayOptions' => $dispOptions,
                'saveInputContainer' => $saveCont,
                'maskedInputOptions' => [
                    'allowMinus' => false,
                    'rightAlign' => false
                ]
            ]) ?>

    <?= $form->field($model, 'G_05B')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'G_06')->widget(NumberControl::classname(), [
                'options' => $saveOptions,
                'displayOptions' => $dispOptions,
                'saveInputContainer' => $saveCont,
                'maskedInputOptions' => [
                    'allowMinus' => false,
                    'rightAlign' => false
                ]
            ]) ?>

    <?= $form->field($model, 'G_07')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'G_08')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'G_09')->widget(DateControl::classname(), [
                'type'=>DateControl::FORMAT_DATE,
            ]) ?>

    <?= $form->field($model, 'G_10')->widget(DateControl::classname(), [
                'type'=>DateControl::FORMAT_DATE,
            ]) ?>

    <?= $form->field($model, 'G_11')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'G_11A')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'H_01')->widget(NumberControl::classname(), [
                'options' => $saveOptions,
                'displayOptions' => $dispOptions,
                'saveInputContainer' => $saveCont,
                'maskedInputOptions' => [
                    'allowMinus' => false,
                    'rightAlign' => false
                ]
            ]) ?>

    <?= $form->field($model, 'H_02')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'H_03')->widget(NumberControl::classname(), [
                'options' => $saveOptions,
                'displayOptions' => $dispOptions,
                'saveInputContainer' => $saveCont,
                'maskedInputOptions' => [
                    'allowMinus' => false,
                    'rightAlign' => false
                ]
            ]) ?>

    <?= $form->field($model, 'I_01')->widget(NumberControl::classname(), [
                'options' => $saveOptions,
                'displayOptions' => $dispOptions,
                'saveInputContainer' => $saveCont,
                'maskedInputOptions' => [
                    'allowMinus' => false,
                    'rightAlign' => false
                ]
            ]) ?>

    <?= $form->field($model, 'I_02')->widget(DateControl::classname(), [
                'type'=>DateControl::FORMAT_DATE,
            ]) ?>

    <?= $form->field($model, 'I_03')->widget(NumberControl::classname(), [
                'options' => $saveOptions,
                'displayOptions' => $dispOptions,
                'saveInputContainer' => $saveCont,
                'maskedInputOptions' => [
                    'allowMinus' => false,
                    'rightAlign' => false
                ]
            ]) ?>

    <?= $form->field($model, 'J_01')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'J_02')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'J_03')->widget(DateControl::classname(), [
                'type'=>DateControl::FORMAT_DATE,
            ]) ?>

    <?= $form->field($model, 'J_04')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'J_05')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'J_06')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'J_07')->widget(DateControl::classname(), [
                'type'=>DateControl::FORMAT_DATE,
            ]) ?>

    <?= $form->field($model, 'J_08')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'K_01')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'K_02')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'K_03')->widget(DateControl::classname(), [
                'type'=>DateControl::FORMAT_DATE,
            ]) ?>

    <?= $form->field($model, 'K_04')->widget(DateControl::classname(), [
                'type'=>DateControl::FORMAT_DATE,
            ]) ?>

    <?= $form->field($model, 'K_05')->widget(NumberControl::classname(), [
                'options' => $saveOptions,
                'displayOptions' => $dispOptions,
                'saveInputContainer' => $saveCont,
                'maskedInputOptions' => [
                    'allowMinus' => false,
                    'rightAlign' => false
                ]
            ]) ?>

    <?= $form->field($model, 'K_06')->widget(NumberControl::classname(), [
                'options' => $saveOptions,
                'displayOptions' => $dispOptions,
                'saveInputContainer' => $saveCont,
                'maskedInputOptions' => [
                    'allowMinus' => false,
                    'rightAlign' => false
                ]
            ]) ?>

    <?= $form->field($model, 'K_07')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'L_01')->widget(NumberControl::classname(), [
                'options' => $saveOptions,
                'displayOptions' => $dispOptions,
                'saveInputContainer' => $saveCont,
                'maskedInputOptions' => [
                    'allowMinus' => false,
                    'rightAlign' => false
                ]
            ]) ?>

    <?= $form->field($model, 'L_02')->widget(NumberControl::classname(), [
                'options' => $saveOptions,
                'displayOptions' => $dispOptions,
                'saveInputContainer' => $saveCont,
                'maskedInputOptions' => [
                    'allowMinus' => false,
                    'rightAlign' => false
                ]
            ]) ?>

    <?= $form->field($model, 'M_01')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'M_02')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'M_03')->widget(DateControl::classname(), [
                'type'=>DateControl::FORMAT_DATE,
            ]) ?>

    <?= $form->field($model, 'M_04')->widget(NumberControl::classname(), [
                'options' => $saveOptions,
                'displayOptions' => $dispOptions,
                'saveInputContainer' => $saveCont,
                'maskedInputOptions' => [
                    'allowMinus' => false,
                    'rightAlign' => false
                ]
            ]) ?>

    <?= $form->field($model, 'M_05')->widget(DateControl::classname(), [
                'type'=>DateControl::FORMAT_DATE,
            ]) ?>

    <?= $form->field($model, 'M_06')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'M_07')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Z_99')->widget(NumberControl::classname(), [
                'options' => $saveOptions,
                'displayOptions' => $dispOptions,
                'saveInputContainer' => $saveCont,
                'maskedInputOptions' => [
                    'allowMinus' => false,
                    'rightAlign' => false
                ]
            ]) ?>

    <?= $form->field($model, 'no_telp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'foto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nik')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'updated')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email_gov')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kartu_asn')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?=  Html::submitButton('<i class=\"fas fa-save\"></i> Simpan', ['class' => 'btn btn-success']) ?>
        <?=  Html::a('<i class=\"fas fa-minus-circle\"></i> Batal',' ', ['class' => 'btn btn-danger', 'data-dismis' => 'modal']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
