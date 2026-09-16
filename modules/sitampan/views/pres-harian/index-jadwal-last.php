<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\sitampan\models\PreskinAsnSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Jadwal Kerja ASN';
$this->params['breadcrumbs'][] = $this->title;

$grid = [
    ['class' => 'kartik\grid\SerialColumn', 'header' => 'NO'],
    [
        'attribute' => 'nip',
        'header' => 'NIP<br>NAMA<br>UNOR',
        'format' => 'raw',
        'options' => ['style' => 'width:20%'],
        'value' => function($dt){
            return $dt['nip'].'<br>'.$dt['nama'].'<br>'.$dt['unor'];
        }
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'template' => '{update-jadwal}',
        'options' => ['style' => 'text-align:center;font-size:6pt;'],
        'buttons' => [
            'update-jadwal' => function ($url, $model) use ($thn, $bln){
                return '';
            },
        ],
    ],
];

for($hr=1; $hr<=cal_days_in_month(CAL_GREGORIAN, $bln, $thn); $hr++) {
    $tgl = $thn.'-'.$bln.'-'.$hr;
    $tgl = strftime("%Y-%m-%d",strtotime($tgl));
    $grid[] = [
        'label' => $hr,
        'headerOptions' => ['style' => 'text-align:center;'],
        'options' => ['style' => 'text-align:center;font-size:8pt;'],
        'format' => 'raw',
        'value' => function($dt) use ($tgl, $hr){
            $arr = $dt['presensi'];
            foreach($arr as $key => $val){
               if($val['tgl'] == $tgl){
                    return date('H:i', strtotime($val['jd_masuk']))
                    .'<br>'.date('H:i', strtotime($val['jd_pulang']));
               }//else return '<font color="red">L</font>';
            }
        }
    ];
}

?>
<div class="preskin-asn-index">

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
        //'filterModel' => $searchModel,
        'beforeHeader' => [
            [
                'columns' => [
                    ['content' => "$bul $thn", 'options' => ['colspan' => 3, 'class' => 'text-center', 'style' => 'font-size:10pt']],
                    ['content' => 'TANGGAL', 'options' => ['colspan' => 3+$hr, 'class' => 'text-center', 'style' => 'font-size:8pt']],
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
                <?= $this->render('_search', ['model' => $searchModel, 'opd' => $opd, 'bln' => $bln, 'thn' => $thn]); ?>
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
