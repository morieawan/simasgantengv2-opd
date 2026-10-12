<?php
use yii\helpers\Url;

$this->title = 'BPJS Anggota Keluarga Tambahan ';

$tabSearchUrl  = Url::to(['/bpjs/peserta/tab-search']);
$tabPesertaUrl = Url::to(['/bpjs/peserta/tab-peserta']);
$tabIuranUrl   = Url::to(['/bpjs/peserta/tab-iuran']);
$tabFormPesertaUrl = Url::to(['/bpjs/peserta/tab-form-peserta']); 
$getGabunganUrl = Url::to(['/bpjs/peserta/get-gabungan-gaji-tpp']); 
// $nipPegawai = $pegawai['nip'] ?? ''; 

?>

<div class="card card-primary card-outline card-tabs">
    <div class="card-header p-0 pt-1 border-bottom-0">
        <ul class="nav nav-tabs" id="bpjs-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="btn-tab-search" data-toggle="pill" href="#tab-content" role="tab" data-url="<?= $tabSearchUrl ?>">
                    <i class="fas fa-search mr-1"></i> Cari Pegawai
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" id="btn-tab-peserta" data-toggle="pill" href="#tab-content" role="tab" data-url="<?= $tabPesertaUrl ?>">
                    <i class="fas fa-users mr-1"></i> Data Peserta
                </a>
            </li>
            <li class="nav-item" id="li-tab-form-peserta" style="display: none;">
                <a class="nav-link" 
                id="btn-tab-form-peserta" 
                data-toggle="pill" 
                href="#tab-content" 
                role="tab" 
                data-url="<?= $tabFormPesertaUrl ?>">
                <i class="fas fa-user-plus mr-1"></i> Input Peserta
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" id="btn-tab-iuran" data-toggle="pill" href="#tab-content" role="tab" data-url="<?= $tabIuranUrl ?>">
                    <i class="fas fa-file-invoice-dollar mr-1"></i> Iuran BPJS
                </a>
            </li>
        </ul>
    </div>
    
    <div class="card-body">
        <!-- Container Tempat Render Partial Views -->
        <div class="tab-content" id="main-bpjs-container">
            <div class="text-center p-4">
                <i class="fas fa-spinner fa-spin fa-2x text-primary"></i>
            </div>
        </div>
    </div>
</div>

<?php
$script = <<< JS
// Store State Pegawai Terpilih di Level Window (Global SPA State)
window.selectedPegawai = null;
window.lastSearchParams = {
    keyword: '',
    sub_lokasi: ''
};

// Cache untuk menyimpan HTML partial view yang sudah di-load
window.tabCache = {};

// Fungsi Render Partial View dengan Sistem Cache
window.loadTabContent = function(tabId, url, callback) {
    // Jika tab sudah ada di cache, tampilkan langsung tanpa AJAX request ulang
    if (window.tabCache[tabId]) {
        $('#main-bpjs-container').html(window.tabCache[tabId]);
        if (typeof callback === 'function') callback();
        return;
    }

    // Jika belum ada di cache, lakukan AJAX ke Yii2 Controller
    $('#main-bpjs-container').html('<div class="text-center p-4"><i class="fas fa-spinner fa-spin fa-2x text-primary"></i></div>');
    $.ajax({
        url: url,
        type: 'GET',
        success: function(html) {
            window.tabCache[tabId] = html; // Simpan HTML ke cache
            $('#main-bpjs-container').html(html);
            if (typeof callback === 'function') callback();
        },
        error: function() {
            $('#main-bpjs-container').html('<div class="alert alert-danger">Gagal memuat konten tab.</div>');
        }
    });
};

// Load Tab Search secara default saat halaman pertama kali dibuka
window.loadTabContent('search', '{$tabSearchUrl}');

// Switch Tab Listener
$('#bpjs-tab a[data-toggle="pill"]').on('click', function(e) {
    if ($(this).hasClass('disabled')) {
        e.preventDefault();
        return false;
    }
    
    let tabId = $(this).attr('id').replace('btn-tab-', ''); // Mengambil id tab (search, peserta, atau iuran)
    let url = $(this).data('url');
    
    window.loadTabContent(tabId, url);
});

// Buka akses tab lanjutan setelah pencarian pegawai berhasil
window.enableBpjsTabs = function(pegawaiData) {
    // Jika cari pegawai baru, bersihkan cache tab data peserta & iuran agar merender data pegawai baru
    delete window.tabCache['peserta'];
    delete window.tabCache['iuran'];

    window.selectedPegawai = pegawaiData;
    $('#btn-tab-peserta, #btn-tab-iuran').removeClass('disabled');
};

// $(document).on('click', '.btn-tambah-peserta', function(e) {
//     e.preventDefault();
//         $('#li-tab-form-peserta').show();
//         $('#btn-tab-form-peserta').trigger('click');
//     });
//     $(document).on('click', '#btn-tab-search, #btn-tab-peserta, #btn-tab-iuran', function() {
//         $('#li-tab-form-peserta').hide();
// });

// URL validasi kelayakan peserta
window.getGabunganUrl = '{$getGabunganUrl}';

// Tombol Tambah Peserta pada partial Data Peserta
$(document).on('click', '.btn-tambah-peserta', function(e) {
    e.preventDefault();

    let pegawai = window.selectedPegawai;

    if (!pegawai || !pegawai.nip) {
        Swal.fire(
            'Peringatan',
            'Silakan pilih pegawai terlebih dahulu.',
            'warning'
        );
        return;
    }

    // Tutup akses form sebelum melakukan validasi ulang.
    $('#li-tab-form-peserta').hide();

    Swal.fire({
        title: 'Memeriksa data penghasilan...',
        allowOutsideClick: false,
        allowEscapeKey: false,
        didOpen: function() {
            Swal.showLoading();
        }
    });

    $.ajax({
        url: window.getGabunganUrl,
        type: 'GET',
        data: {
            nip: pegawai.nip
        },
        dataType: 'json',

        success: function(response) {
            Swal.close();

            let data = response.data;

            if (
                response.status === 'success' &&
                data &&
                data.eligible === true
            ) {
                // Hapus cache form agar data pegawai selalu terbaru.
                delete window.tabCache['form-peserta'];

                // Tampilkan dan buka tab Input Peserta.
                $('#li-tab-form-peserta').show();
                $('#btn-tab-form-peserta').trigger('click');

            } else {
                let pesan = data && data.alasan
                    ? data.alasan
                    : (response.message ||
                    'Pegawai tidak memenuhi persyaratan.');

                Swal.fire({
                    icon: 'warning',
                    title: 'Tidak Dapat Melanjutkan',
                    text: pesan,
                    confirmButtonText: 'OK'
                });
            }
        },

        error: function(jqXHR, textStatus, errorThrown) {
            Swal.close();

            Swal.fire({
                icon: 'error',
                title: 'Server Error',
                text: 'Gagal memeriksa gaji dan penghasilan: ' + errorThrown,
                confirmButtonText: 'OK'
            });
        }
    });
});

// Form disembunyikan ketika berpindah ke tab lain.
$(document).on(
    'click',
    '#btn-tab-search, #btn-tab-peserta, #btn-tab-iuran',
    function() {
        $('#li-tab-form-peserta').hide();
    }
);

JS;

$this->registerJs($script);
?>
