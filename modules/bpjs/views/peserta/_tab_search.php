<?php
use yii\helpers\Url;

$searchPegawaiUrl = Url::to(['/bpjs/peserta/search-pegawai']);
$tabPesertaUrl   = Url::to(['/bpjs/peserta/tab-peserta']);
?>

<!-- Form Filter Pencarian -->
<div class="card card-outline card-info">
    
    <div class="card-body">
        <form id="form-search-pegawai" class="row">
            <input type="hidden" name="kode_lokasi" value="<?= $sess['tablok'] ?? '' ?>">
            
            <div class="col-md-4 form-group mb-2">
                <input type="text" class="form-control" id="search_keyword" name="keyword" placeholder="Ketik NIP atau Nama Pegawai..." required>
            </div>
            <div class="col-md-4 form-group mb-2">
                <input type="text" class="form-control" id="search_sub_lokasi" name="sub_lokasi" placeholder="Sub Lokasi (opsional)">
            </div>
            <div class="col-md-4 form-group mb-2">
                <button type="submit" class="btn btn-primary btn-block">
                    <i class="fas fa-search mr-1"></i> Cari Pegawai
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Tabel Hasil Pencarian Pegawai -->
<div class="card card-outline card-secondary" id="card-hasil-pencarian" style="display: none;">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-list mr-1"></i> Hasil Pencarian Pegawai</h3>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover mb-0" id="table-hasil-pegawai">
                <thead class="thead-light">
                    <tr>
                        <th width="5%" class="text-center">No</th>
                        <th width="20%">NIP</th>
                        <th width="30%">Nama ASN</th>
                        <th width="30%">Sub Lokasi / Unit</th>
                        <th width="15%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="tbody-hasil-pegawai">
                    <!-- Data hasil pencarian di-render via JS -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // 1. Mempertahankan input pencarian jika sudah pernah dicari sebelumnya
    if (window.lastSearchParams) {
        $('#search_keyword').val(window.lastSearchParams.keyword);
        $('#search_sub_lokasi').val(window.lastSearchParams.sub_lokasi);
    }

    // Restore hasil pencarian jika sebelumnya sudah ada data pencarian di memori SPA
    if (window.lastSearchResults && window.lastSearchResults.length > 0) {
        renderTabelPegawai(window.lastSearchResults);
    }

    // 2. Handler Submit Form Pencarian
    $('#form-search-pegawai').off('submit').on('submit', function(e) {
        e.preventDefault();
        let formData = $(this).serialize();

        window.lastSearchParams.keyword = $('#search_keyword').val();
        window.lastSearchParams.sub_lokasi = $('#search_sub_lokasi').val();

        $.ajax({
            url: '<?= $searchPegawaiUrl ?>',
            type: 'GET',
            data: formData,
            dataType: 'json',
            beforeSend: function() {
                $('#form-search-pegawai button[type="submit"]')
                    .prop('disabled', true)
                    .html('<i class="fas fa-spinner fa-spin mr-1"></i> Mencari...');
            },
            success: function(res) {
                if (res.status === 'success' && res.data && res.data.length > 0) {
                    // Pastikan data dipastikan dalam bentuk Array (bisa 1 atau banyak record)
                    let listPegawai = Array.isArray(res.data) ? res.data : [res.data];
                    
                    window.lastSearchResults = listPegawai;
                    renderTabelPegawai(listPegawai);

                    Swal.fire({
                        icon: 'success',
                        title: 'Pencarian Berhasil',
                        text: 'Ditemukan \${listPegawai.length} data pegawai.',
                        timer: 1500,
                        showConfirmButton: false
                    });
                } else {
                    $('#card-hasil-pencarian').slideUp();
                    window.lastSearchResults = null;

                    Swal.fire({
                        icon: 'warning',
                        title: 'Data Tidak Ditemukan',
                        text: res.message || 'Tidak ada data pegawai yang sesuai dengan kata kunci tersebut.',
                        confirmButtonColor: '#3085d6'
                    });
                }
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Koneksi Error',
                    text: 'Gagal terhubung ke server BFF Yii2.',
                    confirmButtonColor: '#d33'
                });
            },
            complete: function() {
                $('#form-search-pegawai button[type="submit"]')
                    .prop('disabled', false)
                    .html('<i class="fas fa-search mr-1"></i> Cari Pegawai');
            }
        });
    });

    // 3. Fungsi Render Baris Tabel Hasil Pencarian
    function renderTabelPegawai(dataList) {
        let html = '';
        dataList.forEach((item, index) => {
            let unit = item.nama_unor || item.tablokb || item.nama_opd || '-';
            
            // Encode data pegawai ke JSON String agar aman dikirim via atribut HTML
            let jsonString = JSON.stringify(item).replace(/'/g, "&apos;");

            html += `
                <tr>
                    <td class="text-center" align="center">\${index + 1}</td>
                    <td><strong>\${item.nip}</strong></td>
                    <td>\${item.nama}</td>
                    <td>\${unit}</td>
                    <td class="text-center" align="center">
                        <button type="button" class="btn btn-xs btn-success btn-pilih-pegawai" data-pegawai='\${jsonString}'>
                            Kelola Data Peserta <i class="fas fa-arrow-right ml-1"></i>
                        </button>
                    </td>
                </tr>
            `;
        });

        $('#tbody-hasil-pegawai').html(html);
        $('#card-hasil-pencarian').slideDown();
    }

    // 4. Handler Klik Tombol "Kelola Data Peserta" di Kolom Aksi
    $(document).off('click', '.btn-pilih-pegawai').on('click', '.btn-pilih-pegawai', function() {
        let pegawaiData = $(this).data('pegawai');

        // Buka akses & arahkan langsung ke Tab Data Peserta
        window.enableBpjsTabs(pegawaiData);
        $('#btn-tab-peserta').tab('show');
        window.loadTabContent('peserta', '<?= $tabPesertaUrl ?>');
    });
});
</script>