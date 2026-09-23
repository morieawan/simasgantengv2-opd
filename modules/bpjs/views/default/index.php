<?php
use yii\bootstrap4\Modal;
use yii\helpers\Url;

$this->title = 'BPJS Anggota Keluarga Tambahan';
?>

<!-- Load Alpine.js -->
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<div x-data="bpjsModule()" x-init="initApp()" class="container-fluid pt-3">

    <!-- Card AdminLTE dengan Tab Menu -->
    <div class="card card-primary card-outline card-outline-tabs">
        <div class="card-header p-0 border-bottom-0">
            <ul class="nav nav-tabs" id="bpjs-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" 
                       :class="{ 'active': activeTab === 'peserta' }" 
                       @click.prevent="loadTab('peserta', '<?= Url::to(['/bpjs/peserta']) ?>')" 
                       href="#">
                        <i class="fas fa-users mr-1"></i> Data Peserta
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" 
                       :class="{ 'active': activeTab === 'iuran' }" 
                       @click.prevent="loadTab('iuran', '<?= Url::to(['/bpjs/iuran']) ?>')" 
                       href="#">
                        <i class="fas fa-file-invoice-dollar mr-1"></i> Iuran BPJS
                    </a>
                </li>
            </ul>
        </div>

        <div class="card-body">
            <!-- Indikator Loading -->
            <div x-show="loading" class="text-center py-5">
                <div class="spinner-border text-primary" role="status"></div>
                <p class="mt-2 text-muted">Memuat data...</p>
            </div>

            <!-- Pesan Kesalahan -->
            <div x-show="errorMessage" class="alert alert-danger" x-text="errorMessage"></div>

            <!-- Tempat Konten Partial View -->
            <div x-show="!loading && !errorMessage" x-html="tabContent"></div>
        </div>
    </div>

</div>

<script>
    
function bpjsModule() {
    
    return {
        activeTab: 'peserta',
        tabContent: '',
        loading: false,
        errorMessage: '',
        tabCache: {},

        initApp() {
            this.loadTab('peserta', '<?= Url::to(['/bpjs/peserta']) ?>');
        },

        async loadTab(tabName, url, forceRefresh = false) {
            this.activeTab = tabName;
            this.errorMessage = '';

            // Cek Cache
            if (this.tabCache[tabName] && !forceRefresh) {
                this.tabContent = this.tabCache[tabName];
                return;
            }

            this.loading = true;

            // Ambil CSRF Token dari Meta Tag Layout AdminLTE
            const csrfMeta = document.querySelector('meta[name="csrf-token"]');
            const csrfToken = csrfMeta ? csrfMeta.content : '';

            try {
                let response = await fetch(url, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-Token': csrfToken // Header Keamanan Tambahan
                    }
                });

                if (response.ok) {
                    let htmlData = await response.text();
                    this.tabCache[tabName] = htmlData;
                    this.tabContent = htmlData;
                } else {
                    this.errorMessage = `Gagal memuat konten (Error ${response.status})`;
                }
            } catch (error) {
                this.errorMessage = 'Terjadi kesalahan jaringan.';
            } finally {
                this.loading = false;
            }
        },
        
        refreshCurrentTab() {
            let url = this.activeTab === 'peserta' 
                ? '<?= Url::to(['/bpjs/peserta']) ?>' 
                : '<?= Url::to(['/bpjs/iuran']) ?>';

            this.loadTab(this.activeTab, url, true); 
        }
    }
}
</script>

<?php
    Modal::begin([
        'id' => 'modal-global-bpjs',
        'title' => '<span id="modal-global-title">Modal BPJS</span>',
        'headerOptions' => ['class' => 'bg-primary text-white'],
        'size' => Modal::SIZE_LARGE,
        'clientOptions' => ['backdrop' => 'static', 'keyboard' => false],
    ]);

    echo "<div id='modalGlobalContent'></div>";

    Modal::end();

    $script = <<< JS
    window.openBpjsModal = function(title, url) {
        $('#modal-global-title').html(title);
        $('#modalGlobalContent').html('<div class="text-center p-4"><i class="fas fa-spinner fa-spin fa-2x"></i> Memuat data...</div>');
        $('#modal-global-bpjs').modal('show');

        if (url) {
            $.get(url, function(data) {
                $('#modalGlobalContent').html(data);
            }).fail(function() {
                $('#modalGlobalContent').html('<div class="alert alert-danger">Gagal memuat halaman.</div>');
            });
        }
    };

    // Reset konten saat modal ditutup
    $('#modal-global-bpjs').on('hidden.bs.modal', function () {
        $('#modalGlobalContent').empty();
        $('.modal-backdrop').remove();
        $('body').removeClass('modal-open');
    });

    JS;
    $this->registerJs($script);
?>