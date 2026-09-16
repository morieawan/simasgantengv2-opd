<?php

use yii\helpers\Html;
use yii\helpers\Url;
//use yii\helpers\ArrayHelper;
use kartik\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\integrasi\models\SiasnAnomali */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="siasn-anomali-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nipBaru')->textInput(['maxlength' => true, 'readonly' => true]) ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true, 'readonly' => true]) ?>

    <?= $form->field($model, 'updateBy')->textInput(['maxlength' => true, 'readonly' => true]) ?>

    <?= $form->field($model, 'verifiedBy')->textInput(['maxlength' => true, 'readonly' => true]) ?>

    <?= $form->field($model, 'flag')->dropDownList(['0' => 'Usul', '1' => 'Final']) ?>

    <div class="form-group">
        <?=  Html::submitButton('<i class=\"fas fa-save\"></i> Simpan', ['class' => 'btn btn-success']) ?>
        <?=  Html::a('<i class=\"fas fa-minus-circle\"></i> Batal',' ', ['class' => 'btn btn-danger', 'data-dismis' => 'modal']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
