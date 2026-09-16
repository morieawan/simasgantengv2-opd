<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap4\Nav;
use app\widgets\Menu;

$sess = Yii::$app->session;
$items = [];

if($sess['module'] == 1){
  $items = [
    ['label' => 'Data Pribadi', 'url' => Url::to(['/data-pribadi']), 'icon' => 'fas fa-user'],
    ['label' => 'CPNS/ PNS/ PPPK', 'url' => Url::to(['/cpns-pns']), 'icon' => 'fas fa-file-alt'],
    ['label' => 'Riwayat Pangkat-Gol', 'url' => Url::to(['/rw-pangkat']), 'icon' => 'fas fa-crown'],
    ['label' => 'Riwayat Jabatan', 'url' => Url::to(['/rw-jabatan']), 'icon' => 'fas fa-star'],
    ['label' => 'Riwayat Pendidikan', 'url' => Url::to(['/rw-pendidikan']), 'icon' => 'fas fa-book-reader'],

  ];
}else if($sess['module'] == 2){
  $items = [
    ['label' => 'Presensi Harian', 'url' => Url::to(['/presensi']), 'icon' => 'fas fa-clock'],
    ['label' => 'Target Kinerja Harian', 'url' => Url::to(['/target-kinerja']), 'icon' => 'fas fa-sort-amount-up-alt'],
    ['label' => 'Realisasi Kinerja Harian', 'url' => Url::to(['/realisasi-kinerja']), 'icon' => 'fas fa-cogs'],
    ['label' => 'Penilaian Bawahan', 'url' => Url::to(['/penilaian-bawahan']), 'icon' => 'fas fa-check'],
  ];
}else if($sess['module'] == 6){
  $items = [
    ['label' => 'Data ASN', 'url' => Url::to(['/data-asn-pd']), 'icon' => 'fas fa-users'],
    ['label' => 'Presensi', 'icon' => 'fas fa-user-clock ', 'items' => [
      ['label' => 'Jadwal Kerja', 'url' => Url::to(['/jadwal-pd']), 'icon' => 'fas fa-clock'],
      ['label' => 'Presensi Kehadiran', 'url' => Url::to(['/presensi-pd']), 'icon' => 'fas fa-clock'],
      ['label' => 'Keterangan Absen', 'url' => Url::to(['/ket-absen']), 'icon' => 'fas fa-file-alt'],
    ]],   
    ['label' => 'Kinerja', 'url' => Url::to(['/kinerja-asn']), 'icon' => 'fas fa-user-cog'],
    ['label' => 'WFH', 'icon' => 'fas fa-home', 'items' => [
      ['label' => 'Daftar ASN WFH', 'url' => Url::to(['/data-asn-wfh']), 'icon' => 'fas fa-house-user'],
      ['label' => 'Hasil ASN WFH', 'url' => Url::to(['/hasil-wfh']), 'icon' => 'fas fa-user-check'],
      ['label' => 'Rekap Hasil WFH', 'url' => Url::to(['/rekap-wfh']), 'icon' => 'fas fa-laptop-house'],
    ]],   
    ['label' => 'TPP & Coretax', 'icon' => 'fas fa-money-check-alt', 'items' => [
      ['label' => 'Daftar Penerima TPP', 'url' => Url::to(['/penerima-tpp']), 'icon' => 'fas fa-list'],
      ['label' => 'Cetak TPP', 'url' => Url::to(['/cetak-tpp']), 'icon' => 'fas fa-money-bill'],
      ['label' => 'Coretax', 'url' => Url::to(['/coretax-search']), 'icon' => 'fas fa-money-bill-wave'],
      ['label' => 'Coretax Akhir', 'url' => Url::to(['/coretax-akhir-search']), 'icon' => 'fas fa-money-bill-wave'],
    ]], 
     ['label' => 'BPJS Tambahan', 'icon' => 'fas fa-stethoscope', 'items' => [
      ['label' => 'Data Peserta', 'url' => Url::to(['/bpjs-peserta']), 'icon' => 'fas fa-user-shield'],
      ['label' => 'Iuran Peserta', 'url' => Url::to(['/bpjs-iuran']), 'icon' => 'fas fa-money-bill-wave'],
    ]],   
    //['label' => 'Anomali Data', 'url' => Url::to(['/anomali']), 'icon' => 'fas fa-times-circle'],
  ];
}else if($sess['module'] == 8){
  $items = [
    ['label' => 'TPP Final', 'url' => Url::to(['/tpp-final-perbendaharaan']), 'icon' => 'fas fa-money-bill-wave'],
    ['label' => 'Coretax', 'url' => Url::to(['/coretax-perbendaharaan']), 'icon' => 'fas fa-money-bill'],
    ['label' => 'Coretax Akhir', 'url' => Url::to(['/coretax-akhir-perbendaharaan']), 'icon' => 'fas fa-money-bill-wave'],
  ];
}else if($sess['module'] == 9){
  $items = [
    ['label' => 'Data ASN UPT/ Korwil', 'url' => Url::to(['/data-asn-upt']), 'icon' => 'fas fa-users'],
    ['label' => 'Presensi & Kinerja', 'url' => Url::to(['/presensi-upt']), 'icon' => 'fas fa-clock'],
    ['label' => 'Penerima TPP', 'url' => Url::to(['/penerima-tpp-upt']), 'icon' => 'fas fa-list'],
    ['label' => 'Cetak TPP UPT/ Korwil', 'url' => Url::to(['/cetak-tpp-upt']), 'icon' => 'fas fa-print'],
  ];
}else if($sess['module'] == 12){
  $items = [
    ['label' => 'Data ASN', 'url' => Url::to(['/data-asn-opd']), 'icon' => 'fas fa-database'],
  ];

  //if(Yii::$app->request->get)
}

?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar elevation-4 sidebar-light-primary">
	<!-- Brand Logo -->
	  <a href="<?= Yii::$app->homeUrl; ?>" class="brand-link">
      <img src="<?= Yii::getAlias('@web')?>/brebes.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-dark"><?= ucwords(Html::encode(Yii::$app->name)); ?></span>
    </a>

	<!-- Sidebar -->
	<div class="sidebar">
		<!-- Sidebar Menu -->
		<nav class="mt-2">
      <?= Menu::widget([
					'options' => [
						'class' => 'nav nav-pills nav-sidebar flex-column',
						'data-widget' => 'treeview',
						'role' => 'menu',
						'style' => 'word-wrap : break-word;font-size:12pt;',
						'data-accordion' => true,
					],
					'items' => $items,
      ]);?>
		</nav>
	</div>

</aside>

<?php
$css = <<< CSS
.img {
      background:  #fcf3cf;
      position: relative;
      text-align: center;
      transform: rotate(10deg);

    }
.img2{     
      position: relative;
      text-align: center;
      transform: rotate(-10deg);

    }      
    
CSS;
$this->registerCss($css);
?>
