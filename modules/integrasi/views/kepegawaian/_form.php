<?php

use yii\helpers\Html;
use yii\helpers\Url;
//use yii\helpers\ArrayHelper;
use kartik\widgets\ActiveForm;
use kartik\number\NumberControl;
//use kartik\select2\Select2;
use kartik\datecontrol\DateControl;

/* @var $this yii\web\View */
/* @var $model app\modules\integrasi\models\SiasnDataUtama */
/* @var $form yii\widgets\ActiveForm */

$dispOptions = ['class' => 'form-control kv-monospace']; 
$saveOptions = [
    'type' => 'hidden', 
    'readonly' => true, 
    'tabindex' => 1000
];
 
$saveCont = ['class' => 'kv-saved-cont'];
?>

<div class="siasn-data-utama-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nipBaru')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nipLama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gelarDepan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gelarBelakang')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tempatLahir')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tempatLahirId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tglLahir')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'agama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'agamaId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'emailGov')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nik')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alamat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'noHp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'noTelp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jenisPegawaiId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jenisPegawaiNama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kedudukanPnsId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kedudukanPnsNama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'statusPegawai')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jenisKelamin')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jenisIdDokumenId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jenisIdDokumenNama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nomorIdDocument')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'noSeriKarpeg')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tkPendidikanTerakhirId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tkPendidikanTerakhir')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pendidikanTerakhirId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pendidikanTerakhirNama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tahunLulus')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tmtPns')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tglSkPns')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tmtCpns')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tglSkCpns')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tmtPensiun')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bupPensiun')->widget(NumberControl::classname(), [
                'options' => $saveOptions,
                'displayOptions' => $dispOptions,
                'saveInputContainer' => $saveCont,
                'maskedInputOptions' => [
                    'allowMinus' => false,
                    'rightAlign' => false
                ]
            ]) ?>

    <?= $form->field($model, 'latihanStrukturalNama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'instansiIndukId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'instansiIndukNama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'satuanKerjaIndukId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'satuanKerjaIndukNama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kanregId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kanregNama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'instansiKerjaId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'instansiKerjaNama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'instansiKerjaKodeCepat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'satuanKerjaKerjaId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'satuanKerjaKerjaNama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'unorId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'unorNama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'unorIndukId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'unorIndukNama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jenisJabatanId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jenisJabatan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jabatanNama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jabatanStrukturalId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jabatanStrukturalNama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jabatanFungsionalId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jabatanFungsionalNama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jabatanFungsionalUmumId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jabatanFungsionalUmumNama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tmtJabatan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lokasiKerjaId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lokasiKerja')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'golRuangAwalId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'golRuangAwal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'golRuangAkhirId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'golRuangAkhir')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tmtGolAkhir')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nomorSptm')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'masaKerja')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'eselon')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'eselonId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'eselonLevel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tmtEselon')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gajiPokok')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kpknId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kpknNama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ktuaId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ktuaNama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'taspenId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'taspenNama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jenisKawinId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'statusPerkawinan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'statusHidup')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tglSuratKeteranganDokter')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'noSuratKeteranganDokter')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jumlahIstriSuami')->widget(NumberControl::classname(), [
                'options' => $saveOptions,
                'displayOptions' => $dispOptions,
                'saveInputContainer' => $saveCont,
                'maskedInputOptions' => [
                    'allowMinus' => false,
                    'rightAlign' => false
                ]
            ]) ?>

    <?= $form->field($model, 'jumlahAnak')->widget(NumberControl::classname(), [
                'options' => $saveOptions,
                'displayOptions' => $dispOptions,
                'saveInputContainer' => $saveCont,
                'maskedInputOptions' => [
                    'allowMinus' => false,
                    'rightAlign' => false
                ]
            ]) ?>

    <?= $form->field($model, 'noSuratKeteranganBebasNarkoba')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tglSuratKeteranganBebasNarkoba')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'skck')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tglSkck')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'akteKelahiran')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'akteMeninggal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tglMeninggal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'noNpwp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tglNpwp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'noAskes')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bpjs')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kodePos')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'noSpmt')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tglSpmt')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'noTaspen')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bahasa')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kppnId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kppnNama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pangkatAkhir')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tglSttpl')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nomorSttpl')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nomorSkCpns')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nomorSkPns')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jenjang')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jabatanAsn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kartuAsn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mkTahun')->widget(NumberControl::classname(), [
                'options' => $saveOptions,
                'displayOptions' => $dispOptions,
                'saveInputContainer' => $saveCont,
                'maskedInputOptions' => [
                    'allowMinus' => false,
                    'rightAlign' => false
                ]
            ]) ?>

    <?= $form->field($model, 'mkBulan')->widget(NumberControl::classname(), [
                'options' => $saveOptions,
                'displayOptions' => $dispOptions,
                'saveInputContainer' => $saveCont,
                'maskedInputOptions' => [
                    'allowMinus' => false,
                    'rightAlign' => false
                ]
            ]) ?>

    <?= $form->field($model, 'flag')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'updated')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'validNik')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?=  Html::submitButton('<i class=\"fas fa-save\"></i> Simpan', ['class' => 'btn btn-success']) ?>
        <?=  Html::a('<i class=\"fas fa-minus-circle\"></i> Batal',' ', ['class' => 'btn btn-danger', 'data-dismis' => 'modal']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
