<?php
use yii\helpers\Html;
use yii\helpers\Url;

// Fungsi helper untuk mengurutkan array berdasarkan kdhubkel / hubkel ASC
$fnSortHubkel = function ($a, $b) {
    $hubA = isset($a['kdhubkel']) ? (int)$a['kdhubkel'] : (int)($a['hubkel'] ?? 0);
    $hubB = isset($b['kdhubkel']) ? (int)$b['kdhubkel'] : (int)($b['hubkel'] ?? 0);
    return $hubA <=> $hubB;
};

// Urutkan data berdasarkan kdhubkel ASC
if (!empty($pesertaUtama) && is_array($pesertaUtama)) {
    usort($pesertaUtama, $fnSortHubkel);
}
if (!empty($pesertaTambahan) && is_array($pesertaTambahan)) {
    usort($pesertaTambahan, $fnSortHubkel);
}

?>

<div class="tab-peserta-container" style="font-size: 13px;">

    <!-- ========================================== -->
    <!-- 1. TABEL DATA PESERTA UTAMA (DB5 - SIMGAJI) -->
    <!-- ========================================== -->
    <div class="panel panel-default mb-4" style="margin-bottom: 25px;">
        <div class="panel-heading" style="background-color: #f8f9fa; font-weight: bold; font-size: 14px; padding: 10px 15px;">
            <i class="fa fa-users text-primary"></i> Data Peserta Utama (Simgaji)
            <?php if (!empty($pegawai)): ?>
                <span class="text-muted" style="font-weight: normal; font-size: 14px;">
                    : <strong><?= Html::encode($pegawai['nama'] ?? '') ?></strong> (<?= Html::encode($pegawai['nip'] ?? '') ?>)
                </span>
            <?php endif; ?>
        </div>
        <div class="panel-body padding-0" style="padding: 0;">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover mb-0" style="margin-bottom: 0; font-size: 13px;">
                    <thead style="background-color: #f1f3f5;">
                        <tr>
                            <th class="text-center" style="width: 5%;">No</th>
                            <th>Nama Peserta</th>
                            <th class="text-center" style="width: 10%;">Tgl. Lahir</th>
                            <th class="text-center" style="width: 25%;">Hub. Keluarga</th>
                            <th class="text-center" style="width: 15%;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($pesertaUtama)): ?>
                            <?php foreach ($pesertaUtama as $index => $row): ?>
                                <tr>
                                    <td class="text-center"><?= $index + 1 ?></td>
                                    <td><?= Html::encode($row['NMBDG'] ?? $row['nm_kel'] ?? '-') ?></td>
                                    <td class="text-center"><?= !empty($row['tgl_lhr']) ? Html::encode(date('d-m-Y', strtotime($row['tgl_lhr']))) : '-' ?></td>
                                    <td class="text-center">
                                        <span class="label label-info" style="font-size: 12px;">
                                            <?= Html::encode($row['nama_hubkel'] ?? $row['kd_hubkel'].' - '.$row['nm_hubkel'] ?? '-') ?>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="label label-success" style="font-size: 12px;">
                                            <?= Html::encode($row['is_calculated_tertunjang']) == true ? 'Tertunjang' : 'Tdk Tertunjang' ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center text-muted" style="padding: 15px;">
                                    Data peserta utama dari Simgaji tidak ditemukan.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!-- ==================================================== -->
    <!-- 2. TABEL DATA PESERTA BPJS TAMBAHAN (DB21 - MYSQL)  -->
    <!-- ==================================================== -->
    <div class="panel panel-default">
        <div class="panel-heading clearfix" style="background-color: #f8f9fa; padding: 8px 15px;">
            <div class="float-left" style="font-weight: bold; font-size: 14px; line-height: 32px;">
                <i class="fa fa-user-plus text-success"></i> Data Peserta BPJS Tambahan
            </div>
            <div class="float-right">
                <?= Html::a('<i class="fa fa-plus"></i> Tambah Peserta', '#tab-form-peserta', [
                    'class' => 'btn btn-sm btn-success btn-tambah-peserta',
                ]) ?>

                <?= Html::a('<i class="fa fa-file-invoice-dollar"></i> Iuran Peserta', '#tab-iuran', [
                    'class' => 'btn btn-sm btn-info btn-iuran',
                ]) ?>
            </div>
        </div>
        <div class="panel-body padding-0" style="padding: 0;">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover mb-0" style="margin-bottom: 0; font-size: 14px;">
                    <thead style="background-color: #f1f3f5;">
                        <tr>
                            <th class="text-center" style="width: 40px;">No</th>
                            <th class="text-center" style="width: 140px;">NIK</th>
                            <th>Nama Peserta</th>
                            <th class="text-center" style="width: 110px;">Tgl. Lahir</th>
                            <th class="text-center" style="width: 130px;">Hub. Keluarga</th>
                            <th class="text-center" style="width: 90px;">Status</th>
                            <th class="text-center" style="width: 110px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($pesertaTambahan)): ?>
                            <?php foreach ($pesertaTambahan as $index => $row): ?>
                                <tr>
                                    <td class="text-center"><?= $index + 1 ?></td>
                                    <td class="text-center"><?= Html::encode($row['nik'] ?? '-') ?></td>
                                    <td><strong><?= Html::encode($row['nama_peserta'] ?? '-') ?></strong></td>
                                    <td class="text-center"><?= !empty($row['tgl_lahir']) ? Html::encode(date('d-m-Y', strtotime($row['tgl_lahir']))) : '-' ?></td>
                                    <td class="text-center">
                                        <span class="label label-default" style="font-size: 12px;">
                                            <?= Html::encode($row['hubkel'].': '.$row['nama_hubkel'] ?? $row['hubkel'] ?? '-') ?>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <?php if (isset($row['aktif']) && $row['aktif'] == 1): ?>
                                            <span class="label label-success" style="font-size: 12px;">Aktif</span>
                                        <?php else: ?>
                                            <span class="label label-danger" style="font-size: 12px;">Non-Aktif</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-xs btn-primary btn-update" data-id="<?= Html::encode($row['id_peserta'] ?? '') ?>" title="Edit">
                                            <i class="fas fa-pencil-alt"></i>
                                        </button>
                                        <button class="btn btn-xs btn-danger btn-delete" data-id="<?= Html::encode($row['id_peserta'] ?? '') ?>" title="Hapus">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="text-center text-muted" style="padding: 15px;">
                                    Belum ada data peserta BPJS tambahan.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
