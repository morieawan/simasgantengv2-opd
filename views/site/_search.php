<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\widgets\ActiveForm;

?>

<div class="tb-daftarfinger-form">
    <?php $form = ActiveForm::begin([
        'action' => ['pegawai'],
        'method' => 'get',
        'type' => ActiveForm::TYPE_INLINE,
        'fieldConfig' => ['options' => ['class' => 'form-group mr-2 me-0']],
        'options' => ['style' => 'align-items: flex-start'] 
    ]); ?>

    <?= $form->field($model, 'B_02', ['showLabels' => true])->textInput(['placeholder' => 'NIP']) ?>
    <?= $form->field($model, 'B_03', ['showLabels' => true])->textInput(['placeholder' => 'NAMA']) ?>

    <div class="form-group">
        <?=  Html::submitButton('<i class="fas fa-search"></i> Cari Data', ['class' => 'btn btn-primary mr-1']) ?>
        <?=  Html::a('<i class="fas fa-times"></i> Clear', ['reset'], ['class' => 'btn btn-danger mr-1']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
