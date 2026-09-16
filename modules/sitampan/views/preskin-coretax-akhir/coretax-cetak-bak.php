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
      <td align="center" width="18%" rowspan="2">
		    PERANGKAT DAERAH<br>ID TKU
		  </td>
      <td align="center" width="8%" rowspan="2">JUMLAH ASN</td>
      <td align="center" colspan="3">TOTAL PENGHASILAN KOTOR</td>
      <td align="center" colspan="4">PPH PASAL 21</td>
    </tr>
    <tr>
      <td align="center" width="12%">GAJI</td>
      <td align="center" width="12%">TPP</td>
      <td align="center" width="12%">JUMLAH</td>
      <td align="center" width="12%">TOTAL SETAHUN</td>
      <td align="center" width="12%">TERBAYAR</td>
      <td align="center" width="12%">(LEBIH)/ KURANG BAYAR</td>
      <td align="center" width="12%">DIAJUKAN</td>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td valign="top" align="center">1</td>
      <td valign="top"><?= strtoupper($opd)."<br>".$data['id_tku'] ?></td>
      <td align="center" valign="top"><?= Angka::Ribuan($data['jml_asn']) ?></td>
      <td align="center" valign="top"><?= Angka::Ribuan($data['bruto_gaji'] + $data['jkk'] + $data['jkm'] + $data['bpjs4']) ?></td>
      <td align="center" valign="top"><?= Angka::Ribuan($data['bruto_tpp']) ?></td>
      <td align="center" valign="top"><?= Angka::Ribuan($data['bruto_total']) ?></td>
      <td align="center" valign="top"><?= Angka::Ribuan($data['pph_total']) ?></td>
      <td align="center" valign="top"><?= Angka::Ribuan($data['pph_terbayar'] + $data['pph_gaji_akhir']) ?></td>
      <td align="center" valign="top">
        <?php
          if($data['pph_terhutang'] < 0) echo "(".Angka::Ribuan($data['pph_terhutang'] * (-1)).")";
        ?>
      </td>
      <td align="center" valign="top">
        <font size="+1"><b>
          <?php
            if($data['pph_terhutang'] < 0) echo 0;
            else Angka::Ribuan($data['pph_terhutang']) ;
          ?>
        <b></font>
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