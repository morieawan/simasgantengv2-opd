<?php
use yii\bootstrap4\Modal;
use yii\helpers\Url;

$this->title = 'BPJS Keluarga Tambahan';

?>

<!-- Load Alpine.js -->
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<div x-data="bpjsModule()" x-init="initApp()" class="container-fluid pt-3">

    <!-- Card AdminLTE dengan Tab Menu -->
    <div class="card card-primary card-outline card-outline-tabs">
        <div class="card-header p-0 border-bottom-0">
            <ul class="nav nav-tabs" id="bpjs-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" :class="{ 'active': currentTab === 'peserta' }" @click.prevent="switchTab('peserta')" href="#">
                        <i class="fas fa-users mr-1"></i> Data Peserta
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" :class="{ 'active': currentTab === 'iuran' }" @click.prevent="switchTab('iuran')" href="#">
                        <i class="fas fa-file-invoice mr-1"></i> Iuran BPJS
                    </a>
                </li>
            </ul>
        </div>
        
        <div class="card-body">
            <div class="tab-content">
                <!-- Indikator Loading -->
                <div x-show="loading" class="text-center py-5">
                    <div class="spinner-border text-primary" role="status">
                        <span class="sr-only">Memuat...</span>
                    </div>
                    <p class="mt-2 text-muted">Memuat data tab...</p>
                </div>

                <!-- Kontainer Dinamis Partial Views -->
                <div x-show="!loading" x-html="tabContent"></div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Global Modul BPJS -->
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
?>

<!-- Logic SPA via Alpine.js & JavaScript Global Helper -->
<script>
    function bpjsModule() {
        return {
            currentTab: 'peserta',
            loading: false,
            tabContent: '',

            initApp() {
                this.loadTabContent(this.currentTab);
            },

            switchTab(tabName) {
                if (this.currentTab !== tabName) {
                    this.currentTab = tabName;
                    this.loadTabContent(tabName);
                }
            },

            loadTabContent(tabName) {
                this.loading = true;
                // Menggunakan endpoint index masing-masing controller
                let url = '/bpjs/' + tabName + '/index'; 
                
                fetch(url, {
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                })
                .then(response => {
                    if (!response.ok) throw new Error('HTTP status ' + response.status);
                    return response.text();
                })
                .then(html => {
                    this.tabContent = html;
                    this.loading = false;
                })
                .catch(error => {
                    console.error('AJAX Load Error:', error);
                    this.tabContent = '<div class="alert alert-danger"><i class="fas fa-exclamation-triangle mr-1"></i> Gagal memuat konten. Pastikan URL endpoint sesuai.</div>';
                    this.loading = false;
                });
            },

            refreshCurrentTab() {
                this.loadTabContent(this.currentTab);
            }
        }
    }
</script>

<?php
// Skrip Helper Modal Global
$script = <<< JS
    window.openBpjsModal = function(title, url) {
        $('#modal-global-title').html(title);
        $('#modalGlobalContent').html('<div class="text-center p-4"><i class="fas fa-spinner fa-spin fa-2x"></i> Memuat data...</div>');
        $('#modal-global-bpjs').modal('show');

        if (url) {
            $.get(url, function(data) {
                $('#modalGlobalContent').html(data);
            }).fail(function() {
                $('#modalGlobalContent').html('<div class="alert alert-danger">Gagal memuat halaman form.</div>');
            });
        }
    };

    $('#modal-global-bpjs').on('hidden.bs.modal', function () {
        $('#modalGlobalContent').empty();
        $('.modal-backdrop').remove();
        $('body').removeClass('modal-open');
    });
JS;

$this->registerJs($script);
?>