$getGabunganUrl = Url::to(['/bpjs/peserta/get-gabungan-gaji-tpp']); 
$nipPegawai = $pegawai['nip'] ?? ''; 

$getUrl = Url::to(['/bpjs/peserta/get-detail']);    
$deleteUrl = Url::to(['/bpjs/peserta/del-peserta']);     

$getPeserta = Url::to(['/bpjs/peserta/get-peserta']);    


$js = <<<JS
$('.btn-tambah-peserta').on('click', function(e) {
    e.preventDefault();
    let nip = '{$nipPegawai}';     
    if (!nip) {
        Swal.fire('Error', 'NIP Pegawai tidak ditemukan.', 'error');
        return;
    }

    Swal.showLoading();

    $.ajax({
        url: '{$getPeserta}',
        type: 'GET',
        data: { nip: nip },
        dataType: 'json',
        success: function(response) {
            Swal.close();
            if (response.status === 'success') {
                let data = response.data;
                
                if (data && data.eligible === true) {                    
                    $('a[href="#tab-form-peserta"]').tab('show');
                } else {
                     $('a[href="#tab-form-peserta"]').tab('hide');
                    let pesan = data && data.alasan ? data.alasan : 'Data TPP tidak memenuhi syarat.';
                    Swal.fire({
                        icon: 'warning',
                        title: 'Tidak Dapat Melanjutkan',
                        text: pesan,
                        confirmButtonText: 'OK'
                    });
                }
            } else {
                // Handle error jika status dari backend bukan success
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: response.message || 'Terjadi kesalahan pada sistem.',
                    confirmButtonText: 'OK'
                });
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            Swal.fire({
                icon: 'error',
                title: 'Server Error',
                text: 'Gagal menghubungi server: ' + errorThrown,
                confirmButtonText: 'OK'
            });
        }
    });
});

