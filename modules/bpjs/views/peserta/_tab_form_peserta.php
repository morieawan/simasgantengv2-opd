<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\datecontrol\DateControl;   
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
                'data' => ArrayHelper::map($hubkel, 'kd_hubkel', 'nm_hubkel'),
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

    <!-- Dependent Dropdown Wilayah -->
    <div class="row">
        <div class="col-md-3 form-group">
            <?= $form->field($model, 'provinsi')->widget(Select2::class, [
                'data' => [],
                'options' => [
                    'placeholder' => 'Pilih Provinsi...',
                    'id' => 'kd_prov',
                ],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ]) ?>
        </div>
        <div class="col-md-3 form-group">
            <?= $form->field($model, 'kabupaten')->widget(DepDrop::class, [
                'type' => DepDrop::TYPE_SELECT2,
                'options' => ['id' => 'kd_kab', 'label' => 'Kabupaten/ Kota'],
                'select2Options' => [
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ],
                'pluginOptions' => [
                    'depends' => ['kd_prov'],
                    'placeholder' => 'Pilih Kabupaten...',
                    'url' => Url::to(['/bpjs-peserta/get-wilayah?parent=']),
                    'loadingText' => 'Memuat Kabupaten...',
                ],
            ]) ?>
        </div>
        <div class="col-md-3 form-group">
            <?= $form->field($model, 'kecamatan')->widget(DepDrop::class, [
                'type' => DepDrop::TYPE_SELECT2,
                'options' => ['id' => 'kd_kec'],
                'select2Options' => [
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ],
                'pluginOptions' => [
                    'depends' => ['kd_kab'],
                    'placeholder' => 'Pilih Kecamatan...',
                    'url' => Url::to(['/bpjs-peserta/get-wilayah?parent=']),
                    'loadingText' => 'Memuat Kecamatan...',
                ],
            ]) ?>
        </div>
        <div class="col-md-3 form-group">
           <?= $form->field($model, 'kelurahan')->widget(DepDrop::class, [
                'type' => DepDrop::TYPE_SELECT2,
                'options' => ['id' => 'kd_desa'],
                'select2Options' => [
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ],
                'pluginOptions' => [
                    'depends' => ['kd_kec'],
                    'placeholder' => 'Pilih Kel/ Desa...',
                    'url' => Url::to(['/bpjs-peserta/get-wilayah?parent=']),
                    'loadingText' => 'Memuat Kel/ Desa...',
                ],
            ]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('<i class="fas fa-save"></i> Simpan', ['class' => 'btn btn-success']) ?>
        <?= Html::resetButton('<i class="fas fa-minus-circle"></i> Batal', ['class' => 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
