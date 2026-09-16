<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use kartik\datecontrol\DateControl;

/** @var yii\web\View $this */
/** @var app\modules\sitampan\models\PreskinWfh $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="preskin-wfh-form">

    <?php $form = ActiveForm::begin(['id' => 'form1']); ?>

    <?= $form->field($model, 'tgl')->widget(DateControl::classname(), [
        'type'=>DateControl::FORMAT_DATE,
    ]) ?>

    <?= $form->field($model, 'nip')->widget(Select2::classname(), [
            'data' => ArrayHelper::map($asn,'B_02','nipnama'),
            'options' => [
                'placeholder' => 'Pilih ASN . . . .', 
                'autocomplete' => 'off', 
                'multiple' => true,
            ],
            //'size' => Select2::MEDIUM,
            'theme' => Select2::THEME_BOOTSTRAP,
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ])->label('Pegawai') ?>


    <div class="form-group">
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
