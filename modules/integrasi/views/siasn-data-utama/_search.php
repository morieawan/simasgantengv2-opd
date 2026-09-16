<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\integrasi\models\SiasnDataUtamaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="siasn-data-utama-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'id' => 'cari-form', 
        'type' => ActiveForm::TYPE_INLINE,
        'fieldConfig' => ['options' => ['class' => 'form-group mr-2 mb-3']], 
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nipBaru') ?>

    <?= $form->field($model, 'nipLama') ?>

    <?= $form->field($model, 'nama') ?>

    <?= $form->field($model, 'gelarDepan') ?>

    <?php // echo $form->field($model, 'gelarBelakang') ?>

    <?php // echo $form->field($model, 'tempatLahir') ?>

    <?php // echo $form->field($model, 'tempatLahirId') ?>

    <?php // echo $form->field($model, 'tglLahir') ?>

    <?php // echo $form->field($model, 'agama') ?>

    <?php // echo $form->field($model, 'agamaId') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'emailGov') ?>

    <?php // echo $form->field($model, 'nik') ?>

    <?php // echo $form->field($model, 'alamat') ?>

    <?php // echo $form->field($model, 'noHp') ?>

    <?php // echo $form->field($model, 'noTelp') ?>

    <?php // echo $form->field($model, 'jenisPegawaiId') ?>

    <?php // echo $form->field($model, 'jenisPegawaiNama') ?>

    <?php // echo $form->field($model, 'kedudukanPnsId') ?>

    <?php // echo $form->field($model, 'kedudukanPnsNama') ?>

    <?php // echo $form->field($model, 'statusPegawai') ?>

    <?php // echo $form->field($model, 'jenisKelamin') ?>

    <?php // echo $form->field($model, 'jenisIdDokumenId') ?>

    <?php // echo $form->field($model, 'jenisIdDokumenNama') ?>

    <?php // echo $form->field($model, 'nomorIdDocument') ?>

    <?php // echo $form->field($model, 'noSeriKarpeg') ?>

    <?php // echo $form->field($model, 'tkPendidikanTerakhirId') ?>

    <?php // echo $form->field($model, 'tkPendidikanTerakhir') ?>

    <?php // echo $form->field($model, 'pendidikanTerakhirId') ?>

    <?php // echo $form->field($model, 'pendidikanTerakhirNama') ?>

    <?php // echo $form->field($model, 'tahunLulus') ?>

    <?php // echo $form->field($model, 'tmtPns') ?>

    <?php // echo $form->field($model, 'tglSkPns') ?>

    <?php // echo $form->field($model, 'tmtCpns') ?>

    <?php // echo $form->field($model, 'tglSkCpns') ?>

    <?php // echo $form->field($model, 'tmtPensiun') ?>

    <?php // echo $form->field($model, 'bupPensiun') ?>

    <?php // echo $form->field($model, 'latihanStrukturalNama') ?>

    <?php // echo $form->field($model, 'instansiIndukId') ?>

    <?php // echo $form->field($model, 'instansiIndukNama') ?>

    <?php // echo $form->field($model, 'satuanKerjaIndukId') ?>

    <?php // echo $form->field($model, 'satuanKerjaIndukNama') ?>

    <?php // echo $form->field($model, 'kanregId') ?>

    <?php // echo $form->field($model, 'kanregNama') ?>

    <?php // echo $form->field($model, 'instansiKerjaId') ?>

    <?php // echo $form->field($model, 'instansiKerjaNama') ?>

    <?php // echo $form->field($model, 'instansiKerjaKodeCepat') ?>

    <?php // echo $form->field($model, 'satuanKerjaKerjaId') ?>

    <?php // echo $form->field($model, 'satuanKerjaKerjaNama') ?>

    <?php // echo $form->field($model, 'unorId') ?>

    <?php // echo $form->field($model, 'unorNama') ?>

    <?php // echo $form->field($model, 'unorIndukId') ?>

    <?php // echo $form->field($model, 'unorIndukNama') ?>

    <?php // echo $form->field($model, 'jenisJabatanId') ?>

    <?php // echo $form->field($model, 'jenisJabatan') ?>

    <?php // echo $form->field($model, 'jabatanNama') ?>

    <?php // echo $form->field($model, 'jabatanStrukturalId') ?>

    <?php // echo $form->field($model, 'jabatanStrukturalNama') ?>

    <?php // echo $form->field($model, 'jabatanFungsionalId') ?>

    <?php // echo $form->field($model, 'jabatanFungsionalNama') ?>

    <?php // echo $form->field($model, 'jabatanFungsionalUmumId') ?>

    <?php // echo $form->field($model, 'jabatanFungsionalUmumNama') ?>

    <?php // echo $form->field($model, 'tmtJabatan') ?>

    <?php // echo $form->field($model, 'lokasiKerjaId') ?>

    <?php // echo $form->field($model, 'lokasiKerja') ?>

    <?php // echo $form->field($model, 'golRuangAwalId') ?>

    <?php // echo $form->field($model, 'golRuangAwal') ?>

    <?php // echo $form->field($model, 'golRuangAkhirId') ?>

    <?php // echo $form->field($model, 'golRuangAkhir') ?>

    <?php // echo $form->field($model, 'tmtGolAkhir') ?>

    <?php // echo $form->field($model, 'nomorSptm') ?>

    <?php // echo $form->field($model, 'masaKerja') ?>

    <?php // echo $form->field($model, 'eselon') ?>

    <?php // echo $form->field($model, 'eselonId') ?>

    <?php // echo $form->field($model, 'eselonLevel') ?>

    <?php // echo $form->field($model, 'tmtEselon') ?>

    <?php // echo $form->field($model, 'gajiPokok') ?>

    <?php // echo $form->field($model, 'kpknId') ?>

    <?php // echo $form->field($model, 'kpknNama') ?>

    <?php // echo $form->field($model, 'ktuaId') ?>

    <?php // echo $form->field($model, 'ktuaNama') ?>

    <?php // echo $form->field($model, 'taspenId') ?>

    <?php // echo $form->field($model, 'taspenNama') ?>

    <?php // echo $form->field($model, 'jenisKawinId') ?>

    <?php // echo $form->field($model, 'statusPerkawinan') ?>

    <?php // echo $form->field($model, 'statusHidup') ?>

    <?php // echo $form->field($model, 'tglSuratKeteranganDokter') ?>

    <?php // echo $form->field($model, 'noSuratKeteranganDokter') ?>

    <?php // echo $form->field($model, 'jumlahIstriSuami') ?>

    <?php // echo $form->field($model, 'jumlahAnak') ?>

    <?php // echo $form->field($model, 'noSuratKeteranganBebasNarkoba') ?>

    <?php // echo $form->field($model, 'tglSuratKeteranganBebasNarkoba') ?>

    <?php // echo $form->field($model, 'skck') ?>

    <?php // echo $form->field($model, 'tglSkck') ?>

    <?php // echo $form->field($model, 'akteKelahiran') ?>

    <?php // echo $form->field($model, 'akteMeninggal') ?>

    <?php // echo $form->field($model, 'tglMeninggal') ?>

    <?php // echo $form->field($model, 'noNpwp') ?>

    <?php // echo $form->field($model, 'tglNpwp') ?>

    <?php // echo $form->field($model, 'noAskes') ?>

    <?php // echo $form->field($model, 'bpjs') ?>

    <?php // echo $form->field($model, 'kodePos') ?>

    <?php // echo $form->field($model, 'noSpmt') ?>

    <?php // echo $form->field($model, 'tglSpmt') ?>

    <?php // echo $form->field($model, 'noTaspen') ?>

    <?php // echo $form->field($model, 'bahasa') ?>

    <?php // echo $form->field($model, 'kppnId') ?>

    <?php // echo $form->field($model, 'kppnNama') ?>

    <?php // echo $form->field($model, 'pangkatAkhir') ?>

    <?php // echo $form->field($model, 'tglSttpl') ?>

    <?php // echo $form->field($model, 'nomorSttpl') ?>

    <?php // echo $form->field($model, 'nomorSkCpns') ?>

    <?php // echo $form->field($model, 'nomorSkPns') ?>

    <?php // echo $form->field($model, 'jenjang') ?>

    <?php // echo $form->field($model, 'jabatanAsn') ?>

    <?php // echo $form->field($model, 'kartuAsn') ?>

    <?php // echo $form->field($model, 'mkTahun') ?>

    <?php // echo $form->field($model, 'mkBulan') ?>

    <?php // echo $form->field($model, 'flag') ?>

    <?php // echo $form->field($model, 'updated') ?>

    <?php // echo $form->field($model, 'validNik') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
