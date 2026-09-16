<?php

use yii\helpers\Html;
use yii\helpers\Json;
use app\models\Angka;

/* @var $this yii\web\View */
/* @var $model app\modules\tpp\models\TppHitung */

$this->title = 'Cetak Coretax';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="tpp-hitung-cetak" style="font-family: Arial, Helvetica, sans-serif; font-size: 11px;">
<p>

<table cellspacing="0" cellpadding="0" border="0" width="100%" style="font-family: Arial, Helvetica, sans-serif; font-size: 11px;">
  <tbody>
    <tr>
      <td align="center"><strong>DAFTAR PEMBAYARAN PPH PASAL 21 APARATUR SIPIL NEGARA (ASN) KABUPATEN BREBES</strong></td>
    </tr>
    <tr>
      <td align="center"><strong>BERDASARKAN TARIF EFEKTIF RATA-RATA</strong></td>
    </tr>
    <tr>
      <td align="center" ><strong>MASA PAJAK : </strong>
      </td>
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
      <td align="center" width="3%" rowspan="2">NO</td>
      <td align="center" width="20%" rowspan="2">
		    NIP<br>
        NAMA
		  </td>
      <td align="center" width="10%" rowspan="2">NPWP/NIK/TIN</td>
      <td align="center" width="5%" rowspan="2">STATUS</td>
      <td align="center" colspan="3">PENGHASILAN KOTOR</td>
      <td align="center" width="4%" rowspan="2">TARIF (TER)</td>
      <td align="center" colspan="3">PPH PASAL 21</td>
    </tr>
    <tr>
      <td align="center" width="9%">GAJI</td>
      <td align="center" width="9%">TPP</td>
      <td align="center" width="9%">JUMLAH</td>
      <td align="center" width="9%">TOTAL</td>
      <td align="center" width="9%">TERBAYAR (GAJI)</td>
      <td align="center" width="9%">DIAJUKAN (TPP)</td>
    </tr>
  </thead>
  <tbody>

  <?php 
    $no = 0;
    foreach ($data as $dt){ 
      $no++;
  ?>

    <tr>
      <td valign="top" align="center"><?= Angka::Ribuan($no) ?></td>
      <td valign="top"><?= $dt['nip']."<br>".$dt['nama'] ?></td>
      <td align="right" valign="top"></td>
      <td align="right" valign="top"></td>
      <td align="right" valign="top"></td>
      <td align="right" valign="top"></td>
      <td align="right" valign="top"></td>
      <td align="right" valign="top"></td>
      <td align="right" valign="top"></td>
      <td align="right" valign="top"></td>
      <td align="right" valign="top"></td>
    </tr>
  <?php } ?>
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