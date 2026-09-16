<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
//use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\integrasi\models\SiasnDataUtamaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data SIASN BKN';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="siasn-data-utama-index">

    <div class="text-right">
        <?= Html::a('<i class="fas fa-search"></i> Cari Data', '#', ['title' => 'Cari Data', 'class' => 'btn btn-primary mb-2', 'id' => 'search']); ?>
        <?= Html::a('Reset', ['/asn'], ['title' => 'Reset', 'class' => 'btn btn-danger mb-2']); ?>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'tableOptions' => ['style' => 'font-size:10pt'],
        'options' => [
            'class' => 'table-responsive',
            'style'=>'max-width:100%; min-height:100px; overflow: auto; word-wrap: break-word;'
        ],
        'summary' => false,
        'striped' => true,
        'hover' => true,
        'responsiveWrap' => false,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

            //'id',
            'nipBaru',
            [
                'attribute' => 'nama',
                'value' => 'NamaPegawai',
            ],
            'kedudukanPnsNama',
            'statusPegawai',
            'unorIndukNama',
            'unorNama',
            //'nipLama',
            //'nama',
            //'gelarDepan',
            //'gelarBelakang',
            //'tempatLahir',
            //'tempatLahirId',
            //'tglLahir',
            //'agama',
            //'jenisPegawaiNama',
            //'agamaId',
            //'email:email',
            //'emailGov:email',
            //'nik',
            //'alamat',
            //'noHp',
            //'noTelp',
            //'jenisPegawaiId',
            //'kedudukanPnsId',
            //'jenisKelamin',
            //'jenisIdDokumenId',
            //'jenisIdDokumenNama',
            //'nomorIdDocument',
            //'noSeriKarpeg',
            //'tkPendidikanTerakhirId',
            //'tkPendidikanTerakhir',
            //'pendidikanTerakhirId',
            //'pendidikanTerakhirNama',
            //'tahunLulus',
            //'tmtPns',
            //'tglSkPns',
            //'tmtCpns',
            //'tglSkCpns',
            //'tmtPensiun',
            //'bupPensiun:integer',
            //'latihanStrukturalNama',
            //'instansiIndukId',
            //'instansiIndukNama',
            //'satuanKerjaIndukId',
            //'satuanKerjaIndukNama',
            //'kanregId',
            //'kanregNama',
            //'instansiKerjaId',
            //'instansiKerjaNama',
            //'instansiKerjaKodeCepat',
            //'satuanKerjaKerjaId',
            //'satuanKerjaKerjaNama',
            //'unorId',
            //'unorIndukId',
            //'jenisJabatanId',
            //'jenisJabatan',
            //'jabatanNama',
            //'jabatanStrukturalId',
            //'jabatanStrukturalNama',
            //'jabatanFungsionalId',
            //'jabatanFungsionalNama',
            //'jabatanFungsionalUmumId',
            //'jabatanFungsionalUmumNama',
            //'tmtJabatan',
            //'lokasiKerjaId',
            //'lokasiKerja',
            //'golRuangAwalId',
            //'golRuangAwal',
            //'golRuangAkhirId',
            //'golRuangAkhir',
            //'tmtGolAkhir',
            //'nomorSptm',
            //'masaKerja',
            //'eselon',
            //'eselonId',
            //'eselonLevel',
            //'tmtEselon',
            //'gajiPokok',
            //'kpknId',
            //'kpknNama',
            //'ktuaId',
            //'ktuaNama',
            //'taspenId',
            //'taspenNama',
            //'jenisKawinId',
            //'statusPerkawinan',
            //'statusHidup',
            //'tglSuratKeteranganDokter',
            //'noSuratKeteranganDokter',
            //'jumlahIstriSuami:integer',
            //'jumlahAnak:integer',
            //'noSuratKeteranganBebasNarkoba',
            //'tglSuratKeteranganBebasNarkoba',
            //'skck',
            //'tglSkck',
            //'akteKelahiran',
            //'akteMeninggal',
            //'tglMeninggal',
            //'noNpwp',
            //'tglNpwp',
            //'noAskes',
            //'bpjs',
            //'kodePos',
            //'noSpmt',
            //'tglSpmt',
            //'noTaspen',
            //'bahasa',
            //'kppnId',
            //'kppnNama',
            //'pangkatAkhir',
            //'tglSttpl',
            //'nomorSttpl',
            //'nomorSkCpns',
            //'nomorSkPns',
            //'jenjang',
            //'jabatanAsn',
            //'kartuAsn',
            //'mkTahun:integer',
            //'mkBulan:integer',
            //'flag',
            //'updated',
            //'validNik',

            [
                'class' => 'kartik\grid\ActionColumn',
                'template' => '{view}',
                'buttons' => [
                    'view' => function ($url, $dt) {
                        return Html::a('<span class="fas fa-eye"></span> ', 
                        ['profil', 'id' => $dt['nipBaru']],
                        ['clas' => 'btn btn-link', 'title' => 'View Detail']);
                    },
                ],
            ],
        ],
    ]); ?>

</div>


<div id="cari-block" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
            <h5 class="modal-title">Cari Data</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <?= $this->render('_search', ['model' => $searchModel]); ?>
            </div>
        </div>
    </div>
</div>

<?php
$script = <<< JS
$('#search').click(function(){
	$("#cari-block").modal('show');
});
JS;
$this->registerJs($script);

$css = <<< CSS
.img {
    background:  #fcf3cf ;
    position: relative;
    text-align: center;
    transform: rotate(10deg);
}

.img:before{
    position: relative;
    text-align: center;
    transform: rotate(20deg);
}       
    
CSS;
$this->registerCss($css);
?>