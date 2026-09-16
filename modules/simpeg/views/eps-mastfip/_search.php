<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\simpeg\models\EpsMastfipSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="eps-mastfip-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'id' => 'cari-form', 
        'type' => ActiveForm::TYPE_INLINE,
        'fieldConfig' => ['options' => ['class' => 'form-group mr-2 mb-3']], 
    ]); ?>

    <?= $form->field($model, 'A_00') ?>

    <?= $form->field($model, 'A_01') ?>

    <?= $form->field($model, 'A_02') ?>

    <?= $form->field($model, 'A_03') ?>

    <?= $form->field($model, 'A_04') ?>

    <?php // echo $form->field($model, 'B_01') ?>

    <?php // echo $form->field($model, 'B_02') ?>

    <?php // echo $form->field($model, 'B_03A') ?>

    <?php // echo $form->field($model, 'B_03') ?>

    <?php // echo $form->field($model, 'B_03B') ?>

    <?php // echo $form->field($model, 'B_04') ?>

    <?php // echo $form->field($model, 'B_05') ?>

    <?php // echo $form->field($model, 'B_06') ?>

    <?php // echo $form->field($model, 'B_07') ?>

    <?php // echo $form->field($model, 'B_08') ?>

    <?php // echo $form->field($model, 'B_09') ?>

    <?php // echo $form->field($model, 'B_10') ?>

    <?php // echo $form->field($model, 'B_11') ?>

    <?php // echo $form->field($model, 'B_12') ?>

    <?php // echo $form->field($model, 'B_13') ?>

    <?php // echo $form->field($model, 'B_14') ?>

    <?php // echo $form->field($model, 'B_15') ?>

    <?php // echo $form->field($model, 'B_16') ?>

    <?php // echo $form->field($model, 'B_17') ?>

    <?php // echo $form->field($model, 'C_00') ?>

    <?php // echo $form->field($model, 'C_01') ?>

    <?php // echo $form->field($model, 'C_02') ?>

    <?php // echo $form->field($model, 'C_03') ?>

    <?php // echo $form->field($model, 'C_04') ?>

    <?php // echo $form->field($model, 'D_00') ?>

    <?php // echo $form->field($model, 'D_01') ?>

    <?php // echo $form->field($model, 'D_02') ?>

    <?php // echo $form->field($model, 'D_03') ?>

    <?php // echo $form->field($model, 'D_04') ?>

    <?php // echo $form->field($model, 'D_05') ?>

    <?php // echo $form->field($model, 'E_01') ?>

    <?php // echo $form->field($model, 'E_02') ?>

    <?php // echo $form->field($model, 'E_03') ?>

    <?php // echo $form->field($model, 'E_04') ?>

    <?php // echo $form->field($model, 'E_05') ?>

    <?php // echo $form->field($model, 'E_06') ?>

    <?php // echo $form->field($model, 'E_07') ?>

    <?php // echo $form->field($model, 'F_01') ?>

    <?php // echo $form->field($model, 'F_02') ?>

    <?php // echo $form->field($model, 'F_02A') ?>

    <?php // echo $form->field($model, 'F_03') ?>

    <?php // echo $form->field($model, 'F_04') ?>

    <?php // echo $form->field($model, 'F_05') ?>

    <?php // echo $form->field($model, 'F_06') ?>

    <?php // echo $form->field($model, 'F_07') ?>

    <?php // echo $form->field($model, 'G_01') ?>

    <?php // echo $form->field($model, 'G_02') ?>

    <?php // echo $form->field($model, 'G_03') ?>

    <?php // echo $form->field($model, 'G_04') ?>

    <?php // echo $form->field($model, 'G_05') ?>

    <?php // echo $form->field($model, 'G_05A') ?>

    <?php // echo $form->field($model, 'G_05B') ?>

    <?php // echo $form->field($model, 'G_06') ?>

    <?php // echo $form->field($model, 'G_07') ?>

    <?php // echo $form->field($model, 'G_08') ?>

    <?php // echo $form->field($model, 'G_09') ?>

    <?php // echo $form->field($model, 'G_10') ?>

    <?php // echo $form->field($model, 'G_11') ?>

    <?php // echo $form->field($model, 'G_11A') ?>

    <?php // echo $form->field($model, 'H_01') ?>

    <?php // echo $form->field($model, 'H_02') ?>

    <?php // echo $form->field($model, 'H_03') ?>

    <?php // echo $form->field($model, 'I_01') ?>

    <?php // echo $form->field($model, 'I_02') ?>

    <?php // echo $form->field($model, 'I_03') ?>

    <?php // echo $form->field($model, 'J_01') ?>

    <?php // echo $form->field($model, 'J_02') ?>

    <?php // echo $form->field($model, 'J_03') ?>

    <?php // echo $form->field($model, 'J_04') ?>

    <?php // echo $form->field($model, 'J_05') ?>

    <?php // echo $form->field($model, 'J_06') ?>

    <?php // echo $form->field($model, 'J_07') ?>

    <?php // echo $form->field($model, 'J_08') ?>

    <?php // echo $form->field($model, 'K_01') ?>

    <?php // echo $form->field($model, 'K_02') ?>

    <?php // echo $form->field($model, 'K_03') ?>

    <?php // echo $form->field($model, 'K_04') ?>

    <?php // echo $form->field($model, 'K_05') ?>

    <?php // echo $form->field($model, 'K_06') ?>

    <?php // echo $form->field($model, 'K_07') ?>

    <?php // echo $form->field($model, 'L_01') ?>

    <?php // echo $form->field($model, 'L_02') ?>

    <?php // echo $form->field($model, 'M_01') ?>

    <?php // echo $form->field($model, 'M_02') ?>

    <?php // echo $form->field($model, 'M_03') ?>

    <?php // echo $form->field($model, 'M_04') ?>

    <?php // echo $form->field($model, 'M_05') ?>

    <?php // echo $form->field($model, 'M_06') ?>

    <?php // echo $form->field($model, 'M_07') ?>

    <?php // echo $form->field($model, 'Z_99') ?>

    <?php // echo $form->field($model, 'no_telp') ?>

    <?php // echo $form->field($model, 'foto') ?>

    <?php // echo $form->field($model, 'nik') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'updated') ?>

    <?php // echo $form->field($model, 'email_gov') ?>

    <?php // echo $form->field($model, 'kartu_asn') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
