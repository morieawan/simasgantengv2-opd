<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\form\ActiveForm;
use kartik\widgets\TimePicker;
 
use wbraganca\dynamicform\DynamicFormWidget;

$artgl = [];
for($i=1; $i<=cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun); $i++) {
    $artgl[$i] = $i;
}

?>

<div class="tab-presensi-form">

    <center><h5><b>Jadwal Kerja <?= "$jk Bulan $bul $tahun"?></b></h5></center>

    <?php $form = ActiveForm::begin([
        'id' => 'dynamic-form',
        'type' => ActiveForm::TYPE_HORIZONTAL,
        'formConfig' => ['labelSpan' => 2, 'deviceSize' => ActiveForm::SIZE_SMALL]
    ]);?>

    <?= $form->field($model[0], 'nip')->textInput(['id' => 'nip', 'disabled' => true])->label('NIP') ?>

    <?= $form->field($model[0], 'nama')->textInput(['disabled' => true])->label('Nama') ?>  
    
    <div class="padding-v-md">
        <div class="line line-dashed"></div>
    </div>

    <?php DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper',
        'widgetBody' => '.container-items',
        'widgetItem' => '.house-item',
        'limit' => 10,
        'min' => 1,
        'insertButton' => '.add-house',
        'deleteButton' => '.remove-house',
        'model' => $model[0],
        'formId' => 'dynamic-form',
        'formFields' => [
            'description',
        ],

    ]); ?>

    <table class="table table-bordered table-hover">
        <thead>
            <tr sytle="background-color: #CCCCCC">
                <th style="width: 60%; text-align: center;background-color: #bbf3bb; font-size: 11pt">
                    Tanggal
                </th>
                <th class="text-center" style="background-color: #bbf3bb; font-size: 11pt">Waktu Kerja</th>
                <th class="text-center" style="width: 10%; background-color: #bbf3bb;">
                    <button type="button" class="add-house btn-xs btn-success">
                        <span class="fas fa-plus"></span>
                    </button>
                </th>
            </tr>
        </thead>

        <tbody class="container-items">
        <?php foreach ($model as $index => $models): ?>
            <tr class="house-item">
                <td>
                    <?php
                        // necessary for update action.
                        if (! $models->isNewRecord) {
                            echo Html::activeHiddenInput($models, "[{$index}]kode");
                        }
                    ?>
    
                    <?= $form->field($models, "[{$index}]tgl", ['showLabels' => false])
                        ->checkboxButtonGroup($artgl, ['class' => 'btn-group-sm btn-toolbar']);
                    ?>
                    
                    </div>
                </td>
                <td class="vcenter">
                    <?= $form->field($models, "[{$index}]jd_masuk", ['showLabels' => false])
                        ->widget(TimePicker::classname(), [
                        'options' => [
                            'readonly' => true,
                        ],
                        'pluginOptions' => [
                            'showMeridian' => false,
                            //'showSeconds' => true,
                            'minuteStep' => 5,
                            'secondStep' => 5,
                            'defaultTime' => '',
                        ],
                    ]);?>
                    <label style="font-size: 11pt">sampai dengan</label>
                    <?= $form->field($models, "[{$index}]jd_pulang", ['showLabels' => false])
                        ->widget(TimePicker::classname(), [
                        'options' => [
                            'readonly' => true,
                        ],
                        'pluginOptions' => [
                            'showMeridian' => false,
                            'minuteStep' => 5,
                            'secondStep' => 5,
                            'defaultTime' => '',
                        ],
                    ]);?>
                </td>
                
                <td class="text-center vcenter" style="width: 90px; verti">
                    <button type="button" class="remove-house btn-xs btn-danger">
                        <span class="fas fa-minus"></span>
                    </button>
                </td>
            </tr>
         <?php endforeach; ?>
        </tbody>
    </table>
    <?php DynamicFormWidget::end(); ?>
    
    <div class="form-group">
        <?=  Html::submitButton('<i class=\"fas fa-save\"></i> Simpan', [
            'class' => 'btn btn-success',
            'id' => 'create',
            'data-method' => 'post',
        ]) ?>

        <?=  Html::a('<i class=\"fas fa-minus-circle\"></i> Batal',' ', ['class' => 'btn btn-danger', 'data-dismis' => 'modal']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
