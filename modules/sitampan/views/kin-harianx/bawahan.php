<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use kartik\depdrop\DepDrop;
use yii\helpers\ArrayHelper;
use kartik\number\NumberControl;
use kartik\select2\Select2;
use kartik\datecontrol\DateControl;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\models\kinerja\KinHarianSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Penilaian Kinerja';
$this->params['breadcrumbs'][] = $this->title;

$bulan = $searchModel['bulan'];
$tahun = $searchModel['tahun'];
$nexbul = $searchModel['bulan']+1;

if($nexbul == 13){
    $nexbul = 1;
    $tahun = $tahun + 1;
}

?>
<div class="kin-harian-index">

    <div class="row ml-auto mr-auto">
        <?= $this->render('_search_nil', ['model' => $searchModel, 'modl' => $modl]); ?>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'tableOptions' => ['style' => 'font-size:10pt'],
        'options' => [
            'class' => 'table-responsive',
            'style'=>'max-width:100%; min-height:100px; overflow: auto; word-wrap: break-word;'
        ],
        //'headerRowOptions' => ['style' => 'background-color: #eef4a6'],
        'showPageSummary' => true,
        'summary' => false,
        'responsiveWrap' => false,
        'striped' => true,
        'hover' => true,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

            [
                'attribute' => 'tgl',
                'format' => 'raw',
                'width' => '20%',
                'value' => function($data){
                    return \app\models\Fungsi::tglkomplit($data['tgl']);
                },
                'pageSummary' => 'Jumlah',
                'group' => true,  // enable grouping
                'groupFooter' => function ($model, $key, $index, $widget) { // Closure method
                    return [
                        'mergeColumns' => [[1,3]], // columns to merge in summary
                        'content' => [             // content to show in each summary cell
                            1 => 'Target jumlah menit tanggal '.\app\models\Fungsi::tgldmy($model['tgl']),
                            4 => GridView::F_SUM,
                            6 => GridView::F_SUM,
                        ],
                        'contentFormats' => [      
                            4 => ['format' => 'number', 'decimals' => 0],
                            6 => ['format' => 'number', 'decimals' => 0],
                        ],
                        'options' => ['class' => 'info table-info','style' => 'font-weight:bold;']
                    ];
                }
            ],
            [
                'attribute' => 'uraian_keg_h',
                'format' => 'html',
                'width' => '30%',
                'value' => function($data){
                    return $data['uraian_keg_h'].'<br>'.$data['penilaian'];
                }
            ],
            //'target_ak_h',
            [
                'attribute' => 'target_kuan_h',
                'width' => '10%',
                'format' => 'raw',
                'value' => function($data){
                    return $data['target_kuan_h'].' '.$data['target_output_h'];
                }
            ],
            [
                'attribute' => 'target_waktu_h',
                'width' => '10%',
                'format' => 'raw',
                'pageSummary' => true,
                'pageSummaryFunc' => function ($data) {                  
                    return array_sum($data).' Menit';
                },
                'value' => function($data){
                    return $data['target_waktu_h'].' Menit';
                }
            ],
            [
                'attribute' => 'real_kuan_h',
                'width' => '10%',
                'format' => 'raw',
                'value' => function($data){
                    $x = $data['real_kuan_h'];
                    if($x != 0)
                        $x = $x.' '.$data['real_output_h'];                    
                    return $x;
                }
            ],
            [
                'attribute' => 'real_waktu_h',
                'width' => '10%',
                'format' => 'raw',
                'pageSummary' => true,
                'pageSummaryFunc' => function ($data) {                   
                    return array_sum($data).' menit';
                },
                'value' => function($data){
                    $x = $data['real_waktu_h'];
                    if($x !== null && $x != 0)
                        $x = $x.' Menit'; 
                    return $x;    
                }
            ],
            [
                'class' => 'kartik\grid\ActionColumn',
                'width' => '5%',
                'template' => '{update-nil}',
                'buttons' => [
                    'update-nil' => function ($url, $model) use ($bulan, $nexbul, $tahun) {
                        if($model['ok_kuan_h'] == 0 && $model['ok_waktu_h'] == 0){
                            if($model['real_kuan_h'] != 0 && $model['real_waktu_h'] != 0){
                                $x =  Html::button('<span class="fas fa-check"></span>',['value' => Url::to($url), 
                                'title' => 'Penilaian', 'class' => 'showModalButton btn btn-link',
                                'style' => 'color : #28a745',
                                ]);
                            }else{
                                $x = '<font size="-1">Belum Direalisasi</font>';
                            }
                        }else{
                            $x = ' '.Html::a('<span class="fas fa-times"></span>',['hapus-nil', 'id' => $model['id']],
                            [ 
                                'title' => 'Batalkan Penilaian', 
                                'class' => 'tombol-hapus',
                                'style' => 'color : #dc3545',
                                'data' => [
                                    'method' => 'post',
                                ],
                            ]);
                        }
                        return $x;
                    },
                ],
            ],
        ],
    ]); ?>

</div>
