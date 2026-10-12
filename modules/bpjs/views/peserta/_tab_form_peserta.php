<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;

// if (empty($model->provinsi)) $model->provinsi = '33';
// if (empty($model->kabupaten)) $model->kabupaten = '33.29';
 
$sess = Yii::$app->session;
?>

<div class="tambah-peserta-form">

<div class="card card-default">
    <div class="card-header bg-primary">
        <h3 class="card-title">
            <i class="fas fa-users mr-2"></i>
            Anggota Keluarga Pegawai : <?= $sess->get('peserta-nip') ?? ''.' '.$sess->get('peserta-nama') ?? '' ?>
        </h3>
    </div>

    <div class="card-body">        

        <?php $form = ActiveForm::begin([
            'id' => 'form-tambah-peserta', 
            'type' => ActiveForm::TYPE_VERTICAL,
            'action' => Url::to(['/bpjs/peserta/save-peserta'])
        ]); ?>
            
            <div class="row">
                <div class="col-md-8">
                    <?= $form->field($model, 'nama_peserta')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'nip')->hiddenInput()->label(false) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'sumber_pembiayaan')->textInput(['disabled' => true, 'value' => 'GAJI + TPP']) ?>
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
                    <?= $form->field($model, 'tgl_lahir')->widget(
                        \kartik\date\DatePicker::classname(),
                        [
                            'options' => ['placeholder' => 'dd-mm-yyyy', 'autocomplete' => 'off'],
                            'pluginOptions' => [
                                'autoclose' => true,
                                'todayHighlight' => true,
                                'format' => 'dd-mm-yyyy',
                            ],
                        ]
                    ); ?>
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
                <?= Html::submitButton('Simpan', ['class' => 'btn btn-danger']) ?>
                <?= Html::button('<i class="fas fa-save"></i> Simpan', [
                    'class' => 'btn btn-success',
                    'id' => 'btn-simpan-peserta',
                    'type' => 'button'
                ]) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->

<?php

$targetForm = Url::to(['/bpjs/peserta/save-peserta']);

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

// Mencegah form di-submit secara native jika menekan tombol Enter
// $('#form-tambah-peserta').on('submit', function(e) {
//     e.preventDefault();
// });

// Handling Submit via AJAX
// $('#btn-simpan-peserta').off('click').on('click', function(e) {
//     e.preventDefault();

//     var \$form = $('#form-tambah-peserta');
//     // var targetUrl = \$form.attr('action') || window.location.href; // Mengambil action form
//     var targetUrl = '{$targetForm}';

//     // Ambil semua data form termasuk input text, dropdown Select2, dll.
//     var formData = new FormData(\$form[0]);

//     $.ajax({
//         url: targetUrl,
//         type: 'POST',
//         data: formData,
//         processData: false, 
//         contentType: false, 
//         beforeSend: function() {
//             $('#btn-simpan-peserta').prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Menyimpan...');
//         },
//         success: function(response) {
//             $('#btn-simpan-peserta').prop('disabled', false).html('<i class="fas fa-save"></i> Simpan');

//             // Tangani response JSON dari controller
//             if (response.success) {
//                 Swal.fire({
//                     icon: 'success',
//                     title: 'Berhasil!',
//                     text: response.message || 'Data peserta berhasil disimpan.',
//                     timer: 2000,
//                     showConfirmButton: false
//                 });

//                 // Opsional: Reset form atau refresh tabel partial di SPA Anda
//                 // \$form[0].reset();
//                 // $('#id_prov').val(null).trigger('change');
//             } else {
//                 Swal.fire({
//                     icon: 'error',
//                     title: 'Gagal!',
//                     text: response.message || 'Terjadi kesalahan saat menyimpan data.'
//                 });
//             }
//         },
//         error: function(xhr, status, error) {
//             $('#btn-simpan-peserta').prop('disabled', false).html('<i class="fas fa-save"></i> Simpan');
            
//             Swal.fire({
//                 icon: 'error',
//                 title: 'Error ' + xhr.status,
//                 text: 'Gagal mengirim data ke server.'
//             });
//         }
//     });
// });
JS;
$this->registerJs($js);
?>