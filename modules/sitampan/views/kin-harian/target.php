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

$this->title = 'Target Harian';
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

    <p class="mr-auto" style="color: red">
        * Target Kinerja tidak bisa dihapus apabila Realisasi telah dientri
    </p>

    <div class="row ml-auto mr-auto">
        <?= $this->render('_search', ['model' => $searchModel]); ?>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'tableOptions' => ['style' => 'font-size:10pt'],
        'options' => [
            'class' => 'table-responsive',
            'style'=>'max-width:100%; min-height:100px; overflow: auto; word-wrap: break-word;'
        ],
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
                'width' => '18%',
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
                        ],
                        'contentFormats' => [      
                            4 => ['format' => 'number', 'decimals' => 0],
                        ],
                        'options' => ['class' => 'info table-info','style' => 'font-weight:bold;']
                    ];
                }
            ],
            [
                'attribute' => 'uraian_keg_h',
                'format' => 'html',
                'width' => '40%',
                'value' => function($data){
                    return $data['uraian_keg_h'].'<br>'.$data['penilaian'];
                }
            ],
            //'target_ak_h',
            [
                'attribute' => 'target_kuan_h',
                'width' => '12%',
                'format' => 'raw',
                'value' => function($data){
                    return $data['target_kuan_h'].' '.$data['target_output_h'];
                }
            ],
            [
                'attribute' => 'target_waktu_h',
                'width' => '12%',
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
                'class' => 'kartik\grid\ActionColumn',
                'width' => '12%',
                'template' => '{update} {delete}',
                'buttons' => [
                    'update' => function ($url, $model) use ($bulan, $nexbul, $tahun) {
                        if($model['ok_kuan_h'] == 0 && $model['ok_waktu_h'] == 0){
                            if($model['real_kuan_h'] == 0 && $model['real_waktu_h'] == 0){
                                return Html::button('<span class="fas fa-pencil-alt"></span>',['value' => Url::to($url), 
                                    'title' => 'Update', 'class' => 'showModalButton btn btn-link',
                                ]);
                            }else{
                                return '<font size="-1">Sudah Direalisasi</font>';
                            }
                        }else return 'Sudah Dinilai';
                    },
                    'delete' => function ($url, $model) use ($bulan, $nexbul, $tahun) {
                        if($model['ok_kuan_h'] == 0 && $model['ok_waktu_h'] == 0){
                            if($model['real_kuan_h'] == 0 && $model['real_waktu_h'] == 0){
                                return Html::a('<span class="fas fa-trash-alt"></span>',['delete', 'id' => $model['id']],
                                [ 
                                    'title' => 'Hapus Target Harian', 
                                    'class' => 'tombol-hapus',
                                    'style' => 'color : #dc3545',
                                    'data' => [
                                        'method' => 'post',
                                    ],
                                ]);
                            }else return '';
                        }else return '';
                    },
                ],
            ],
        ],
    ]); ?>

</div>
