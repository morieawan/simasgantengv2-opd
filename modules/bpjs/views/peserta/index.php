<?php
use yii\helpers\Url;

$this->title = 'BPJS Anggota Keluarga Tambahan ';

$tabSearchUrl  = Url::to(['/bpjs/peserta/tab-search']);
$tabPesertaUrl = Url::to(['/bpjs/peserta/tab-peserta']);
$tabIuranUrl   = Url::to(['/bpjs/peserta/tab-iuran']);
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
JS;

$this->registerJs($script);
?>
