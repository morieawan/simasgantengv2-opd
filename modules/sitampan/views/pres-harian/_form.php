<?php

use yii\helpers\Html;
use yii\helpers\Url;
//use yii\helpers\ArrayHelper;
use kartik\widgets\ActiveForm;
use kartik\number\NumberControl;
//use kartik\select2\Select2;
use kartik\datecontrol\DateControl;

/* @var $this yii\web\View */
/* @var $model app\modules\sitampan\models\PresHarian */
/* @var $form yii\widgets\ActiveForm */

$dispOptions = ['class' => 'form-control kv-monospace']; 
$saveOptions = [
    'type' => 'hidden', 
    'readonly' => true, 
    'tabindex' => 1000
];
 
$saveCont = ['class' => 'kv-saved-cont'];
?>

<div class="pres-harian-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tgl')->widget(DateControl::classname(), [
                'type'=>DateControl::FORMAT_DATE,
            ]) ?>

    <?= $form->field($model, 'id_pns')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nip')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tablok')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tablokb')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jd_masuk')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jd_pulang')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pr_masuk')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pr_pulang')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mnt_masuk')->widget(NumberControl::classname(), [
                'options' => $saveOptions,
                'displayOptions' => $dispOptions,
                'saveInputContainer' => $saveCont,
                'maskedInputOptions' => [
                    'allowMinus' => false,
                    'rightAlign' => false
                ]
            ]) ?>

    <?= $form->field($model, 'mnt_pulang')->widget(NumberControl::classname(), [
                'options' => $saveOptions,
                'displayOptions' => $dispOptions,
                'saveInputContainer' => $saveCont,
                'maskedInputOptions' => [
                    'allowMinus' => false,
                    'rightAlign' => false
                ]
            ]) ?>

    <?= $form->field($model, 'kd_pr_masuk')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kd_pr_pulang')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pot_masuk')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pot_pulang')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'flag')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'updated')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?=  Html::submitButton('<i class=\"fas fa-save\"></i> Simpan', ['class' => 'btn btn-success']) ?>
        <?=  Html::a('<i class=\"fas fa-minus-circle\"></i> Batal',' ', ['class' => 'btn btn-danger', 'data-dismis' => 'modal']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
