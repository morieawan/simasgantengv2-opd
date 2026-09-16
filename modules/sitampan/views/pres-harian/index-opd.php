<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use yii\bootstrap4\Modal;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\kinerja\models\TabPresensiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Presensi Pegawai';
$this->params['breadcrumbs'][] = $this->title;

// if($bln === null) $bln = date('n');
// if($thn === null) $thn = date('Y');
// if($tcari === null) $tcari = '';

$bln=1;$thn=2024;

$grid = [
    ['class' => 'kartik\grid\SerialColumn'],
    [
        'attribute' => 'nama',
        'label' => 'PEGAWAI',
        'headerOptions' => ['style' => 'width:18%;vertical-align: top;font-size:8pt;'],
        'format' => 'raw',
        'value' => function($data){
            $pegawai = $data['nama']
                .'<br>'.$data['nip'];
            return $pegawai;
        },
    ],
    [
        'label' => '',
        'headerOptions' => ['style' => 'vertical-align: middle;font-size:8pt;'],
        'options' => ['style' => 'vertical-align: middle;'],
        'format' => 'raw',
        'value' => /*function($data) use ($bln, $thn){
            if($data['presensi'] != []){
                return Html::a('<i class="fas fa-sync-alt"></i>', [
                    'sinkron',
                    'id' => $data['idpns'],
                    'bulan' => $bln,
                    'tahun' => $thn,
                ],
                ['title' => 'Sinronkan Data Presensi', 'class' => 'btn-xs btn-success']);
            }else return '';
        },*/
        '',
    ],
    [
        'label' => '',
        'headerOptions' => ['style' => 'vertical-align: top;font-size:8pt;'],
        'format' => 'raw',
        'value' => function($data) use ($bln, $thn){
            if($data['presensi'] != []){
                return Html::button('<i class="fas fa-file-alt"></i>',['value' => Url::to([
                    '/kinerja/tab-presensi/view-asn', 
                    'id' => $data['idpns'],
                    'bulan' => $bln,
                    'tahun' => $thn,
                ]), 'title' => 'Detail', 'class' => 'showModalButton btn-xs btn-primary']);
            }else return '';
        },
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
        'value' => function($data) use ($tgl, $hr){
            $arr = $data['presensi'];
            foreach($arr as $key => $val){
               if($val['tgl'] == $tgl){
                   if($val['kd_pr_masuk'] !== null && $val['kd_pr_masuk'] !== null)
                    return $val['kd_pr_masuk'].'<br>'.$val['kd_pr_pulang']; 
               }//else return '<font color="red">L</font>';
            }
        }
    ];
}

?>
<div class="tab-presensi-index" id ="tabel">

    <?php //echo $this->render('_search-presensi-opd', ['bln' => $bln, 'thn' => $thn, 'tcari' => $tcari]); ?>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'tableOptions' => ['style' => 'font-size:8pt','class' => 'table table-striped table-hover table-condensed'],
        'options' => ['class' => 'inner'],
        'showPageSummary' => true,
        'summary' => false,
        'striped' => true,
        'hover' => true,
        'responsiveWrap' => false,
        'beforeHeader' => [
            [
                'columns' => [
                    ['content' => '', 'options' => ['colspan' => 3, 'class' => 'text-center']],
                    ['content' => 'TANGGAL', 'options' => ['colspan' => $hr, 'class' => 'text-center', 'style' => 'font-size:8pt']],
                ],
            ]
        ],
        'columns' => $grid,
    ]); ?>


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
?>