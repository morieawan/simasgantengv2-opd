<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use kartik\datecontrol\DateControl;   

// if (empty($model->provinsi)) $model->provinsi = '33';
// if (empty($model->kabupaten)) $model->kabupaten = '33.29';

?>

<div class="tambah-peserta-form">

<?php $form = ActiveForm::begin([
    'id' => 'form-tambah-peserta', 
    'type' => ActiveForm::TYPE_VERTICAL
]); ?>
    
    <div class="row">
        <div class="col-md-8">
            <?= $form->field($model, 'nama_peserta')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'nik')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">            
            <?= $form->field($model, 'hubkel')->widget(Select2::classname(), [
                'data' => $hubkel,
                'language' => 'id',
                'options' => [
                    'placeholder' => '- Pilih -',  
                    'autocomplete' => 'off',
                ],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 form-group">
            <?= $form->field($model, 'tgl_lahir')->widget(DateControl::classname(),['type'=>DateControl::FORMAT_DATE]); ?>
        </div>
        <div class="col-md-4 form-group">
            <?= $form->field($model, 'jk')->textInput(['maxlength' => true])->dropDownList([1=>'Pria', 2=>'Wanita'])->label('Jenis Kelamin') ?>
        </div>
        <div class="col-md-4 form-group">
            <?= $form->field($model, 'aktif')->textInput(['maxlength' => true])->dropDownList([1=>'Aktif', 2=>'Non Aktif'])->label('Status Aktif') ?>
        </div>
    </div>

    <!-- Input Text Alamat -->
    <div class="form-group">
        <?= $form->field($model, 'alamat')->textInput(['maxlength' => true, 'placeholder' => "Jalan Anggrek No. 12 RT 01 RW 02"])->label('Alamat Jalan / RT / RW') ?>
    </div>

   
        <!-- Dependent Dropdown Wilayah (HTML Dropdown Biasa) -->
<div class="row">
    <div class="col-md-3 form-group">
        <?= $form->field($model, 'provinsi')->widget(Select2::class, [
            'data' => ArrayHelper::map($prov, 'id', 'name'),
            'options' => [
                'placeholder' => 'Pilih Provinsi...',
                'id' => 'id_prov',
            ],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ]) ?>
    </div>

    <div class="col-md-3 form-group">
        <?= $form->field($model, 'kabupaten')->widget(DepDrop::classname(), [
                'options'=>['id'=>'id_kab'],
                'type' => DepDrop::TYPE_SELECT2,
                'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                'pluginOptions'=>[
                    'depends'=>['id_prov'],
                    'placeholder' => 'Pilih Kabupaten...',
                    'url' => Url::to(['/bpjs/peserta/get-wilayah']),
                    'loadingText' => 'Memuat Kabupaten...',
                ]
            ])->label('Kabupaten/ Kota'); 
        ?>
        
    </div>

    <div class="col-md-3 form-group">
        <?= $form->field($model, 'kecamatan')->widget(DepDrop::class, [
            'options' => ['id' => 'id_kec'],
            'type' => DepDrop::TYPE_SELECT2,
            'select2Options' => ['pluginOptions' => ['allowClear' => true]],
            'pluginOptions' => [
                'depends' => ['id_kab'], 
                'placeholder' => 'Pilih Kecamatan...',
                'url' => Url::to(['/bpjs/peserta/get-wilayah']),
                'loadingText' => 'Memuat Kecamatan...',
            ],
        ]) ?>
    </div>

    <div class="col-md-3 form-group">
        <?= $form->field($model, 'kelurahan')->widget(DepDrop::class, [
            'options' => ['id' => 'id_desa'],
            'type' => DepDrop::TYPE_SELECT2,
            'select2Options' => ['pluginOptions' => ['allowClear' => true]],
            'pluginOptions' => [
                'depends' => ['id_kec'], 
                'placeholder' => 'Pilih Kel/ Desa...',
                'url' => Url::to(['/bpjs/peserta/get-wilayah']),
                'loadingText' => 'Memuat Kel/ Desa...',
            ],
        ])->label('Kel/ Desa') ?>
    </div>
</div>

    </div>

    <div class="form-group">
        <?= Html::submitButton('<i class="fas fa-save"></i> Simpan', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->

<?php
$js = <<< JS

$('#id_kec').change(function(){
    var kec = $('#id_kec').val() || '';     

    if(kec.length == 2){
        Swal.fire({
            title: 'Pilih Kabupaten/ Kota',
            text: 'Kabupaten/ Kota belum dipilih ...',
            icon: 'warning',
            timer: 2000, 
            showConfirmButton: false, 
            timerProgressBar: true 
        });
    }
});

$('#id_desa').change(function(){
    
    var kec = $('#id_kec').val() || '';     
    var kel = $('#id_desa').val() || ''; 

    if(kel.length == 2 || kel.length == 5){
        Swal.fire({
            title: 'Pilih Kecamatan',
            text: 'Kecamatan belum dipilih ...',
            icon: 'warning',
            timer: 2000, 
            showConfirmButton: false, 
            timerProgressBar: true 
        });
        
        kel = $('#id_desa').val('').prop('disabled', true);
        // kec = $('#id_kec').val('').prop('disabled', true);
    }
});

JS;
$this->registerJs($js);
?>