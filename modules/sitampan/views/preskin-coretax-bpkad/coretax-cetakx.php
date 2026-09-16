<?php

use yii\helpers\Html;
use yii\helpers\Json;
use app\models\Angka;

/* @var $this yii\web\View */
/* @var $model app\modules\tpp\models\TppHitung */

$this->title = 'Cetak Coretax Akhir Masa Pajak';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="tpp-hitung-cetak" style="font-family: Arial, Helvetica, sans-serif; font-size: 11px;">
<p>

<table cellspacing="0" cellpadding="0" border="0" width="100%" style="font-family: Arial, Helvetica, sans-serif; font-size: 11px;">
  <tbody>
    <tr>
      <td align="center"><strong>REKAP PPH PASAL 21 APARATUR SIPIL NEGARA (ASN) KABUPATEN BREBES</strong></td>
    </tr>
    <tr>
      <td align="center"><strong>AKHIR MASA PAJAK</strong></td>
    </tr>
    
    <tr>
      <td align="center" ><strong>TAHUN PAJAK : <?= $tahun ?></strong></td>
    </tr>
    <tr>
      <td align="center" >
      </td>
    </tr>
  </tbody>
</table>
<br>
<table cellspacing="0" cellpadding="5" border="1" width="100%" style="font-family: Arial, Helvetica, sans-serif; font-size: 11px;">
  <thead>
    <tr>
      <td align="center" width="5%" rowspan="2">NO</td>
      <td align="center" width="20%" rowspan="2">
		    PERANGKAT DAERAH<br>ID TKU
		  </td>
      <td align="center" width="10%" rowspan="2">JUMLAH ASN</td>
      <td align="center" width="12%" rowspan="2">
        BRUTO GAJI<BR>
        BRUTO TPP<BR>
        ------------------------<BR>
        JUMLAH BRUTO
      </td>
      <td align="center" colspan="2">PPH PASAL 21</td>
      <td align="center" colspan="2">DIAJUKAN</td>

    </tr>
    <tr>
      <td align="center" width="12%">TOTAL SETAHUN<BR>TERBAYAR</td>
      <td align="center" width="12%">(LEBIH)/<BR>KURANG BAYAR</td>
      <td align="center" width="10%">JML ASN KURANG BAYAR</td>
      <td align="center" width="12%">JML PPH KURANG BAYAR</td>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td valign="top" align="center">1</td>
      <td valign="top"><?= strtoupper($opd)."<br>".$data['id_tku'] ?></td>
      <td align="center" valign="top"><?= Angka::Ribuan($data['jml_asn']) ?></td>
      <td align="right" valign="top">
        <?= Angka::Ribuan($data['bruto_gaji']) ?><BR>
        <?= Angka::Ribuan($data['bruto_tpp']) ?><BR>
        ------------------------<BR>
        <?= Angka::Ribuan($data['bruto_total']) ?>
      </td>
      <td align="right" valign="top">
        <?= Angka::Ribuan($data['pph_total']) ?><BR>
        <?= Angka::Ribuan($data['pph_terbayar'] + $data['pph_gaji_akhir']) ?>
      </td>
      <td align="right" valign="top">
        <?php
          if($data['pph_terhutang'] < 0) echo "(".Angka::Ribuan($data['pph_terhutang'] * (-1)).")";
        ?>
      </td>
      <td align="center" valign="top"><?= Angka::Ribuan($data['jml_asn_krg']) ?></td>
      <td align="center" valign="top">
        <font size="+1"><b><?= Angka::Ribuan($data['pph_diajukan']) ?> <b></font>
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

</p>
</div>