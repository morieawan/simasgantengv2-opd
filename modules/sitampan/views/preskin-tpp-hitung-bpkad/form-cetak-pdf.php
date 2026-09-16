<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\form\ActiveForm;
use kartik\select2\Select2;


$this->title = 'CEK TPP FINAL';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="tpp-hitung-form">

    <?php $form = ActiveForm::begin([
        'id' => 'cetak-form-horizontal', 
        'action' => ['cetak-tpp'],
        'method' => 'post',
        'options' => ['target'=>'_blank'],
    ]); ?>


<div class="row">
    <div class="col-md-6">

    <table border="0" width="100%" cellpadding="4">
        <tr>
            <td width="10%"> <label class="control-label">Tahun</label></td>
            <td width="90%">
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
                ]);?>  
            </td>
        </tr>
        <tr>
            <td><label class="control-label">Bulan</label></td>
            <td>
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
                ]);?>  
            </td>
        </tr>
        <tr>
            <td><label class="control-label">OPD</label></td>
            <td>
            <?= Select2::widget([
                'name' => 'opd',
                'data' => ArrayHelper::map($opdlist, 'KOLOK', 'UNOR'),
                'options' => [
                    'id' => 'opd',
                    //'placeholder' => '- Pilih -',  
                    'autocomplete' => 'off',
                ],
                'pluginOptions' => [
                    'allowClear' => false
                ],
            ]); ?>
            </td>
        </tr>
        <tr>
            <td> <label class="control-label">Jenis</label></td>
            <td>
            <?= Select2::widget([
                'name' => 'jenis',
                'data' => [1 => 'PNS', 2 => 'PPPK', 4 => 'PJ/ PLT/ PLH'],
                'options' => [
                    'id' => 'jenis',
                    'autocomplete' => 'off',
                ],
                'pluginOptions' => [
                    'allowClear' => false
                ],
            ]);?> 
            </td>
        </tr>
        
        <tr>
            <td>&nbsp;</td>
            <td>
            <div class="form-group row">
                <?=  Html::submitButton('<i class=\"fas fa-save\"></i> Cetak', ['class' => 'btn btn-success', 'id' => 'submit']) ?>
                &nbsp;
            </div>
            </td>
        </tr>
    </table>    

    <?php ActiveForm::end(); ?>

    </div>
</div>


<?php
// $script = <<< JS

// $("#jenis").change(function(e) {
//     var jenis = $("#jenis").val();
//     if(jenis != 1){
//         Swal.fire({
//             title: 'Maintenance',
//             text: 'Modul masih dalam pengembangan...',
//             icon: 'warning',
//             customClass: 'swal-wide',
//             showConfirmButton: false,
//             timer: 1000
//         });
//         $("#submit").hide();
//     }else{
//         $("#submit").show();
//     }
// });

// JS;
// $this->registerJs($script);
?>
