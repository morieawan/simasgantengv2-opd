<?php
use yii\helpers\Url;

$getBpjsUrl = Url::to(['/bpjs/peserta/get-data']);$createUrl  = Url::to(['/bpjs/peserta/create']);
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

<script>
$(document).ready(function() {
    if (!window.selectedPegawai) {
        Swal.fire({
            icon: 'info',
            title: 'Perhatian',
            text: 'Silakan cari dan pilih pegawai terlebih dahulu.',
            confirmButtonColor: '#3085d6'
        }).then(() => {
            $('#btn-tab-search').tab('show');
            window.loadTabContent('search', '<?= Url::to(['/bpjs/peserta/tab-search']) ?>');
        });
        return;
    }

    $('#target-nama-pegawai').text(window.selectedPegawai.nama + ' (' + window.selectedPegawai.nip + ')');

    // Load Data BPJS
    $.ajax({
        url: '<?= $getBpjsUrl ?>',
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
                                    <button class="btn btn-xs btn-warning"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-xs btn-danger"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        `;
                    });
                }
                $('#tbody-peserta').html(html);
            }
        }
    });
});
</script>