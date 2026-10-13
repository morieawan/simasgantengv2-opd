<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;

$tabPesertaUrl    = Url::to(['/bpjs/peserta/tab-peserta']);
 
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
            'method' => 'post',
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
                <?= $form->field($model, 'kabupaten')->widget(DepDrop::class, [
                    'data' => ArrayHelper::map($kab, 'id', 'name'),
                    'options' => ['id' => 'id_kab'],
                    'type' => DepDrop::TYPE_SELECT2,
                    'select2Options' => [
                        'pluginOptions' => ['allowClear' => true],
                    ],
                    'pluginOptions' => [
                        'depends' => ['id_prov'],
                        'placeholder' => 'Pilih Kabupaten...',
                        'url' => Url::to(['/bpjs/peserta/get-wilayah']),
                        'loadingText' => 'Memuat Kabupaten...',
                    ],
                ])->label('Kabupaten/Kota') ?>
                
            </div>

            <div class="col-md-3 form-group">
                <?= $form->field($model, 'kecamatan')->widget(DepDrop::class, [
                    'data' => ArrayHelper::map($kec, 'id', 'name'),
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
                    'data' => ArrayHelper::map($desa, 'id', 'name'),
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

$js = <<<JS

// =====================================================
// 1. TOMBOL SIMPAN FORM SPA
// =====================================================
$(document)
    .off('click.tambahPeserta', '#btn-simpan-peserta')
    .on('click.tambahPeserta', '#btn-simpan-peserta', function (e) {
        e.preventDefault();

        $('#form-tambah-peserta').trigger('submit');
    });


// =====================================================
// 2. SUBMIT FORM MELALUI AJAX
// =====================================================
$(document)
    .off('beforeSubmit.tambahPeserta', '#form-tambah-peserta')
    .on('beforeSubmit.tambahPeserta', '#form-tambah-peserta', function (e) {
        e.preventDefault();

        var form = $(this);
        var tombol = $('#btn-simpan-peserta');

        if (tombol.prop('disabled')) {
            return false;
        }

        tombol.prop('disabled', true)
              .html('<i class="fas fa-spinner fa-spin"></i> Menyimpan...');

        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: form.serialize(),
            dataType: 'json',

            success: function (res) {
                if (res.success === true) {
                    Swal.fire({
                        title: 'Berhasil',
                        text: res.message || 'Data peserta berhasil disimpan.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(function (result) {
                        if (!result.isConfirmed && !result.isDismissed) {
                            return;
                        }

                        // Ambil data pegawai yang sedang dipilih di SPA
                        var pegawai = window.selectedPegawai || {};

                        // Gunakan NIP dari state SPA, atau session jika state tersedia
                        var nip = pegawai.nip || '';

                        if (!nip) {
                            Swal.fire(
                                'Peringatan',
                                'NIP pegawai tidak ditemukan. Silakan pilih kembali pegawai.',
                                'warning'
                            );
                            return;
                        }

                        // Hapus cache daftar peserta agar data terbaru dimuat
                        delete window.tabCache['peserta'];

                        // Sembunyikan tab form
                        $('#li-tab-form-peserta').hide();

                        // Muat ulang tab peserta dengan NIP
                        var url = $('#btn-tab-peserta').data('url');

                        window.loadTabContent(
                            'peserta',
                            url + (url.indexOf('?') >= 0 ? '&' : '?') +
                                'nip=' + encodeURIComponent(nip),
                            function () {
                                $('#btn-tab-peserta')
                                    .removeClass('disabled')
                                    .tab('show');
                            }
                        );
                    });
                } else {
                    Swal.fire({
                        title: 'Gagal',
                        text: res.message || 'Data gagal disimpan.',
                        icon: 'error'
                    });
                }
            },

            error: function (xhr) {
                var pesan = 'Terjadi kesalahan saat menghubungi server.';

                if (xhr.responseJSON && xhr.responseJSON.message) {
                    pesan = xhr.responseJSON.message;
                }

                Swal.fire({
                    title: 'Kesalahan',
                    text: pesan,
                    icon: 'error'
                });
            },

            complete: function () {
                tombol.prop('disabled', false)
                      .html('<i class="fas fa-save"></i> Simpan');
            }
        });

        return false;
    });


// =====================================================
// 3. VALIDASI PERUBAHAN KECAMATAN
// =====================================================
$(document)
    .off('change.wilayah', '#id_kec')
    .on('change.wilayah', '#id_kec', function () {
        var kec = $(this).val() || '';

        if (!kec) {
            return;
        }
    });


// =====================================================
// 4. VALIDASI PERUBAHAN KELURAHAN / DESA
// =====================================================
$(document)
    .off('change.wilayah', '#id_desa')
    .on('change.wilayah', '#id_desa', function () {
        var desa = $(this).val() || '';

        if (!desa) {
            return;
        }
    });

JS;

$this->registerJs($js);

?>
