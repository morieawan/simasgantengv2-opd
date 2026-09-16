<?php

use yii\helpers\Html;
use yii\helpers\Json;
use yii\bootstrap4\Modal;
use app\models\Angka;

/* @var $this yii\web\View */
/* @var $model app\modules\tpp\models\TppHitung */

$this->title = 'Cetak TPP';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="tpp-hitung-cetak" style="font-family: Arial, Helvetica, sans-serif; font-size: 11px;">
<p style="page-break-after:always">
<?php 
  foreach($data as $dt){
	  
?>
<div class="preskin-tpp-hitung-index">
    <?= '<h6><b>DAFTAR PENERIMAAN TAMBAHAN PENGHASILAN PEGAWAI (TPP)</b><br>' ?>
    <?= '<b>'.$dt['opd_nama'].'</b><br>' ?>
    <?= '<b>'.strtoupper($dt['bulan_huruf'])." ".$dt['tahun'].'</b></h6>' ?>
    <?= Html::a('<i class="fas fa-search"></i> Cari Data', '#', ['title' => 'Cari Data', 'class' => 'btn-sm btn-danger float-right mb-2', 'id' => 'search']); ?>
</div>

<table width="100%" style="font-size: 11px;" class="table table-stiped table-hover" border="1">
  <thead>
    <tr align="center">
      <th width="3%" rowspan="3" style="vertical-align:middle; background-color:#dc3545; color:#ffffff;">NO</th>
      <th width="25%" rowspan="3" style="vertical-align:middle; background-color:#dc3545; color:#ffffff;">
		    NIP<br>
        NAMA<br>
        GOL<br>
        JABATAN<br>
		    KELAS JABATAN
		</th>
      <th width="7%" rowspan="3" style="vertical-align:middle; background-color:#dc3545; color:#ffffff;">PAGU TPP</th>
      <th width="8%" rowspan="3" style="vertical-align:middle; background-color:#dc3545; color:#ffffff;">BEBAN KERJA 70%
        <hr size="1px" color="#000000">
        PRESTASI KERJA 30%</td>
      <th colspan="3" style="vertical-align:middle; background-color:#dc3545; color:#ffffff;">PRESTASI KERJA 30%</th>
      <th width="5%" rowspan="3" style="vertical-align:middle; background-color:#dc3545; color:#ffffff;">HUKDIS</th>
      <th width="8%" rowspan="3" style="vertical-align:middle; background-color:#dc3545; color:#ffffff;">TPP PEGAWAI<br>
        BPJS 4%<br>
        JUMLAH KOTOR</td>
      <th width="8%" rowspan="3" style="vertical-align:middle; background-color:#dc3545; color:#ffffff;">BPJS 4%<br>
        BPJS 1%<br>
        PPH<br>
        JUMLAH POT<br>
        JUMLAH NET</th>
      <th width="8%" rowspan="3" style="vertical-align:middle; background-color:#dc3545; color:#ffffff;">TPP DITERIMA</th>
    </tr>
    <tr align="center">
      <th  width="9%" rowspan="2" style="vertical-align:middle; background-color:#dc3545; color:#ffffff;">DISIPLIN KERJA<br>
        (40%)</th>
      <th colspan="2" style="vertical-align:middle; background-color:#dc3545; color:#ffffff;">PRODUKTIVITAS KERJA<br>
        (60%)</th>
    </tr>
    <tr align="center">
      <th width="9%" style="vertical-align:middle; background-color:#dc3545; color:#ffffff;">KINERJA</th>
      <th width="7%" style="vertical-align:middle; background-color:#dc3545; color:#ffffff;">SAKIP</th>
    </tr>
  </thead>
  <tbody>
	<?php
			//awal loop per golongan
      $tdj_asn = 0;
      $tdj_pagu = 0;
      $tdj_beban = 0;
      $tdj_prestasi = 0;
      $tdj_kinerja = 0;
      $tdj_presensi = 0;
      $tdj_sakip = 0;
      $tdj_rb = 0;
      $tdj_cuti = 0;
      $tdj_hukdis = 0;
      $tdj_tgr = 0;
      $tdj_total = 0;
      $tdj_bpjs4 = 0;
      $tdj_bpjs1 = 0;
      $tdj_bruto = 0;
      $tdj_pph = 0;
      $tdj_pot = 0;
      $tdj_net = 0;

      foreach($dt['detail'] as $dtl){
        
        if($dtl['dj_asn'] != 0){
          //awal loop per asn
          foreach($dtl['rinci'] as $rin){
            $prestasi = $rin['prestasi_kerja'];
            $pres_pagu = round($prestasi * 0.4,0);
            $kin_pagu = round(($prestasi - $pres_pagu) * 0.9,0);
	?>
    <tr>
      <td valign="top" align="center"><?= $rin['nd'] ?></td>
      <td valign="top">
        <?= $rin['nip'] ?><br>
        <?= $rin['nama'] ?><br>
        <?= $rin['nama_gol'] ?><br>
        <?= $rin['nama_jab'] ?><br>
        <?= $rin['kelasjab'] ?>
      </td>
      <td align="right" valign="top"><?= Angka::Ribuan($rin['pagu_tpp']) ?></td>
      <td align="right" valign="top">
        <?= Angka::Ribuan($rin['beban_kerja']) ?><hr>
        <?= Angka::Ribuan($rin['prestasi_kerja']) ?>
      </td>
      <td align="right" valign="top">
        <?= $rin['presensi'] ?>% X <?= Angka::Ribuan($pres_pagu) ?><br>
        = <?= Angka::Ribuan($rin['presensi_rp']) ?>      </td>
      <td align="right" valign="top"><?= $rin['kinerja'] ?>
        % X
        <?= Angka::Ribuan($kin_pagu) ?>
        <br>
        =
  <?= Angka::Ribuan($rin['kinerja_rp']) ?></td>
      <td align="right" valign="top">
		  <?= Angka::Ribuan($rin['sakip_rp']) ?>
		</td>
      <td align="right" valign="top">
        <?= Angka::Ribuan($rin['hukdis_rp']) ?>
      </td>
      <td align="right" valign="top">
        <?= Angka::Ribuan($rin['tpp_jumlah']) ?><br>
        <?= Angka::Ribuan($rin['bpjs4']) ?><br>
        <?= Angka::Ribuan($rin['tpp_bruto']) ?>
      </td>
      <td align="right" valign="top">
        <?= Angka::Ribuan($rin['bpjs4']) ?><br>
        <?= Angka::Ribuan($rin['bpjs1']) ?><br>
        <?= Angka::Ribuan($rin['pph_rp']) ?><br>
        <?= Angka::Ribuan($rin['pot_jml']) ?><hr>
        <b><?= Angka::Ribuan($rin['tpp_net']) ?></b>
      </td>
      <td align="right" valign="top">
        <b style="font-size: 12px;"><?= Angka::Ribuan($rin['tpp_net']) ?></b>
        <div class="dropdown">
          <button class="btn-sm btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Aksi
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <?= Html::a('Final',['finalisasi', 'id' => $rin['id']],['class' => 'dropdown-item']);?>
          </div>
        </div>
      </td>
    </tr>
    <?php }}} ?>
  </tbody>
</table>
<?php } ?>
</div>

<div id="cari-block" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
            <h5 class="modal-title">Cari Data</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <?php //echo $this->render('_search-tpp', ['model' => $rin, 'opd' => $opdlist]); ?>
            </div>
        </div>
    </div>
</div>

<?php
    Modal::begin([
        'title' => Html::encode($this->title),
        'headerOptions' => ['class' => 'bg-primary'],
        'id' => 'modal',
        'size' => 'modal-lg',
    ]);

    echo "<div id='modalContent'></div>";
    Modal::end();


$script = <<< JS

$('#search').click(function(){
	$("#cari-block").modal('show');
});
JS;
$this->registerJs($script);
?>