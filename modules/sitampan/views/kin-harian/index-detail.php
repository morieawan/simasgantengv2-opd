<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use app\models\Angka;
//use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\sitampan\models\KinHarianSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kinerja Harian ASN';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kin-harian-index">

    <?=  Html::a('<i class="fas fa-arrow-alt-circle-left"></i> Kembali', Url::previous(), ['title' => 'Kembali', 'class' => 'btn btn-primary float-right mb-2', 'id' => 'search']); ?>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'tableOptions' => ['style' => 'font-size:10pt'],
        'options' => [
            'class' => 'table-responsive',
            'style'=>'max-width:100%; min-height:100px; overflow: auto; word-wrap: break-word;'
        ],
        'showPageSummary' => true,
        'summary' => '',
        'striped' => true,
        'hover' => true,
        'responsiveWrap' => false,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
            [
                'header' => 'NIP<br>Nama<br>Unit Kerja',
                'headerOptions' => ['style' => 'vertical-align: middle;'],
                'contentOptions' => ['style' => 'font-size:9pt;vertical-align: middle;'],
                'format' => 'raw',
                'value' => function($dt){
                    return $dt['nip'].'<br>'.$dt['nama'];
                }
            ],
            [
                'header' => 'Tgl',
                'headerOptions' => ['style' => 'vertical-align: middle;'],
                'contentOptions' => ['style' => 'text-align:center;font-size:9pt;vertical-align: middle;'],
                'format' => 'raw',
                'value' => function($dt){
                    return $dt['tgl'];
                }
            ],
            [
                'attribute' => 'uraian_keg_h',
                'headerOptions' => ['style' => 'vertical-align: middle;'],
                'contentOptions' => ['style' => 'font-size:9pt;vertical-align: middle;'],
                'format' => 'raw',
                'pageSummary'=> 'JUMLAH WAKTU',
            ],
            [
                'header' => 'Target',
                'attribute' => 'target_waktu_h',
                'headerOptions' => ['style' => 'vertical-align: middle;'],
                'contentOptions' => ['style' => 'font-size:9pt;vertical-align: middle;'],
                'format' => 'raw',
                'value' => function($dt){
                    return $dt['target_kuan_h'].' '.$dt['target_output_h'].'<br>'.$dt['target_waktu_h'].' menit<br><br>'.$dt['tgl_target'];
                },
                'pageSummary'=> Angka::ribuan($sum_target).' Menit',
            ],
            [
                'header' => 'Realisasi',
                'headerOptions' => ['style' => 'vertical-align: middle;'],
                'contentOptions' => ['style' => 'font-size:9pt;vertical-align: middle;'],
                'format' => 'raw',
                'value' => function($dt){
                    return $dt['real_kuan_h'].' '.$dt['real_output_h'].'<br>'.$dt['real_waktu_h'].' menit<br><br>'.$dt['tgl_real'];
                },
                'pageSummary'=> Angka::ribuan($sum_real).' Menit',
            ],
            [
                'header' => 'Persetujuan',
                'headerOptions' => ['style' => 'vertical-align: middle;'],
                'contentOptions' => ['style' => 'font-size:9pt;vertical-align: middle;'],
                'format' => 'raw',
                'value' => function($dt){
                    return $dt['ok_kuan_h'].' '.$dt['ok_output_h'].'<br>'.$dt['ok_waktu_h'].' menit<br><br>'.$dt['tgl_ok'];
                },
                'pageSummary'=> Angka::ribuan($sum_ok).' Menit',
            ],
            [
                'header' => 'Penilai/ Atasan',
                'headerOptions' => ['style' => 'vertical-align: middle;'],
                'contentOptions' => ['style' => 'font-size:9pt;vertical-align: middle;'],
                'format' => 'raw',
                'value' => function($dt){
                    return $dt['penilai_nip'].'<br>'.$dt['penilai_nama'];
                }
            ],
        ],
    ]); ?>


</div>
