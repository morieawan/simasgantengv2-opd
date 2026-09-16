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

    <h3><?= Html::encode($this->title) ?></h3>

    <div class="row">    
        <?= Card(3, 'light', 'success', 'fa-sync', Html::button('<b>Sinkron Data SIASN</b>', ['value' => '', 'class' => 'btn btn-link', 'id' => 'sinkron-siasn']), 0, 0) ?>
        <?= Card(3, 'light', 'info', 'fa-users', 'Jumlah ASN', $data['jml'], 0) ?>
        <?= Card(3, 'light', 'danger', 'fa-users', 'Jumlah CPNS/PNS', $data['pns'], ($data['pns']/$data['jml']*100)) ?>
        <?= Card(3, 'light', 'warning', 'fa-users', 'Jumlah PPPK', $data['p3k'], ($data['p3k']/$data['jml']*100)) ?>        
    </div>
    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

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
        'filterModel' => $searchModel,
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
                'template' => '{update} {delete}',
                'buttons' => [
                    'update' => function ($url) {
                        return Html::button('<span class="fas fa-pencil-alt"></span>',['value' => Url::to($url), 
                            'title' => 'Update', 'class' => 'showModalButton btn btn-link',
                        ]);
                    },
                ],
            ],
        ],
    ]); ?>

</div>
<?php
function Card($row, $warna, $bg, $icon, $text, $val, $persen){
    if($persen == 0) $nilai = number_format($val, '0', ',', '.');
    else $nilai = number_format($val, '0', ',', '.')." ( ". number_format($persen, '2', ',', '.'). "% )";

    if($val == 0) $nilai = '';

    echo "<div class=\"col-12 col-sm-6 col-md-$row\">
    <div class=\"info-box bg-$warna\">
        <span class=\"info-box-icon bg-$bg elevation-1\"><i class=\"fas $icon\"></i></span>
        <div class=\"info-box-content\">
            <span class=\"info-box-text\">$text</span>
            <span class=\"info-box-number\">$nilai</span>
        </div>
    </div>
</div>";
}

$urlData = Url::to(['/integrasi/siasn-data-utama/sinkron']);
$script = <<< JS

$('#sinkron-siasn').click(function(){
    var zipId = $.now();

    $.get("{$urlData}",{ zid : zipId },function(data){
        alert(data);
    });
});
JS;
$this->registerJs($script);
?>
