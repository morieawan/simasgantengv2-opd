<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\form\ActiveForm;
use kartik\select2\Select2;


$this->title = 'Form Cetak TPP';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="tpp-hitung-form">

    <?php $form = ActiveForm::begin([
        'id' => 'cetak-form-horizontal', 
        'action' => ['cetak'],
        'method' => 'post',
        'options' => ['target'=>'_blank'],
        //'type' => ActiveForm::TYPE_HORIZONTAL,
        //'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL]
    ]); ?>


<div class="row">
    <div class="col-sm-6">

    <label class="control-label">Tahun</label>
    <?= Select2::widget([
            'name' => 'tahun',
            'data' => $arta,
            'value' => date('Y'),
            'options' => [
                'id' => 'tahun',
                'placeholder' => '- Pilih -',  
                'autocomplete' => 'off',
            ],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);   
    ?>  
    <br>    

    <label class="control-label">Bulan</label>
    <?= Select2::widget([
            'name' => 'bulan',
            'data' => $arbul,
            'value' => [date('m')-1],
            'options' => [
                'id' => 'bulan',
                'placeholder' => '- Pilih -',  
                'autocomplete' => 'off',
            ],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);   
    ?>  
    <br>

    <label class="control-label">OPD</label>
    <?= Select2::widget([
            'name' => 'opd',
            'data' => ArrayHelper::map($opdlist, 'cetak_group', 'nama_opd'),
            'options' => [
                'id' => 'opd',
                'placeholder' => '- Pilih -',  
                'autocomplete' => 'off',
            ],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);   
    ?> 
    </div>
    </div> 
    &nbsp;
    <div class="form-group row">
        <?=  Html::submitButton('<i class=\"fas fa-save\"></i> Cetak', ['class' => 'btn btn-success']) ?>
        &nbsp;
    </div>

    <?php ActiveForm::end(); ?>

</div>
