<div class="card">
    <div class="card-body">
        <table class="table detail-view mb-0">
            <tr>
                <td width="20%">NIP</td>
                <td width="5%">:</td>
                <td><?= $sess['nip'] ?></td>
            </tr>
            <tr>
                <td>Nama ASN</td>
                <td>:</td>
                <td></td>
            </tr>
            <tr>
                <td>Unor</td>
                <td>:</td>
                <td></td>
            </tr>
        </table>
    </div>
</div>

<div class="card card-outline card-primary">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title"><i class="fas fa-users mr-1"></i> Data Peserta BPJS</h3>
        <button class="btn btn-sm btn-success ml-auto" onclick="openFormModal()">
            <i class="fas fa-plus mr-1"></i> Tambah Peserta
        </button>
    </div>

    <div class="card-body">
        <!-- Tabel Data -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="table-peserta">
                <thead>
                    <tr>
                        <th>NIK</th>
                        <th>Nama Peserta</th>
                        <th>Hub. Keluarga</th>
                        <th>Status</th>
                        <th width="120" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="tbody-peserta">
                    <!-- Data dari Controller via AJAX -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Form Input Peserta -->
<div class="modal fade" id="modal-peserta" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modal-title">Form Data Peserta</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-peserta">
                <div class="modal-body">
                    <input type="hidden" id="id_peserta" name="PesertaForm[id_peserta]">
                    
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>NIP <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nip" name="PesertaForm[nip]" maxlength="18" required>
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
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>NIK <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nik" name="PesertaForm[nik]" maxlength="20" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>No. KK <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="no_kk" name="PesertaForm[no_kk]" maxlength="20" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8 form-group">
                            <label>Nama Peserta <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nama_peserta" name="PesertaForm[nama_peserta]" maxlength="150" required>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>OPD</label>
                            <input type="text" class="form-control" id="opd" name="PesertaForm[opd]" maxlength="10">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label>Tanggal Lahir</label>
                            <input type="date" class="form-control" id="tgl_lahir" name="PesertaForm[tgl_lahir]">
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

                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea class="form-control" id="alamat" name="PesertaForm[alamat]" rows="2"></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label>Kelurahan</label>
                            <input type="text" class="form-control" id="kelurahan" name="PesertaForm[kelurahan]">
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Kecamatan</label>
                            <input type="text" class="form-control" id="kecamatan" name="PesertaForm[kecamatan]">
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Kabupaten</label>
                            <input type="text" class="form-control" id="kabupaten" name="PesertaForm[kabupaten]">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Sumber Pembiayaan</label>
                        <input type="text" class="form-control" id="sumber_pembiayaan" name="PesertaForm[sumber_pembiayaan]">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="btn-save">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    loadPesertaData();

    // Submit Form Tambah/Edit via AJAX
    $('#form-peserta').on('submit', function(e) {
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
                    $('#modal-peserta').modal('hide');
                    loadPesertaData();
                    
                    // Reset cache tab Alpine
                    if (window.Alpine) {
                        document.querySelector('[x-data]')._x_dataStack[0].refreshCurrentTab();
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

// Load Data
function loadPesertaData() {
    $.ajax({
        url: '/bpjs/peserta/get-data',
        type: 'GET',
        dataType: 'json',
        success: function(res) {
            if (res.status === 'success') {
                let html = '';
                res.data.forEach(item => {
                    let badgeAktif = item.aktif == 1 
                        ? '<span class="badge badge-success">Aktif</span>' 
                        : '<span class="badge badge-danger">Non-Aktif</span>';

                    html += `
                        <tr>
                            <td>${item.nik}</td>
                            <td>${item.nama_peserta}</td>
                            <td>${item.hubkel}</td>
                            <td>${badgeAktif}</td>
                            <td class="text-center">
                                <button class="btn btn-xs btn-warning" onclick="editPeserta('${item.id_peserta}')"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-xs btn-danger" onclick="deletePeserta('${item.id_peserta}')"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                    `;
                });
                $('#tbody-peserta').html(html);
            }
        }
    });
}

function openFormModal() {
    $('#form-peserta')[0].reset();
    $('#id_peserta').val('');
    $('#modal-title').text('Tambah Peserta Baru');
    $('#modal-peserta').modal('show');
}
</script>