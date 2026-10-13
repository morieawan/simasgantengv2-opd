<?php
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\IuranBpjs */
/* @var $form kartik\widgets\ActiveForm */

$sess = Yii::$app->session;
?>

<div class="iuran-bpjs-form">
    <div class="card card-default">
        <div class="card-header bg-primary">
            <h3 class="card-title">
                <i class="fas fa-file-invoice-dollar mr-2"></i> 
                Form Input Iuran BPJS Pegawai: <?= $sess->get('peserta-nip') ?? '' ?> - <?= $sess->get('peserta-nama') ?? '' ?>
            </h3>
        </div>
        <div class="card-body">
            
            <?php $form = ActiveForm::begin([
                'id' => 'form-tambah-iuran',
                'type' => ActiveForm::TYPE_VERTICAL,
                'method' => 'post',
                'action' => Url::to(['/bpjs/iuran/save-iuran']) // Sesuaikan endpoint action controller Anda
            ]); ?>

            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'id')->textInput(['maxlength' => true, 'placeholder' => 'Contoh: P001-2026-10']) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'id_peserta')->textInput(['maxlength' => true]) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group">
                    <?= $form->field($model, 'periode')->widget(DatePicker::classname(), [
                        'options' => ['placeholder' => 'Pilih bulan & tahun...', 'autocomplete' => 'off'],
                        'pluginOptions' => [
                            'autoclose' => true,
                            'format' => 'yyyy-mm-dd', // Sesuaikan format tanggal database
                            'todayHighlight' => true,
                        ]
                    ]); ?>
                </div>
                <div class="col-md-6 form-group">
                    <?= $form->field($model, 'tgl_bayar')->widget(DatePicker::classname(), [
                        'options' => ['placeholder' => 'dd-mm-yyyy', 'autocomplete' => 'off'],
                        'pluginOptions' => [
                            'autoclose' => true,
                            'format' => 'dd-mm-yyyy',
                            'todayHighlight' => true,
                        ]
                    ]); ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($model, 'pagu_total')->textInput(['type' => 'number']) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'persen_pot')->textInput(['maxlength' => true, 'type' => 'number', 'step' => '0.01']) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'jml_iuran')->textInput(['type' => 'number']) ?>
                </div>
            </div>

            <div class="form-group">
                <?= $form->field($model, 'pagu_rinc')->textarea(['rows' => 3, 'placeholder' => 'Rincian pagu...']) ?>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'sumber_iuran')->textInput(['type' => 'number']) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'flag')->textInput(['type' => 'number'])->dropDownList([1 => 'Aktif / Valid', 0 => 'Tidak Aktif'])->label('Flag Status') ?>
                </div>
            </div>

            <div class="form-group mt-3">
                <?= Html::button('<i class="fas fa-save"></i> Simpan', [
                    'class' => 'btn btn-success', 
                    'id' => 'btn-simpan-iuran', 
                    'type' => 'button'
                ]) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>

<?php 
$js = <<<JS
// =====================================================
// 1. TOMBOL SIMPAN FORM SPA
// =====================================================
$(document)
    .off('click.tambahIuran', '#btn-simpan-iuran')
    .on('click.tambahIuran', '#btn-simpan-iuran', function (e) {
        e.preventDefault();
        $('#form-tambah-iuran').trigger('submit');
    });

// =====================================================
// 2. SUBMIT FORM MELALUI AJAX
// =====================================================
$(document)
    .off('beforeSubmit.tambahIuran', '#form-tambah-iuran')
    .on('beforeSubmit.tambahIuran', '#form-tambah-iuran', function (e) {
        e.preventDefault();
        var form = $(this);
        var tombol = $('#btn-simpan-iuran');
        
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
                        text: res.message || 'Data iuran berhasil disimpan.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(function (result) {
                        if (!result.isConfirmed && !result.isDismissed) {
                            return;
                        }

                        // Ambil data pegawai aktif dari state SPA
                        var pegawai = window.selectedPegawai || {};
                        var nip = pegawai.nip || '';

                        // Hapus cache daftar iuran agar data terbaru dimuat ulang
                        if (window.tabCache) {
                            delete window.tabCache['iuran'];
                        }

                        // Sembunyikan tab form iuran jika menggunakan sistem toggle tab
                        $('#li-tab-form-iuran').hide();

                        // Muat ulang tab iuran dengan NIP terkait
                        var url = $('#btn-tab-iuran').data('url');
                        if (url && typeof window.loadTabContent === 'function') {
                            window.loadTabContent('iuran', url + (url.indexOf('?') >= 0 ? '&' : '?') + 'nip=' + encodeURIComponent(nip), function () {
                                $('#btn-tab-iuran').removeClass('disabled').tab('show');
                            });
                        }
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
JS;
$this->registerJs($js);
?>