$('.btn-iuran').on('click', function(e) {
    e.preventDefault();
    let nip = '{$nipPegawai}';
    if (!nip) {
        Swal.fire('Error', 'NIP Pegawai tidak ditemukan.', 'error');
        return;
    }

    Swal.showLoading();
    $.ajax({
        url: '{$getPeserta}',
        type: 'GET',
        data: { nip: nip },
        dataType: 'json',
        success: function(response) {
            Swal.close();
            if (response.status === 'success') {
                let data = response.data;
                if (data !== null) {
                    $('#li-tab-iuran').show(); 

                    $('a[href="#tab-iuran"]').tab('show');
                } else {
                    $('#li-tab-iuran').hide(); 
                    let pesan = data && data.alasan ? data.alasan : 'Data peserta belum ditambahkan.';
                    Swal.fire({
                        icon: 'warning',
                        title: 'Tidak Dapat Melanjutkan',
                        text: pesan,
                        confirmButtonText: 'OK'
                    });
                }
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: response.message || 'Terjadi kesalahan pada sistem.',
                    confirmButtonText: 'OK'
                });
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            Swal.close();
            Swal.fire({
                icon: 'error',
                title: 'Server Error',
                text: 'Gagal menghubungi server: ' + errorThrown,
                confirmButtonText: 'OK'
            });
        }
    });
});

// --- HANDLE TOMBOL UPDATE (EDIT) ---
$(document).on('click', '.btn-update', function(e) {
    e.preventDefault();

    let idPeserta = $(this).data('id');

    if (!idPeserta) {
        Swal.fire('Error', 'ID Peserta tidak ditemukan.', 'error');
        return;
    }

    // Tampilkan tab form
    $('#li-tab-form-peserta').show();
    delete window.tabCache['form-peserta'];

    let formUrl = $('#btn-tab-form-peserta').data('url');

    window.loadTabContent(
        'form-peserta',
        formUrl + (formUrl.includes('?') ? '&' : '?') +
            'id=' + encodeURIComponent(idPeserta),
        function() {
            $('#btn-tab-form-peserta').tab('show');
        }
    );
});

// --- 2. HANDLE TOMBOL DELETE (HAPUS) ---
$(document).on('click', '.btn-delete', function(e) {
    e.preventDefault();
    let idPeserta = $(this).data('id');

    if (!idPeserta) {
        Swal.fire('Error', 'ID Peserta tidak ditemukan.', 'error');
        return;
    }

    // Konfirmasi SweetAlert sebelum hapus
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Data peserta tambahan ini akan dihapus permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.showLoading();

            $.ajax({
                url: '{$deleteUrl}',
                type: 'POST', 
                data: { id: idPeserta, _csrf: yii.getCsrfToken() },
                dataType: 'json',
                success: function (response) {
                    if (response.status === 'success' || response.status === true) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.message || 'Data peserta berhasil dihapus.',
                            confirmButtonText: 'OK'
                        }).then(function () {
                            // Hapus cache tab peserta agar tidak memakai HTML lama
                            delete window.tabCache['peserta'];

                            // Ambil NIP pegawai yang sedang dipilih
                            var pegawai = window.selectedPegawai || {};
                            var nip = pegawai.nip || '';

                            if (!nip) {
                                Swal.fire(
                                    'Peringatan',
                                    'NIP pegawai tidak ditemukan. Silakan pilih kembali pegawai.',
                                    'warning'
                                );
                                return;
                            }

                            // Muat ulang data peserta melalui controller Yii2
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
                        Swal.fire(
                            'Gagal',
                            response.message || 'Gagal menghapus data peserta.',
                            'error'
                        );
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    Swal.close();
                    Swal.fire('Server Error', 'Gagal menghubungi server.', 'error');
                }
            });
        }
    });
});

JS;
$this->registerJs($js);
?>