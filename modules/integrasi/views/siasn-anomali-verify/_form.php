<?php

use yii\helpers\Html;
use yii\helpers\Url;
//use yii\helpers\ArrayHelper;
use kartik\widgets\ActiveForm;
use kartik\number\NumberControl;
//use kartik\select2\Select2;
use kartik\datecontrol\DateControl;

/* @var $this yii\web\View */
/* @var $model app\modules\integrasi\models\SiasnAnomali */
/* @var $form yii\widgets\ActiveForm */

$dispOptions = ['class' => 'form-control kv-monospace']; 
$saveOptions = [
    'type' => 'hidden', 
    'readonly' => true, 
    'tabindex' => 1000
];
 
$saveCont = ['class' => 'kv-saved-cont'];
?>

<div class="siasn-anomali-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nipBaru')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idPns')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jenisJabatanId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jenisJabatan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jabatanId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jabatanNama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'unorId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'unorIndukNama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'unorNama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kedudukanPnsId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kedudukanPnsNama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'simpeg')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'skJabatan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'skKP')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'updated')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'updateBy')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'verified')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'verifiedBy')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'flag')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?=  Html::submitButton('<i class=\"fas fa-save\"></i> Simpan', ['class' => 'btn btn-success']) ?>
        <?=  Html::a('<i class=\"fas fa-minus-circle\"></i> Batal',' ', ['class' => 'btn btn-danger', 'data-dismis' => 'modal']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
