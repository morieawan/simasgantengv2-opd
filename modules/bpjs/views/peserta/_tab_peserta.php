<?php
use yii\helpers\Html;
use yii\helpers\Url;

$createUrl  = Url::to(['/bpjs/peserta/create']);

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
        <div class="panel-heading" style="background-color: #f8f9fa; font-weight: bold; font-size: 13px; padding: 10px 15px;">
            <i class="fa fa-users text-primary"></i> Data Peserta Utama (Simgaji)
            <?php if (!empty($pegawai)): ?>
                <span class="text-muted" style="font-weight: normal; font-size: 13px;">
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
            <div class="pull-left" style="font-weight: bold; font-size: 14px; line-height: 32px;">
                <i class="fa fa-user-plus text-success"></i> Data Peserta BPJS Tambahan
            </div>
            <div class="pull-right">
                <button class="btn btn-sm btn-success" id="btn-tambah-peserta" data-nip="<?= Html::encode($pegawai['nip'] ?? $nip ?? '') ?>">
                    <i class="fa fa-plus"></i> Tambah Peserta
                </button>
            </div>
        </div>
        <div class="panel-body padding-0" style="padding: 0;">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover mb-0" style="margin-bottom: 0; font-size: 12px;">
                    <thead style="background-color: #f1f3f5;">
                        <tr>
                            <th class="text-center" style="width: 40px;">No</th>
                            <th class="text-center" style="width: 140px;">NIK</th>
                            <th class="text-center" style="width: 140px;">No. KK</th>
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
                                    <td class="text-center"><?= Html::encode($row['no_kk'] ?? '-') ?></td>
                                    <td><strong><?= Html::encode($row['nama_peserta'] ?? '-') ?></strong></td>
                                    <td class="text-center"><?= !empty($row['tgl_lahir']) ? Html::encode(date('d-m-Y', strtotime($row['tgl_lahir']))) : '-' ?></td>
                                    <td class="text-center">
                                        <span class="label label-default" style="font-size: 11px;">
                                            <?= Html::encode($row['nama_hubkel'] ?? $row['hubkel'] ?? '-') ?>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <?php if (isset($row['aktif']) && $row['aktif'] == 1): ?>
                                            <span class="label label-success" style="font-size: 10px;">Aktif</span>
                                        <?php else: ?>
                                            <span class="label label-danger" style="font-size: 10px;">Non-Aktif</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-xs btn-primary btn-edit" data-id="<?= Html::encode($row['id_peserta'] ?? '') ?>" title="Edit">
                                            <i class="fa fa-pencil"></i>
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
<!-- Container Modal Global (jika belum ada di layout) -->
<div class="modal fade" id="modal-global-bpjs" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" style="font-weight:bold;"><i class="fa fa-user-plus"></i> Tambah Data Peserta</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal-body-content">
                <!-- File _form.php akan di-render di sini via AJAX -->
            </div>
        </div>
    </div>
</div>

<script>
(function($) {
    'use strict'; // 1. Aktifkan Strict Mode untuk mencegah kesalahan penulisan skrip

    // 2. URL aman menggunakan Json::encode untuk menghindari XSS pada JavaScript
    var createUrl = <?= \yii\helpers\Json::encode(\yii\helpers\Url::to(['/bpjs/peserta/create'])) ?>;

    // 3. Matikan handler lama (.off) sebelum mendaftarkan handler baru (.on)
    $(document).off('click', '#btn-tambah-peserta').on('click', '#btn-tambah-peserta', function(e) {
        e.preventDefault();

        var $btn = $(this);
        var nip = $btn.data('nip');

        if (!nip) {
            alert('NIP Pegawai belum dipilih.');
            return;
        }

        // Tampilkan Loading Indicator di Modal
        $('#modal-body-content').html(
            '<div class="text-center p-5" style="padding: 40px;">' +
            '<i class="fa fa-spinner fa-spin fa-2x text-primary"></i>' +
            '<p style="margin-top: 10px;">Memuat form tambah peserta...</p>' +
            '</div>'
        );

        $('#modal-global-bpjs').modal('show');

        // Request AJAX
        $.ajax({
            url: createUrl,
            type: 'GET',
            data: { nip: nip },
            cache: false, // Hindari caching AJAX browser
            success: function(response) {
                $('#modal-body-content').html(response);
            },
            error: function(xhr, status, error) {
                $('#modal-global-bpjs').modal('hide');
                alert('Gagal memuat form: ' + (xhr.responseJSON?.message || error));
            }
        });
    });
})(jQuery);
</script>