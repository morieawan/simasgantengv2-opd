<?php
use yii\helpers\Url;
use yii\helpers\Json;
use yii\web\View;

$getBpjsUrl = Url::to(['/bpjs/peserta/get-data']);
$createUrl  = Url::to(['/bpjs/peserta/create']);$searchTabUrl = Url::to(['/bpjs/peserta/tab-search']);

// Encode URL PHP ke format JSON string agar aman di-inject ke JS
$getBpjsUrlJson  = Json::encode($getBpjsUrl);
$createUrlJson   = Json::encode($createUrl);
$searchTabUrlJson = Json::encode($searchTabUrl);
?>

<div class="card card-outline card-primary">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">
            <i class="fas fa-users mr-1"></i> Data Peserta BPJS Keluarga: <strong id="target-nama-pegawai"></strong>
        </h3>
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
$script = <<< JS
    if (!window.selectedPegawai) {
        Swal.fire({
            icon: 'info',
            title: 'Perhatian',
            text: 'Silakan cari dan pilih pegawai terlebih dahulu.',
            confirmButtonColor: '#3085d6'
        }).then(() => {
            $('#btn-tab-search').tab('show');
            if (typeof window.loadTabContent === 'function') {
                window.loadTabContent('search', {$searchTabUrlJson});
            }
        });
        return;
    }

    // Tampilkan Nama & NIP Pegawai Aktif
    $('#target-nama-pegawai').text(window.selectedPegawai.nama + ' (' + window.selectedPegawai.nip + ')');

    // 1. Load Data Peserta BPJS
    $.ajax({
        url: {$getBpjsUrlJson},
        type: 'GET',
        data: { nip: window.selectedPegawai.nip },
        dataType: 'json',
        success: function(res) {
            if (res.status === 'success') {
                let html = '';
                if (!res.data || res.data.length === 0) {
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
                                    <button type="button" class="btn btn-xs btn-warning btn-edit-peserta" data-id="\${item.id_peserta}"><i class="fas fa-edit"></i></button>
                                    <button type="button" class="btn btn-xs btn-danger btn-delete-peserta" data-id="\${item.id_peserta}"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        `;
                    });
                }
                $('#tbody-peserta').html(html);
            } else {
                $('#tbody-peserta').html('<tr><td colspan="5" class="text-center text-danger">Gagal memuat data BPJS.</td></tr>');
            }
        },
        error: function() {
            $('#tbody-peserta').html('<tr><td colspan="5" class="text-center text-danger">Terjadi kesalahan koneksi ke server.</td></tr>');
        }
    });

    // 2. Event Handler Tombol Tambah Peserta
    $('#btn-tambah-peserta').off('click').on('click', function(e) {
        e.preventDefault();
        
        $.ajax({
            url: {$createUrlJson},
            type: 'GET',
            data: { nip: window.selectedPegawai.nip },
            success: function(response) {
                $('#modal-default .modal-content').html(response);
                $('#modal-default').modal('show');
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: 'Tidak dapat memuat form tambah peserta.'
                });
            }
        });
    });
JS;

// Mendaftarkan script ke lifecycle View Yii2 pada posisi POS_READY (DOM/jQuery siap)
$this->registerJs($script, View::POS_READY);
?>