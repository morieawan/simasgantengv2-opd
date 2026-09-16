<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
//use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\sitampan\models\PreskinAsnSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data ASN';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="preskin-asn-index">
    
    <?= "<b>$namapd</b>" ?>
    
    <?=  Html::a('<i class="fas fa-search"></i> Cari Data', '#', ['title' => 'Cari Data', 'class' => 'btn btn-primary float-right mb-2', 'id' => 'search']); ?>

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
                'options' => ['style' => 'width:20%'],
                'value' => function($dt){
                    return $dt['nip'].'<br>'.$dt['fipNama'].'<br>'.$dt['fipGol'];
                }
            ],
            [
                'attribute' => 'nip',
                'header' => 'JABATAN<br>KELAS<br>JADWAL KERJA',
                'format' => 'raw',
                'options' => ['style' => 'width:25%'],
                'value' => function($dt){
                    if($dt['asnJadwalKerja'] === null) $jk = $dt['kode_jadwal'];
                    else $jk = $dt['asnJadwalKerja']['jenis'];
                    return $dt['fipJabatan'].'<br>'.$dt['asnKelas']['kelas'].'<br>'.$jk;
                }
            ],
            [
                'attribute' => 'status',
                'header' => 'STATUS<br>TMT STOP',
                'format' => 'raw',
                'options' => ['style' => 'width:15%'],
                'value' => function($dt){
                    if($dt['status'] == 0) $st = 0;
                    else $st = $dt['stapeg']['NMSTAPEG'];
                    return $st.'<br>'.$dt['tmt_stop'];
                }
            ],
            [
                'header' => 'UNOR',
                'value' => 'fipUnor',
                'options' => ['style' => 'width:30%'],
            ],

            // 'B_02',
            // 'B_03',
            // [
            //     'attribute' => 'A_01',
            //     'format' => 'raw',
            //     'value' => function($dt){
            //         return $dt['unorInduk'];
            //     }
            // ],
            // [
            //     'attribute' => 'A_04',
            //     'format' => 'raw',
            //     'value' => function($dt){
            //         return $dt['unorBidang'];
            //     }
            // ],
            // [
            //     'attribute' => 'A_04',
            //     'format' => 'raw',
            //     'value' => function($dt){
            //         return $dt['unor'];
            //     }
            // ],
            [
                'class' => 'kartik\grid\ActionColumn',
                'template' => '{view}',
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
