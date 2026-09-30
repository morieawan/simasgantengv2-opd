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
                <option value="">-- Pilih Hubkel --</option>
                <option value="00">00 - Kepala Keluarga</option>
                <option value="01">01 - Suami/Istri</option>
                <option value="02">02 - Anak</option>
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
$(document).ready(function() {

    // -------------------------------------------------------------
    // LOGIC DEPENDENT DROPDOWN (DEPDROP)
    // -------------------------------------------------------------

    // 1. Load Data Provinsi awal
    function loadProvinsi() {
        // SISIPKAN API / CALL AJAX PROVINSI DI SINI KELAK
        /*
        $.get('/bpjs/wilayah/get-provinsi', function(res) {
            let options = '<option value="">-- Pilih Provinsi --</option>';
            res.forEach(item => {
                options += `<option value="${item.id}">${item.nama}</option>`;
            });
            $('#kd_prov').html(options);
        });
        */
    }
    loadProvinsi();

    // 2. Event Change Provinsi -> Enable & Load Kabupaten
    $('#kd_prov').off('change').on('change', function() {
        let provId = $(this).val();$('#kd_kab, #kd_kec, #kd_desa').html('<option value="">-- Pilih --</option>').prop('disabled', true);

        if (provId) {
            $('#kd_kab').prop('disabled', false);
            // SISIPKAN CALL AJAX KABUPATEN BERDASARKAN provId DI SINI
        }
    });

    // 3. Event Change Kabupaten -> Enable & Load Kecamatan
    $('#kd_kab').off('change').on('change', function() {
        let kabId = $(this).val();$('#kd_kec, #kd_desa').html('<option value="">-- Pilih --</option>').prop('disabled', true);

        if (kabId) {
            $('#kd_kec').prop('disabled', false);
            // SISIPKAN CALL AJAX KECAMATAN BERDASARKAN kabId DI SINI
        }
    });

    // 4. Event Change Kecamatan -> Enable & Load Desa
    $('#kd_kec').off('change').on('change', function() {
        let kecId = $(this).val();$('#kd_desa').html('<option value="">-- Pilih --</option>').prop('disabled', true);

        if (kecId) {
            $('#kd_desa').prop('disabled', false);
            // SISIPKAN CALL AJAX DESA BERDASARKAN kecId DI SINI
        }
    });

    // -------------------------------------------------------------
    // SUBMIT FORM AJAX
    // -------------------------------------------------------------
    $('#form-peserta').off('submit').on('submit', function(e) {
        e.preventDefault();
        let formData = $(this).serialize();
        let csrfToken = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: '/bpjs/peserta/save',
            type: 'POST',
            data: formData,
            headers: { 'X-CSRF-Token': csrfToken },
            dataType: 'json',
            beforeSend: function() {
                $('#btn-save').prop('disabled', true).text('Menyimpan...');
            },
            success: function(res) {
                if (res.status === 'success') {
                    alert(res.message);
                    $('#modal-global-bpjs').modal('hide');
                    if (typeof window.loadPesertaData === 'function') {
                        window.loadPesertaData();
                    }
                } else {
                    alert('Validasi Gagal: ' + JSON.stringify(res.errors));
                }
            },
            error: function() {
                alert('Terjadi kesalahan sistem.');
            },
            complete: function() {
                $('#btn-save').prop('disabled', false).text('Simpan Data');
            }
        });
    });
});
</script>