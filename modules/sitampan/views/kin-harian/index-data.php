<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\Json;
use kartik\grid\GridView;
use yii\bootstrap4\Modal;
use app\models\Angka;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\sitampan\models\KinHarianSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kinerja ASN';
$this->params['breadcrumbs'][] = $this->title;

$grid = [
    [
        'class' => 'kartik\grid\SerialColumn', 
        'header' => 'No', 
    ],
    [
        'attribute' => 'nip',
        'header' => 'NIP<br>NAMA<br>UNOR',
        'format' => 'raw',
        'options' => ['style' => 'width:40%;'],
        'value' => function($dt){
            return $dt['nip'].'<br>'.$dt['nama'].'<br>'.$dt['unor'];
        }
    ],
    [
        'header' => 'NIP Atasan<br>Nama Atasan',
        'headerOptions' => ['style' => 'vertical-align: middle;'],
        'options' => ['style' => 'text-align:center;font-size:9pt;vertical-align: middle;'],
        'format' => 'raw',
        'value' => function($dt){
            return $dt['nip_atasan'].'<br>'.$dt['nama_atasan'];
        }
    ],
    [
        'header' => 'Target (menit)',
        'headerOptions' => ['style' => 'vertical-align: middle;'],
        'contentOptions' => ['style' => 'text-align:center;font-size:9pt;vertical-align: middle;'],
        'format' => 'raw',
        'value' => function($dt){
            return Angka::ribuan($dt['target']);
        }
    ],[
        'header' => 'Realisasi (menit)',
        'headerOptions' => ['style' => 'vertical-align: middle;'],
        'contentOptions' => ['style' => 'text-align:center;font-size:9pt;vertical-align: middle;'],
        'format' => 'raw',
        'value' => function($dt){
            return Angka::ribuan($dt['realisasi']);
        }
    ],
    [
        'header' => 'Hasil/ Penilaian (menit)',
        'headerOptions' => ['style' => 'vertical-align: middle;'],
        'contentOptions' => ['style' => 'text-align:center;font-size:9pt;vertical-align: middle;'],
        'format' => 'raw',
        'value' => function($dt){
            return Angka::ribuan($dt['hasil']);
        }
    ],
    [
        'label' => 'Detail',
        'headerOptions' => ['style' => 'vertical-align: middle;'],
        'options' => ['style' => 'font-size:9pt;vertical-align: middle;'],
        'format' => 'raw',
        'value' => function ($dt) use ($thn, $bln){
            // return Html::button('<span class="fas fa-tasks"></span>',[
            //     'value' => Url::to([
            //         'detail', 'id' => $dt['nip'], 'bulan' => $bln, 'tahun' => $thn
            //     ]),
            //     'title' => 'Detail Hasil Kinerja', 
            //     'class' => 'showModalButton btn btn-link', //'style' => 'color : #dc3545'
            // ]);

            return Html::a('<span class="fas fa-tasks"></span>',
                ['detail', 'id' => $dt['nip'], 'bulan' => $bln, 'tahun' => $thn],
                ['title' => 'Detail Hasil Kinerja', 'class' => 'btn btn-link']);
        }
    ],
];

?>
<div class="kin-harian-index">

    <?= "<b>$namapd</b>" ?>
    <?=  Html::a('<i class="fas fa-search"></i> Cari Data', '#', ['title' => 'Cari Data', 'class' => 'btn btn-primary float-right mb-2', 'id' => 'search']); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'tableOptions' => ['style' => 'font-size:9pt'],
        'options' => [
            'class' => 'table-responsive',
            'style'=>'max-width:100%; min-height:100px; overflow: auto; word-wrap: break-word;'
        ],
        'showPageSummary' => false,
        'summary' => '',
        'striped' => true,
        'hover' => true,
        'responsiveWrap' => false,
        'beforeHeader' => [
            [
                'columns' => [
                    ['content' => "$bul $thn", 'options' => ['colspan' => 7, 'class' => 'text-center', 'style' => 'font-size:10pt;']],
                ],
            ]
        ],
        'columns' => $grid,
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
                <?= $this->render('_search-pres-asn', ['model' => $searchModel, 'opd' => $opd, 'bln' => $bln, 'thn' => $thn]); ?>
            </div>
        </div>
    </div>
</div>

<?php
    Modal::begin([
        'title' => Html::encode($this->title),
        'headerOptions' => ['class' => 'bg-primary'],
        'id' => 'modal',
        'size' => 'modal-lg',
    ]);

    echo "<div id='modalContent'></div>";
    Modal::end();


$script = <<< JS

$('#search').click(function(){
	$("#cari-block").modal('show');
});
JS;
$this->registerJs($script);
?>
