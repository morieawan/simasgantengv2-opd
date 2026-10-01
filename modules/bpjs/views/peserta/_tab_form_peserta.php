<form id="form-peserta">
    <input type="hidden" id="id_peserta" name="PesertaForm[id_peserta]" value="<?= $model->id_peserta ?? '' ?>">

    <div class="row">
        <div class="col-md-8 form-group">
            <label>Nama Peserta <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="nama_peserta" name="PesertaForm[nama_peserta]" maxlength="150" value="<?= $model->nama_peserta ?? '' ?>" required>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6 form-group">
            <label>NIK <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="nik" name="PesertaForm[nik]" maxlength="20" value="<?= $model->nik ?? '' ?>" required>
        </div>
        <div class="col-md-6 form-group">
            <label>Hubungan Keluarga <span class="text-danger">*</span></label>
            <select class="form-control" id="hubkel" name="PesertaForm[hubkel]" required>
                <option value="">-- Memuat Hubkel... --</option>
            </select>
        </div>
        <!--
        <div class="col-md-6 form-group">
            <label>No. KK <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="no_kk" name="PesertaForm[no_kk]" maxlength="20" value="" required>
        </div>
        -->
    </div>

    <div class="row">
        <div class="col-md-4 form-group">
            <label>Tanggal Lahir</label>
            <input type="date" class="form-control" id="tgl_lahir" name="PesertaForm[tgl_lahir]" value="<?= $model->tgl_lahir ?? '' ?>">
        </div>
        <div class="col-md-4 form-group">
            <label>Jenis Kelamin</label>
            <select class="form-control" id="jk" name="PesertaForm[jk]">
                <option value="1">Laki-laki</option>
                <option value="0">Perempuan</option>
            </select>
        </div>
        <div class="col-md-4 form-group">
            <label>Status Aktif</label>
            <select class="form-control" id="aktif" name="PesertaForm[aktif]">
                <option value="1">Aktif</option>
                <option value="0">Tidak Aktif</option>
            </select>
        </div>
    </div>

    <!-- Input Text Alamat -->
    <div class="form-group">
        <label>Alamat Jalan / RT / RW</label>
        <input type="text" class="form-control" id="alamat" name="PesertaForm[alamat]" value="<?= $model->alamat ?? '' ?>" placeholder="Jl. Anggrek No. 12 RT 01 RW 02">
    </div>

    <!-- Dependent Dropdown Wilayah -->
    <div class="row">
        <div class="col-md-3 form-group">
            <label>Provinsi</label>
            <select class="form-control" id="kd_prov" name="PesertaForm[kd_prov]">
                <option value="">-- Pilih Provinsi --</option>
            </select>
        </div>
        <div class="col-md-3 form-group">
            <label>Kab/Kota</label>
            <select class="form-control" id="kd_kab" name="PesertaForm[kd_kab]" disabled>
                <option value="">-- Pilih Kabupaten --</option>
            </select>
        </div>
        <div class="col-md-3 form-group">
            <label>Kecamatan</label>
            <select class="form-control" id="kd_kec" name="PesertaForm[kd_kec]" disabled>
                <option value="">-- Pilih Kecamatan --</option>
            </select>
        </div>
        <div class="col-md-3 form-group">
            <label>Desa/Kel</label>
            <select class="form-control" id="kd_desa" name="PesertaForm[kd_desa]" disabled>
                <option value="">-- Pilih Desa --</option>
            </select>
        </div>
    </div>

    <div class="modal-footer px-0 pb-0 pt-3">
        <button type="reset" class="btn btn-danger">Batal</button>
        <button type="submit" class="btn btn-success" id="btn-save">Simpan Data</button>
    </div>
</form>

<?php
$script = <<< JS
    $(document).ready(function() {
        if (typeof loadProvinsiDropdown === 'function') {
            loadProvinsiDropdown();
        }
        if (typeof loadHubkelDropdown === 'function') {
            loadHubkelDropdown();
        }
    });
JS;
$this->registerJS($script);

$this->registerCssFile('https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css');
$this->registerJsFile('https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js', ['depends' => [\yii\web\JqueryAsset::class]]);
?>

