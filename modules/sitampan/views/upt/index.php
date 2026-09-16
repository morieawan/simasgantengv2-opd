<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
//use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\sitampan\models\PreskinAsnSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ASN UPT '.$namapd;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="preskin-asn-index">
       
    <?=  Html::a('<i class="fas fa-search"></i> Cari Data', '#', ['title' => 'Cari Data', 'class' => 'btn btn-outline-success float-left mb-1', 'id' => 'search']); ?>

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
            ['class' => 'kartik\grid\SerialColumn'],

            //'nip',
            //'idpns',
            // 'kode_kelas_jab',
            // 'kode_jadwal',
            // 'pres',
            // 'kin',
            // 'tpp',
            // 'tmt_stop:date',
            // 'status',
            // 'updated',
            [
                'attribute' => 'nip',
                'header' => 'NIP<br>NAMA<br>GOL',
                'format' => 'raw',
                'options' => ['style' => 'width:25%'],
                'value' => function($dt){
                    return $dt['nip'].'<br>'.$dt['fipNama'].'<br>'.$dt['fipGol'];
                }
            ],
            [
                'header' => 'JABATAN<br>KELAS<br>JADWAL KERJA',
                'format' => 'raw',
                'options' => ['style' => 'width:20%'],
                'value' => function($dt){
                    if($dt['asnJadwalKerja'] === null) $jk = $dt['kode_jadwal'];
                    else $jk = $dt['asnJadwalKerja']['jenis'];
                    return $dt['fipJabatan'].'<br>'.$dt['asnKelas']['kelas'].'<br>'.$jk;
                }
            ],
            [
                'attribute' => 'status',
                'header' => 'STATUS<br><br>TMT STOP',
                'format' => 'raw',
                'options' => ['style' => 'width:25%'],
                'value' => function($dt){
                    if($dt['status'] == 0) $st = 0;
                    else $st = $dt['stapeg']['NMSTAPEG'];

                    if($dt['tmt_stop'] === null) $stop = '';
                    else $stop = \app\models\Fungsi::tgldmy($dt['tmt_stop']);
                    
                    return $st.'<br><br>'.$stop;
                }
            ],
            [
                'header' => 'UNOR',
                'value' => 'fipUnor',
                'options' => ['style' => 'width:20%'],
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
                <?= $this->render('_search', ['model' => $searchModel, 'opd' => $opd, 'sta' => $sta]); ?>
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
?>
