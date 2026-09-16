<?php

use yii\helpers\Html;
use yii\helpers\Json;
use app\models\Angka;

/* @var $this yii\web\View */
/* @var $model app\modules\tpp\models\TppHitung */

$this->title = 'Cetak TPP';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="tpp-hitung-cetak" style="font-family: Arial, Helvetica, sans-serif; font-size: 11px;">
<p>
<?php 
  foreach($data as $dt){
	  
?>
<table cellspacing="0" cellpadding="0" border="0" width="100%" style="font-family: Arial, Helvetica, sans-serif; font-size: 11px;">
  <tbody>
    <tr>
      <td align="center"><strong>REKAP PENERIMAAN TAMBAHAN PENGHASILAN PEGAWAI (TPP)</strong></td>
    </tr>
    <tr>
      <td align="center"><strong>BERDASARKAN BEBAN KERJA</strong></td>
    </tr>
    <tr>
      <td align="center">
      <strong><?= $dt['opd_nama'] ?><strong></td>
    </tr>
    <tr>
      <td align="center">
      <strong><?= strtoupper($dt['bulan_huruf'])." ".$dt['tahun'] ?> </strong></td>
    </tr>
  </tbody>
</table>
<br>
<table cellspacing="0" cellpadding="5" border="1" width="100%" style="font-family: Arial, Helvetica, sans-serif; font-size: 11px;">
  <thead>
    <tr>
      <td align="center" width="3%" rowspan="3">NO</td>
      <td align="center" width="15%" rowspan="3">GOLONGAN</td>
      <td align="center" width="8%" rowspan="3">JUMLAH PNS</td>
      <td align="center" width="8%" rowspan="3">PAGU TPP</td>
      <td align="center" width="8%" rowspan="3">
        BEBAN KERJA 70%
        <div align='center'>--------------------</div>
        PRESTASI KERJA 30%</td>
      <td align="center" colspan="3">PRESTASI KERJA 30%</td>
      <td align="center" width="7%" rowspan="3">HUKDIS</td>
      <td align="center" width="8%" rowspan="3">TPP PEGAWAI<br>
        BPJS 4%<br>
        JUMLAH KOTOR</td>
      <td align="center" width="8%" rowspan="3">BPJS 4%<br>
        BPJS 1%<br>
        PPH<br>
        JUMLAH POT<br>
        JUMLAH NET</td>
      <td align="center" width="10%" rowspan="3">TPP
        DITERIMA</td>
    </tr>
    <tr>
      <td align="center" width="8%" rowspan="2">DISIPLIN<br>KERJA 40%</td>
      <td align="center" colspan="2">PRODUKTIVITAS<br>KERJA 60%</td>
      </tr>
    <tr>
      <td align="center" width="8%">KINERJA</td>
      <td align="center" width="8%">SAKIP</td>
    </tr>
  </thead>
	
  <tbody>
	  <?php 
		$tpegawai = 0 ;
		$tpagu = 0;
		$tbeban = 0;
		$tprod = 0;
		$tkin = 0;
		$tpres = 0;
		$tsak = 0;
		$trb = 0;
		$tcuti = 0;
		$thukdis = 0;
		$ttpp_tot = 0;
		$tbpjs4 = 0;
		$tbpjs1 = 0;
		$tpph = 0;
		$ttpp_bruto = 0;
		$tpot = 0;
		$ttpp_net = 0;

		foreach($dt['rekap'] as $rk){ 
	  ?>
    <tr>
      <td align="center"><?= $rk['no'] ?></td>
      <td align="center">JUMLAH GOLONGAN <?= $rk['grum'] ?></td>
      <td align="center"><?= $rk['jml_pegawai'] ?></td>
      <td align="right" valign="top"><?= Angka::Ribuan($rk['jml_pagu_tpp']) ?></td>
      <td align="right" valign="top">
        <?= Angka::Ribuan($rk['jml_beban_kerja']) ?>
        <div align='center'>--------------------</div>
        <?= Angka::Ribuan($rk['jml_prod_kerja']) ?></td>
      <td align="right" valign="top"><?= Angka::Ribuan($rk['jml_presensi_rp']) ?></td>
      <td align="right" valign="top"><?= Angka::Ribuan($rk['jml_kinerja_rp']) ?></td>
      <td align="right" valign="top">
        <?= Angka::Ribuan($rk['jml_sakip_rp']) ?></td>
      <td align="right" valign="top">
        <?= Angka::Ribuan($rk['jml_hukdis_rp']) ?>
      </td>
      <td align="right" valign="top">
        <?= Angka::Ribuan($rk['jml_tpp_total']) ?><br>
        <?= Angka::Ribuan($rk['jml_bpjs4']) ?><br>
        <?= Angka::Ribuan($rk['jml_tpp_bruto']) ?>
      </td>
      <td align="right" valign="top">
        <?= Angka::Ribuan($rk['jml_bpjs4']) ?><br>
        <?= Angka::Ribuan($rk['jml_bpjs1']) ?><br>
        <?= Angka::Ribuan($rk['jml_pph_rp']) ?><br>
        <?= Angka::Ribuan($rk['jml_pot_jml']) ?><div align='center'>--------------------</div>
        <strong><?= Angka::Ribuan($rk['jml_tpp_net']) ?></strong>
      </td>
      <td align="right" valign="top" style="font-size: 12px;">
        <strong><?= Angka::Ribuan($rk['jml_tpp_net']) ?></strong>
      </td>
    </tr>
	  <?php 
        $tpegawai = $tpegawai + $rk['jml_pegawai'];
        $tpagu = $tpagu + $rk['jml_pagu_tpp'];
        $tbeban = $tbeban + $rk['jml_beban_kerja'];
        $tprod = $tprod + $rk['jml_prod_kerja'];
        $tkin = $tkin + $rk['jml_kinerja_rp'];
        $tpres = $tpres + $rk['jml_presensi_rp'];
        $tsak = $tsak + $rk['jml_sakip_rp'];
        $trb = $trb + $rk['jml_rb_rp'];
        $tcuti = $tcuti + $rk['jml_cuti_rp'];
        $thukdis = $thukdis + $rk['jml_hukdis_rp'];
        $ttpp_tot = $ttpp_tot + $rk['jml_tpp_total'];
        $tbpjs4 = $tbpjs4 + $rk['jml_bpjs4'];
        $tbpjs1 = $tbpjs1 + $rk['jml_bpjs1'];
        $tpph = $tpph + $rk['jml_pph_rp'];
        $ttpp_bruto = $ttpp_bruto + $rk['jml_tpp_bruto'];
        $tpot = $tpot + $rk['jml_pot_jml'];
        $ttpp_net = $ttpp_net + $rk['jml_tpp_net']; 
      }  
    ?>
    <tr>
      <td>&nbsp;</td>
      <td align="center">JUMLAH TOTAL</td>
      <td align="center"><?= Angka::Ribuan($tpegawai) ?></td>
      <td align="right" valign="top"><?= Angka::Ribuan($tpagu) ?></td>
      <td align="right" valign="top">
        <?= Angka::Ribuan($tbeban)
          ."<div align='center'>--------------------</div>".
        Angka::Ribuan($tprod) ?>
      </td>
      <td align="right" valign="top"><?= Angka::Ribuan($tpres) ?></td>
      <td align="right" valign="top"><?= Angka::Ribuan($tkin) ?></td>
      <td align="right" valign="top"><?= Angka::Ribuan($tsak) ?></td>
      <td align="right" valign="top"><?= Angka::Ribuan($thukdis) ?></td>
      <td align="right" valign="top">
        <?= Angka::Ribuan($ttpp_tot)."<br>".
          Angka::Ribuan($tbpjs4)."<br>".
          Angka::Ribuan($ttpp_bruto)."<br>";
        ?>
      </td>
      <td align="right" valign="top">
        <?= Angka::Ribuan($tbpjs4)."<br>".
          Angka::Ribuan($tbpjs1)."<br>".
          Angka::Ribuan($tpph)."<br>".
          Angka::Ribuan($tpot)."<div align='center'>--------------------</div><b>".
          Angka::Ribuan($ttpp_net)."</b>";
        ?>
      </td>
      <td align="right" valign="top" style="font-size: 12px;"><?= "<b>".Angka::Ribuan($ttpp_net)."</b>" ?></td>
    </tr>
  </tbody>
</table>
<br>
<table cellspacing="0" border="0" width="100%" style="font-family: Arial, Helvetica, sans-serif; font-size: 11px;">
  <tbody>
    <tr>
      <td align="center" width="50%">Mengetahui<br>
        Pengguna Anggaran<br>
        <br>
        <br>
        <br>
        <br>
        NIP. ___________________________</td>
      <td align="center" width="50%">Brebes, ________________________________<br>
        Bendahara Gaji<br>
        <br>
        <br>
        <br>
        <br>
        NIP. ___________________________</td>
    </tr>
  </tbody>
</table>
</p>
<br>
<p style="page-break-after:always">
<table cellspacing="0" cellpadding="0" border="0" width="100%" style="font-family: Arial, Helvetica, sans-serif; font-size: 11px;">
  <tbody>
    <tr>
      <td align="center"><strong>DAFTAR PENERIMAAN TAMBAHAN PENGHASILAN PEGAWAI (TPP)</strong></td>
    </tr>
    <tr>
      <td align="center"><strong>BERDASARKAN BEBAN KERJA</strong></td>
    </tr>
    <tr>
      <td align="center" >
        <strong><?= $dt['opd_nama'] ?></strong>
      </td>
    </tr>
    <tr>
      <td align="center" ><strong><?= strtoupper($dt['bulan_huruf'])." ".$dt['tahun'] ?> </strong></td>
    </tr>
  </tbody>
</table>
<br>
<table cellspacing="0" cellpadding="5" border="1" width="100%" style="font-family: Arial, Helvetica, sans-serif; font-size: 11px;">
  <thead>
    <tr>
      <td align="center" width="3%" rowspan="3">NO</td>
      <td align="center" width="25%" rowspan="3">
		    NIP<br>
        NAMA<br>
        GOL<br>
        JABATAN<br>
		    KELAS JABATAN
		</td>
      <td align="center" width="7%" rowspan="3">PAGU TPP</td>
      <td align="center" width="8%" rowspan="3">BEBAN KERJA 70%
      <div align="center">------------------</div>
        PRESTASI KERJA 30%</td>
      <td align="center" colspan="3">PRESTASI KERJA 30%</td>
      <td align="center" width="5%" rowspan="3">HUKDIS</td>
      <td align="center" width="8%" rowspan="3">TPP PEGAWAI<br>
        BPJS 4%<br>
        JUMLAH KOTOR</td>
      <td align="center" width="8%" rowspan="3">BPJS 4%<br>
        BPJS 1%<br>
        PPH<br>
        JUMLAH POT<br>
        JUMLAH NET</td>
      <td align="center" width="8%" rowspan="3">TPP DITERIMA<br>
        TANDA TANGAN</td>
    </tr>
    <tr>
      <td align="center" width="9%" rowspan="2">DISIPLIN KERJA<br>
        (40%)</td>
      <td align="center" colspan="2">PRODUKTIVITAS KERJA<br>
        (60%)</td>
    </tr>
    <tr>
      <td align="center" width="9%">KINERJA</td>
      <td align="center" width="7%">SAKIP</td>
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
        <?= Angka::Ribuan($rin['beban_kerja']) ?><div align="center">------------------</div>
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
        <?= Angka::Ribuan($rin['pot_jml']) ?><div align="center">------------------</div>
        <b><?= Angka::Ribuan($rin['tpp_net']) ?></b>
      </td>
      <td align="right" valign="top">
        <b style="font-size: 12px;"><?= Angka::Ribuan($rin['tpp_net']) ?></b>
        <br>
        <br>
        <br>
        <br>
        <div align="left"><?= $rin['nd'] ?> ....................<div>
      </td>
    </tr>
      <?php }}?>
    <tr>
      <td align="center">&nbsp;</td>
      <td align="center">JUMLAH GOLONGAN <?= $dtl['gdrum']." : ".$dtl['dj_asn'] ?></td>
      <td align="right" valign="top"><?= Angka::Ribuan($dtl['dj_pagu']) ?></td>
      <td align="right" valign="top">
        <?= Angka::Ribuan($dtl['dj_beban']) ?>
        <div align='center'>--------------------</div>
        <?= Angka::Ribuan($dtl['dj_prestasi']) ?>
      </td>
      <td align="right" valign="top"><?= Angka::Ribuan($dtl['dj_presensi']) ?></td>
      <td align="right" valign="top"><?= Angka::Ribuan($dtl['dj_kinerja']) ?></td>
      <td align="right" valign="top">
		<?= Angka::Ribuan($dtl['dj_sakip']) ?></td>
      <td align="right" valign="top">
        <?= Angka::Ribuan($dtl['dj_hukdis']) ?>
      </td>
      <td align="right" valign="top">
        <?= Angka::Ribuan($dtl['dj_total']) ?><br>
        <?= Angka::Ribuan($dtl['dj_bpjs4']) ?><br>
        <?= Angka::Ribuan($dtl['dj_bruto']) ?>
      </td>
      <td align="right" valign="top">
        <?= Angka::Ribuan($dtl['dj_bpjs4']) ?><br>
        <?= Angka::Ribuan($dtl['dj_bpjs1']) ?><br>
        <?= Angka::Ribuan($dtl['dj_pph']) ?><br>
        <?= Angka::Ribuan($dtl['dj_pot']) ?><br>
        <div align='center'>------------------</div><br>
        <b><?= Angka::Ribuan($dtl['dj_net']) ?></b>
      </td>
      <td align="right" valign="top" style="font-size: 12px;">
        <b><?= Angka::Ribuan($dtl['dj_net']) ?></b>
      </td>
    </tr>
	  <?php 
      $tdj_pagu = $tdj_pagu + $dtl['dj_pagu'];
      $tdj_asn = $tdj_asn + $dtl['dj_asn'];
      $tdj_beban = $tdj_beban + $dtl['dj_beban'];
      $tdj_prestasi = $tdj_prestasi + $dtl['dj_prestasi'];
      $tdj_kinerja = $tdj_kinerja + $dtl['dj_kinerja'];
      $tdj_presensi = $tdj_presensi + $dtl['dj_presensi'];
      $tdj_sakip = $tdj_sakip + $dtl['dj_sakip'];
      $tdj_rb = $tdj_rb + $dtl['dj_rb'];
      $tdj_cuti = $tdj_cuti + $dtl['dj_cuti'];
      $tdj_hukdis = $tdj_hukdis + $dtl['dj_hukdis'];
      $tdj_tgr = $tdj_tgr + $dtl['dj_tgr'];
      $tdj_total = $tdj_total + $dtl['dj_total'];
      $tdj_bpjs4 = $tdj_bpjs4 + $dtl['dj_bpjs4'];
      $tdj_bpjs1 = $tdj_bpjs1 + $dtl['dj_bpjs1'];
      $tdj_bruto = $tdj_bruto + $dtl['dj_bruto'];
      $tdj_pph = $tdj_pph + $dtl['dj_pph'];
      $tdj_pot = $tdj_pot + $dtl['dj_pot'];
      $tdj_net = $tdj_net + $dtl['dj_net'];
			//end loop per asn
      }
      
			//end loop per gol
			
	  ?>
      <tr>
        <td align="center">&nbsp;</td>
        <td align="center">JUMLAH TOTAL : <?= $tdj_asn ?></td>
        <td align="right" valign="top"><?= Angka::Ribuan($tdj_pagu) ?></td>
        <td align="right" valign="top">
          <?= Angka::Ribuan($tdj_beban) ?>
          <div align='center'>--------------------</div>
          <?= Angka::Ribuan($tdj_prestasi) ?>
        </td>
        <td align="right" valign="top">
          <?= Angka::Ribuan($tdj_presensi) ?>        </td>
        <td align="right" valign="top">
        <?= Angka::Ribuan($tdj_kinerja) ?></td>
        <td align="right" valign="top">
		  <?= Angka::Ribuan($tdj_sakip) ?></td>
        <td align="right" valign="top">
          <?= Angka::Ribuan($tdj_hukdis) ?>
        </td>
        <td align="right" valign="top">
          <?= Angka::Ribuan($tdj_total) ?><br>
          <?= Angka::Ribuan($tdj_bpjs4) ?><br>
          <?= Angka::Ribuan($tdj_bruto) ?>
        </td>
        <td align="right" valign="top">
          <?= Angka::Ribuan($tdj_bpjs4) ?><br>
          <?= Angka::Ribuan($tdj_bpjs1) ?><br>
          <?= Angka::Ribuan($tdj_pph) ?><br>
          <?= Angka::Ribuan($tdj_pot) ?><div align='center'>--------------------</div>
          <b><?= Angka::Ribuan($tdj_net) ?></b>
        </td>
        <td align="right" valign="top" style="font-size: 12px;">
          <b><?= Angka::Ribuan($tdj_net) ?></b>
        </td>
      </tr>
  </tbody>
</table>
<br>
<table cellspacing="0" border="0" width="100%" style="font-family: Arial, Helvetica, sans-serif; font-size: 11px;">
  <tbody>
    <tr>
      <td align="center" width="50%">Mengetahui<br>
        Pengguna Anggaran<br>
        <br>
        <br>
        <br>
        <br>
        NIP. ___________________________</td>
      <td align="center" width="50%">Brebes, ________________________________<br>
        Bendahara Gaji<br>
        <br>
        <br>
        <br>
        <br>
        NIP. ___________________________</td>
    </tr>
  </tbody>
</table>
<?php }?>
</p>
</div>