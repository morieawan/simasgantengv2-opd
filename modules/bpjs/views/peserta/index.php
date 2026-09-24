<?php
use yii\helpers\Url;

$this->title = 'BPJS Anggota Keluarga Tambahan';
?>

<!-- Panel Filter / Pencarian Pegawai (Admin OPD) -->
<div class="card card-outline card-info">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-search mr-1"></i> Cari Pegawai (SKPD: <?= $sess['tablok'] ?? '31000000' ?>)</h3>
    </div>
    <div class="card-body">
        <form id="form-search-pegawai" class="row">
            <!-- Hidden Filter Kunci SKPD Admin -->
            <input type="hidden" name="kode_lokasi" value="<?= $sess['tablok'] ?? '31000000' ?>">

            <div class="col-md-4 form-group mb-2">
                <label class="sr-only">NIP / Nama</label>
                <input type="text" class="form-control" id="search_keyword" name="keyword" placeholder="Ketik NIP atau Nama Pegawai...">
            </div>
            <div class="col-md-4 form-group mb-2">
                <label class="sr-only">Sub Lokasi</label>
                <select class="form-control" id="search_sub_lokasi" name="sub_lokasi">
                    <option value="">-- Semua Sub Lokasi --</option>
                    <!-- Option sub lokasi di-load via AJAX atau dari Controller -->
                </select>
            </div>
            <div class="col-md-4 form-group mb-2">
                <button type="submit" class="btn btn-primary btn-block">
                    <i class="fas fa-search mr-1"></i> Cari Pegawai
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Informasi Ringkas Pegawai Terpilih -->
<div class="card card-outline card-secondary" id="card-detail-pegawai" style="display: none;">
    <div class="card-body p-0">
        <table class="table detail-view mb-0">
            <tr>
                <th width="15%" class="bg-light">NIP</th>
                <td width="35%" id="lbl-nip">-</td>
                <th width="15%" class="bg-light">Status Pegawai</th>
                <td width="35%" id="lbl-status-pegawai">-</td>
            </tr>
            <tr>
                <th class="bg-light">Nama ASN</th>
                <td id="lbl-nama-asn">-</td>
                <th class="bg-light">Sub Lokasi / Unit</th>
                <td id="lbl-sub-lokasi">-</td>
            </tr>
        </table>
    </div>
</div>

<!-- Tabel Data Peserta BPJS Anggota Keluarga -->
<div class="card card-outline card-primary" id="card-data-bpjs" style="display: none;">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title"><i class="fas fa-users mr-1"></i> Data Peserta BPJS Keluarga Tambahan</h3>
        <button type="button" class="btn btn-sm btn-success ml-auto" id="btn-tambah-peserta">
            <i class="fas fa-plus mr-1"></i> Tambah Peserta
        </button>
    </div>
    <div class="card-body">
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
                    <!-- Loaded via AJAX -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
$searchPegawaiUrl = Url::to(['/bpjs/peserta/search-pegawai']);
$getBpjsUrl = Url::to(['/bpjs/peserta/get-data']);

$createUrl = Url::to(['/bpjs/peserta/create']);

$script = <<< JS
    let selectedNip = '';

    $('#form-search-pegawai').off('submit').on('submit', function(e) {
        e.preventDefault();
        let formData = $(this).serialize();

        $.ajax({
            url: '<?= $searchPegawaiUrl ?>', 
            type: 'GET',
            data: formData,
            dataType: 'json',
            success: function(res) {
                if (res.status === 'success' && res.data) {
                    selectedNip = res.data.nip;
                    $('#lbl-nip').text(res.data.nip);
                    $('#lbl-nama-asn').text(res.data.nama);
                    $('#lbl-status-pegawai').text(res.data.status_pegawai || '-');
                    $('#lbl-sub-lokasi').text(res.data.nama_unor || res.data.tablokb || '-');

                    $('#card-detail-pegawai, #card-data-bpjs').slideDown();
                    loadBpjsData(selectedNip);
                } else {
                    alert(res.message || 'Data pegawai tidak ditemukan pada lokasi ini.');
                    $('#card-detail-pegawai, #card-data-bpjs').slideUp();
                }
            },
            error: function() {
                alert('Gagal menghubungi server BFF Yii2.');
            }
        });
    });
    

    // 2. Load Data Peserta BPJS
    window.loadBpjsData = function(nip) {
        $.ajax({
            url: '{$getBpjsUrl}',
            type: 'GET',
            data: { nip: nip },
            dataType: 'json',
            success: function(res) {
                if (res.status === 'success') {
                    let html = '';
                    if (res.data.length === 0) {
                        html = '<tr><td colspan="5" class="text-center text-muted">Belum ada data anggota keluarga tambahan.</td></tr>';
                    } else {
                        res.data.forEach(item => {
                            let badgeAktif = item.aktif == 1 
                                ? '<span class="badge badge-success">Aktif</span>' 
                                : '<span class="badge badge-danger">Non-Aktif</span>';

                            html += `
                                <tr>
                                    <td>\${item.nik}</td>
                                    <td>\${item.nama_peserta}</td>
                                    <td>\${item.hubkel}</td>
                                    <td>\${badgeAktif}</td>
                                    <td class="text-center">
                                        <button class="btn btn-xs btn-warning" onclick="editPeserta('\${item.id_peserta}')"><i class="fas fa-edit"></i></button>
                                        <button class="btn btn-xs btn-danger" onclick="deletePeserta('\${item.id_peserta}')"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                            `;
                        });
                    }
                    $('#tbody-peserta').html(html);
                }
            }
        });
    };

    // 3. Trigger Modal Tambah Peserta (Membawa NIP Terpilih)
    $(document).off('click', '#btn-tambah-peserta').on('click', '#btn-tambah-peserta', function(e) {
        e.preventDefault();
        if (!selectedNip) {
            alert('Pilih pegawai terlebih dahulu.');
            return;
        }
        window.openBpjsModal('Tambah Peserta Baru', '{$createUrl}?nip=' + selectedNip);
    });
JS;

$this->registerJs($script);
?>