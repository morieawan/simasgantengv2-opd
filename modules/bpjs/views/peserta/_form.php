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
        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-success" id="btn-save">Simpan Data</button>
    </div>
</form>

<script>
(function($) {
    'use strict';

    $(document).ready(function() {
        // 1. Inisialisasi CSRF Token Yii2 secara Global di Scope Form
        var csrfParam = yii.getCsrfParam();
        var csrfToken = yii.getCsrfToken();

        // =========================================================
        // A. DEPENDENT DROPDOWN WILAYAH
        // =========================================================
        var getWilayahUrl = <?= \yii\helpers\Json::encode(\yii\helpers\Url::to(['/bpjs/peserta/get-wilayah'])) ?>;

        function fetchAndPopulateWilayah(targetSelector, parentCode, placeholder, selectedVal = '') {
            var $target = $(targetSelector);
            $target.html('<option value="">-- Memuat ' + placeholder + '... --</option>').prop('disabled', true);

            var requestData = { parent: parentCode };
            requestData[csrfParam] = csrfToken;

            $.ajax({
                url: getWilayahUrl,
                type: 'GET',
                data: requestData,
                dataType: 'json',
                cache: false,
                success: function(res) {
                    if (res.status === 'success' && res.data && res.data.length > 0) {
                        var options = '<option value="">-- Pilih ' + placeholder + ' --</option>';
                        $.each(res.data, function(idx, item) {
                            var isSelected = (item.kode === selectedVal) ? 'selected' : '';
                            options += '<option value="' + item.kode + '" ' + isSelected + '>' + item.nama + '</option>';
                        });
                        $target.html(options).prop('disabled', false);
                    } else {
                        $target.html('<option value="">-- Pilih ' + placeholder + ' --</option>').prop('disabled', false);
                    }
                },
                error: function() {
                    $target.html('<option value="">-- Gagal Memuat Data --</option>').prop('disabled', true);
                }
            });
        }

        // Load Awal Wilayah (Mode Tambah & Edit)
        var initProv = <?= \yii\helpers\Json::encode($model->kd_prov ?? '') ?>;
        var initKab  = <?= \yii\helpers\Json::encode($model->kd_kab ?? '') ?>;
        var initKec  = <?= \yii\helpers\Json::encode($model->kd_kec ?? '') ?>;
        var initDesa = <?= \yii\helpers\Json::encode($model->kd_desa ?? '') ?>;

        fetchAndPopulateWilayah('#kd_prov', '', 'Provinsi', initProv);

        if (initProv) { fetchAndPopulateWilayah('#kd_kab', initProv, 'Kabupaten/Kota', initKab); }
        if (initKab)  { fetchAndPopulateWilayah('#kd_kec', initKab, 'Kecamatan', initKec); }
        if (initKec)  { fetchAndPopulateWilayah('#kd_desa', initKec, 'Desa/Kelurahan', initDesa); }

        // Event Change Handlers Wilayah
        $('#kd_prov').off('change').on('change', function() {
            var provKode = $(this).val();
            $('#kd_kab, #kd_kec, #kd_desa').html('<option value="">-- Pilih --</option>').prop('disabled', true);
            if (provKode) { fetchAndPopulateWilayah('#kd_kab', provKode, 'Kabupaten/Kota'); }
        });

        $('#kd_kab').off('change').on('change', function() {
            var kabKode = $(this).val();
            $('#kd_kec, #kd_desa').html('<option value="">-- Pilih --</option>').prop('disabled', true);
            if (kabKode) { fetchAndPopulateWilayah('#kd_kec', kabKode, 'Kecamatan'); }
        });

        $('#kd_kec').off('change').on('change', function() {
            var kecKode = $(this).val();
            $('#kd_desa').html('<option value="">-- Pilih --</option>').prop('disabled', true);
            if (kecKode) { fetchAndPopulateWilayah('#kd_desa', kecKode, 'Desa/Kelurahan'); }
        });


        // =========================================================
        // B. DROPDOWN HUBUNGAN KELUARGA (HUBKEL)
        // =========================================================
        var getHubkelUrl = <?= \yii\helpers\Json::encode(\yii\helpers\Url::to(['/bpjs/peserta/get-hubkel'])) ?>;
        var selectedHubkel = <?= \yii\helpers\Json::encode($model->hubkel ?? '') ?>;

        function loadHubkelDropdown() {
            var $hubkel = $('#hubkel');
            $hubkel.html('<option value="">-- Memuat Hubkel... --</option>').prop('disabled', true);

            var requestData = {};
            requestData[csrfParam] = csrfToken;

            $.ajax({
                url: getHubkelUrl,
                type: 'GET',
                data: requestData,
                dataType: 'json',
                cache: false,
                success: function(res) {
                    if (res.status === 'success' && res.data && res.data.length > 0) {
                        var options = '<option value="">-- Pilih Hubkel --</option>';
                        $.each(res.data, function(idx, item) {
                            var isSelected = (item.kd_hubkel === selectedHubkel) ? 'selected' : '';
                            options += '<option value="' + item.kd_hubkel + '" ' + isSelected + '>' + item.kd_hubkel + ' - ' + item.nm_hubkel + '</option>';
                        });
                        $hubkel.html(options).prop('disabled', false);
                    } else {
                        $hubkel.html('<option value="">-- Gagal Memuat --</option>').prop('disabled', false);
                    }
                },
                error: function() {
                    $hubkel.html('<option value="">-- Gagal Memuat --</option>').prop('disabled', false);
                }
            });
        }

        // Jalankan pemanggilan Hubkel
        loadHubkelDropdown();
    });

})(jQuery);
</script>