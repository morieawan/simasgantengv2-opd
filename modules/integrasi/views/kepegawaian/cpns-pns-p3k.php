<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\integrasi\models\SiasnDataUtama */

$this->title = strtoupper(Yii::$app->controller->action->id);
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="siasn-data-utama-view">

    <div class="mb-3">
        <?= $this->render('../layout/menu-spv.php', ['nip' => $model['nipBaru']]) ?>
    </div>
    
    <?= DetailView::widget([
        'template' => "<tr><th style='width:30%;'>{label}</th><td>{value}</td></tr>",
        'options' => ['class' => 'table table-striped', 'style' => 'font-size:10pt;'],
        'model' => $model,
        'attributes' => [
            'nipBaru',
            // 'nipLama',
            'nama',
            // 'gelarDepan',
            // 'gelarBelakang',
            // 'tempatLahir',
            // 'tglLahir',
            // 'agama',
            // 'email:email',
            // 'emailGov:email',
            // 'nik',
            // 'alamat',
            // 'noHp',
            // 'noTelp',
            // 'jenisPegawaiNama',
            // 'kedudukanPnsNama',
            // 'statusPegawai',
            // 'jenisKelamin',
            // 'jenisIdDokumenNama',
            // 'nomorIdDocument',
            // 'noSeriKarpeg',
            // 'tkPendidikanTerakhir',
            // 'pendidikanTerakhirNama',
            // 'tahunLulus',
            'tglSkCpns',
            'nomorSkCpns',
            'tmtCpns',
            'golRuangAwal',
            'tglSkPns',
            'nomorSkPns',
            'tmtPns',
            // 'tmtPensiun',
            // 'bupPensiun:integer',
            // 'latihanStrukturalNama',
            // 'instansiIndukId',
            // 'instansiIndukNama',
            // 'satuanKerjaIndukId',
            // 'satuanKerjaIndukNama',
            // 'kanregId',
            // 'kanregNama',
            // 'instansiKerjaId',
            // 'instansiKerjaNama',
            // 'instansiKerjaKodeCepat',
            // 'satuanKerjaKerjaId',
            // 'satuanKerjaKerjaNama',
            // 'unorId',
            // 'unorNama',
            // 'unorIndukId',
            // 'unorIndukNama',
            // 'jenisJabatanId',
            // 'jenisJabatan',
            // 'jabatanNama',
            // 'jabatanStrukturalId',
            // 'jabatanStrukturalNama',
            // 'jabatanFungsionalId',
            // 'jabatanFungsionalNama',
            // 'jabatanFungsionalUmumId',
            // 'jabatanFungsionalUmumNama',
            // 'tmtJabatan',
            // 'lokasiKerjaId',
            // 'lokasiKerja',
            // 'golRuangAwalId',
            // 'golRuangAkhirId',
            // 'golRuangAkhir',
            // 'tmtGolAkhir',
            //'nomorSptm',
            // 'masaKerja',
            // 'eselon',
            // 'eselonId',
            // 'eselonLevel',
            // 'tmtEselon',
            // 'gajiPokok',
            // 'kpknId',
            // 'kpknNama',
            // 'ktuaId',
            // 'ktuaNama',
            // 'taspenId',
            // 'taspenNama',
            // 'jenisKawinId',
            // 'statusPerkawinan',
            // 'statusHidup',
            'tglSuratKeteranganDokter',
            'noSuratKeteranganDokter',
            // 'jumlahIstriSuami:integer',
            // 'jumlahAnak:integer',
            'noSuratKeteranganBebasNarkoba',
            'tglSuratKeteranganBebasNarkoba',
            'skck',
            'tglSkck',
            // 'akteKelahiran',
            // 'akteMeninggal',
            // 'tglMeninggal',
            // 'noNpwp',
            // 'tglNpwp',
            // 'noAskes',
            // 'bpjs',
            // 'kodePos',
            'noSpmt',
            'tglSpmt',
            // 'noTaspen',
            // 'bahasa',
            // 'kppnId',
            // 'kppnNama',
            // 'pangkatAkhir',
            'tglSttpl',
            'nomorSttpl',
            // 'jenjang',
            // 'jabatanAsn',
            // 'kartuAsn',
            // 'mkTahun:integer',
            // 'mkBulan:integer',
            // 'flag',
            // 'updated',
            // 'validNik',
        ],
    ]) ?>

    <div class="row">
        <div class="col-md-6">
        <p>
            <b>Dok SK CPNS</b> &nbsp; 
            <?php echo Html::button('Update SK CPNS',[
                'value' => Url::to(['/upload-dok', 'nip' => $model['id'], 'id_dok' => 889]), 
                'title' => 'Upload SK CPNS', 'class' => 'showModalButton btn btn-primary btn-sm disabled', 
            ]);?>
        </p>
            <?php
                if($dok_cpns == ''){
                    echo Html::a('Get Dok SK CPNS',
                        Url::to(['/siasn-get-dok', 'id' => 'SK_CPNS_'.$model['nipBaru'].'.pdf', 'nip' => $model['id']]),
                        ['class' => "btn btn-success mb-1 mr-1"]);
                } else {
                    echo Html::a('Get Dok SK CPNS',
                        Url::to(['/siasn-get-dok', 'id' => 'SK_CPNS_'.$model['nipBaru'].'.pdf', 'nip' => $model['id']]),
                        ['class' => "btn btn-success mb-1 mr-1"]);
                    //echo "<br><embed src=\"$dok_cpns\" width='100%' height='900px' type='application/pdf'/>";
                    echo Html::button('Show Dok SK CPNS', [
                        'value' => Url::to(['/siasn-show-dok', 'id' => 'SK_CPNS_'.$model['nipBaru'].'.pdf', 'nip' => $model['id']]),
                        'class' => "showModalButton btn btn-info mb-1 mr-1"
                    ]);

                }
            ?>
        </div>
        <div class="col-md-6"> 
            <p>
                <b>Dok SK PNS</b> &nbsp; 
                <?php echo Html::button('Update SK PNS',[
                    'value' => Url::to(['/upload-dok', 'nip' => $model['id'], 'id_dok' => 887]), 
                    'title' => 'Upload SK PNS', 'class' => 'showModalButton btn btn-primary btn-sm disabled', 
                ]);?>
            </p>

            <?php
                if($dok_pns == ''){
                    echo Html::a('Get Dok SK PNS', 
                        Url::to(['/siasn-get-dok', 'id' => 'SK_PNS_'.$model['nipBaru'].'.pdf', 'nip' => $model['id']]),
                        ['class' => 'btn btn-success mb-1 mr-1']);
                }else{
                    echo Html::a('Get Dok SK PNS', 
                        Url::to(['/siasn-get-dok', 'id' => 'SK_PNS_'.$model['nipBaru'].'.pdf', 'nip' => $model['id']]),
                        ['class' => 'btn btn-success mb-1 mr-1']);
                    echo '<br><iframe src="'.$dok_pns.'" style="width:100%; height:900px; border:none;"/>';
                }
            ?>     
        </div>
        <!--
        <div class="col-md-4">
            <p><b>Dok Surat Perintah Melaksanakan Tugas (SPMT)</b></p>
            
            <?php
                if($dok_spmt == ''){ 
                    echo Html::a('Get Dok SPMT',
                        Url::to(['/siasn-get-dok', 'id' => 'SK_SPMT_'.$model['nipBaru'].'.pdf', 'nip' => $model['id']]),
                        ['class' => "btn btn-success mb-1 mr-1"]);
                }
                else echo "<embed src=\"$dok_spmt\" type=\"application/pdf\" height=\"100%\" width=\"100%\">";
            ?>
        </div>
        -->
    </div>

</div>
