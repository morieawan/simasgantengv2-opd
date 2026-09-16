<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\integrasi\models\TblDataUpdateSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-data-update-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'id' => 'cari-form', 
        'type' => ActiveForm::TYPE_INLINE,
        'fieldConfig' => ['options' => ['class' => 'form-group mr-2 mb-3']], 
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nipBaru') ?>

    <?= $form->field($model, 'dataUtama') ?>

    <?= $form->field($model, 'rwJabatan') ?>

    <?= $form->field($model, 'rwGol') ?>

    <?php // echo $form->field($model, 'rwDiklat') ?>

    <?php // echo $form->field($model, 'rwPendidikan') ?>

    <?php // echo $form->field($model, 'rwSkp') ?>

    <?php // echo $form->field($model, 'rwAngkakredit') ?>

    <?php // echo $form->field($model, 'rwPwk') ?>

    <?php // echo $form->field($model, 'rwPnsunor') ?>

    <?php // echo $form->field($model, 'rwKursus') ?>

    <?php // echo $form->field($model, 'rwPemberhentian') ?>

    <?php // echo $form->field($model, 'rwPenghargaan') ?>

    <?php // echo $form->field($model, 'rwMasakerja') ?>

    <?php // echo $form->field($model, 'rwHukdis') ?>

    <?php // echo $form->field($model, 'rwDp3') ?>

    <?php // echo $form->field($model, 'rwCltn') ?>

    <?php // echo $form->field($model, 'rwPindahinstansi') ?>

    <?php // echo $form->field($model, 'rwskp22') ?>

    <?php // echo $form->field($model, 'flag') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