<script>
(function($) {
    'use strict';

    var getWilayahUrl = <?= \yii\helpers\Json::encode(\yii\helpers\Url::to(['/bpjs/peserta/get-wilayah'])) ?>;
    var getHubkelUrl  = <?= \yii\helpers\Json::encode(\yii\helpers\Url::to(['/bpjs/peserta/get-hubkel'])) ?>;
    
    var selectedProv  = <?= \yii\helpers\Json::encode($model->kd_prov ?? '') ?>;
    var selectedHub   = <?= \yii\helpers\Json::encode($model->hubkel ?? '') ?>;

    // Helper untuk mengaktifkan / merefresh plugin Select2
    function initSelect2($elem, placeholder) {
        if ($.fn.select2) {
            // Destroy dulu jika sudah terinisialisasi sebelumnya agar tidak duplicate
            if ($elem.hasClass('select2-hidden-accessible')) {
                $elem.select2('destroy');
            }
            $elem.select2({
                placeholder: placeholder,
                allowClear: true,
                width: '100%' // Agar tampilan Select2 responsif sesuai kontainer
            });
        }
    }

    // 1. Load Provinsi dengan Select2 Search
    window.loadProvinsiDropdown = function() {
        var $prov = $('#kd_prov, #kd_prop'); // Sesuaikan ID elemen select Anda
        if (!$prov.length) return;

        $prov.html('<option value="">-- Memuat Provinsi... --</option>').prop('disabled', true);

        $.ajax({
            url: getWilayahUrl,
            type: 'GET',
            dataType: 'json',
            cache: false,
            success: function(res) {
                if ((res.status === true || res.status === 'success') && res.data && res.data.length > 0) {
                    var options = '<option value="">-- Pilih Provinsi --</option>';
                    $.each(res.data, function(idx, item) {
                        var isSelected = (item.kode === selectedProv) ? 'selected' : '';
                        options += '<option value="' + item.kode + '" ' + isSelected + '>' + item.nama + '</option>';
                    });
                    
                    $prov.html(options).prop('disabled', false);
                    
                    // Inisialisasi fitur Search Select2
                    initSelect2($prov, '-- Pilih Provinsi --');
                } else {
                    $prov.html('<option value="">-- Data Kosong / Gagal Memuat --</option>').prop('disabled', false);
                }
            },
            error: function() {
                $prov.html('<option value="">-- Error Memuat Data --</option>').prop('disabled', false);
            }
        });
    };

    // 2. Load Hubkel dengan Select2 Search
    window.loadHubkelDropdown = function() {
        var $hubkel = $('#hubkel, #kd_hubkel'); // Sesuaikan ID elemen select Anda
        if (!$hubkel.length) return;

        $hubkel.html('<option value="">-- Memuat Hubkel... --</option>').prop('disabled', true);

        $.ajax({
            url: getHubkelUrl,
            type: 'GET',
            dataType: 'json',
            cache: false,
            success: function(res) {
                if ((res.status === true || res.status === 'success') && res.data && res.data.length > 0) {
                    var options = '<option value="">-- Pilih Hubkel --</option>';
                    $.each(res.data, function(idx, item) {
                        var isSelected = (item.kd_hubkel === selectedHub) ? 'selected' : '';
                        options += '<option value="' + item.kd_hubkel + '" ' + isSelected + '>' + 
                                   item.kd_hubkel + ' - ' + item.nm_hubkel + '</option>';
                    });
                    
                    $hubkel.html(options).prop('disabled', false);
                    
                    // Inisialisasi fitur Search Select2
                    initSelect2($hubkel, '-- Pilih Hubkel --');
                } else {
                    $hubkel.html('<option value="">-- Data Kosong / Gagal Memuat --</option>').prop('disabled', false);
                }
            },
            error: function() {
                $hubkel.html('<option value="">-- Error Memuat Data --</option>').prop('disabled', false);
            }
        });
    };

    // Jalankan saat tab selesai dimuat
    $(document).ready(function() {
        loadProvinsiDropdown();
        loadHubkelDropdown();
    });

})(jQuery);
</script>

