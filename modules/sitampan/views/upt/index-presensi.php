<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
//use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\sitampan\models\PreskinAsnSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'PRESENSI & KINERJA ASN UPT '.$namapd;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="preskin-asn-index">
    
    <?= '<b>PERIODE : '.strtoupper($namabul)." ".$tahun.'</b>' ?>
    
    <?php /*echo Html::a('<i class="fas fa-print"></i> Cetak Hasil', [
        'cetak-hasil',
        'bulan' => $bulan,
        'tahun' => $tahun,
        ], ['title' => 'Cari Data', 'class' => 'btn btn-outline-danger float-right mb-1 ml-1', 'target' => '_blank']); 
    */?>

    <?=  Html::a('<i class="fas fa-search"></i> Cari Data', '#', ['title' => 'Cari Data', 'class' => 'btn btn-outline-success float-right mb-1', 'id' => 'search']); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'tableOptions' => ['style' => 'font-size:10pt'],
        'options' => [
            'class' => 'table-responsive',
            'style'=>'max-width:100%; min-height:100px; overflow: auto; word-wrap: break-word;'
        ],
        'showPageSummary' => false,
        'summary' => false,
        'striped' => true,
        'hover' => true,
        'responsiveWrap' => false,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn', 'header' => 'NO'],
            [
                'attribute' => 'nip',
                'header' => 'NIP<br>NAMA<br>UNOR',
                'format' => 'raw',
                'options' => ['style' => 'width:30%'],
                'value' => function($dt){
                    return $dt['nip'].'<br>'.$dt['fipNama'].'<br>'.$dt['fipUnor'];
                }
            ],
            [
                'header' => 'JABATAN<br>JENIS JADWAL',
                'format' => 'raw',
                'options' => ['style' => 'width:25%'],
                'value' => function($dt){
                    if($dt['asnJadwalKerja'] === null) $jk = $dt['kode_jadwal'];
                    else $jk = $dt['asnJadwalKerja']['jenis'];
                    return $dt['fipJabatan'].'<br>'.$jk;
                }
            ],
            [
                'header' => 'AKTIVITAS PRESENSI',
                'format' => 'raw',
                'options' => ['style' => 'width:13%'],
                'value' => function ($dt) use ($tahun, $bulan){
                    $hp = Html::button('<span class="fas fa-calendar-alt"></span>',[
                        'value' => Url::to([
                            'checkinout', 'id' => $dt['nip'], 'bulan' => $bulan, 'tahun' => $tahun
                        ]),
                        'title' => 'Data Aktivitas Presensi Tersimpan', 
                        'class' => 'showModalButton btn btn-link'
                    ]);

                    return $hp;
                }
            ],
            [
                'header' => 'HASIL PRESENSI',
                'format' => 'raw',
                'options' => ['style' => 'width:13%'],
                'value' => function ($dt) use ($tahun, $bulan){
                    if(\app\modules\sitampan\models\PresHarian::getCountPres($dt['nip'], $tahun, $bulan) > 0){
                        return Html::button('<span class="fas fa-tasks"></span>',[
                            'value' => Url::to([
                                'presensi-hasil', 'id' => $dt['nip'], 'bulan' => $bulan, 'tahun' => $tahun
                            ]),
                            'title' => 'Data Hasil Presensi', 
                            'class' => 'showModalButton btn btn-link'
                        ]);
                    }else return 'TIDAK ADA JADWAL KERJA';
                }
            ],
            [
                'header' => 'KINERJA HARIAN',
                'format' => 'raw',
                'options' => ['style' => 'width:13%'],
                'value' => function ($dt) use ($tahun, $bulan){  
                    if(\app\modules\sitampan\models\KinHarian::getCountKin($dt['nip'], $tahun, $bulan) > 0){
                        // return Html::button('<span class="fas fa-cogs"></span>',[
                        //     'value' => Url::to([
                        //         'kinerja-hasil', 'id' => $dt['nip'], 'bulan' => $bulan, 'tahun' => $tahun
                        //     ]),
                        //     'title' => 'Detail Hasil Kinerja', 
                        //     'class' => 'showModalButton btn btn-link'
                        // ]);

                        return Html::a('<span class="fas fa-cogs"></span>',[                            
                                'kinerja-hasil', 'id' => $dt['nip'], 'bulan' => $bulan, 'tahun' => $tahun
                            ],[
                            'title' => 'Detail Hasil Kinerja', 
                            'class' => 'btn btn-link'
                        ]);
                    }else return 'TIDAK ADA';
                }
            ],
        ],
    ]); ?>

</div>

<div id="cari-block" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-olive">
            <h5 class="modal-title">Cari Data</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <?= $this->render('_search-pres', ['model' => $searchModel, 'opd' => $opd, 'bulan' => $bulan, 'tahun' => $tahun]); ?>
            </div>
        </div>
    </div>
</div>

<?php
\yii\bootstrap4\Modal::begin([
    'title' => Html::encode($this->title),
    'headerOptions' => ['class' => 'bg-olive'],
    'id' => 'modal',
    'size' => 'modal-lg',
    'options' => [
        'tabindex' => false // important for Select2 to work properly
    ],
]);

echo "<div id='modalContent'></div>";
\yii\bootstrap4\Modal::end();

$script = <<< JS
$('#search').click(function(){
	$("#cari-block").modal('show');
});
JS;
$this->registerJs($script);
?>
