<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\DetailView;
use yii\bootstrap4\Modal;

/* @var $this yii\web\View */
/* @var $model app\modules\sitampan\models\PresHarian */

$this->title = 'Detail Hasil Presensi';
$this->params['breadcrumbs'][] = $this->title;

$pot_masuk = 0;
$pot_pulang = 0;
$jh = 0;
foreach ($dataProvider->models as $model) {
    if($model['kd_pr_masuk'] === null || $model['kd_pr_masuk'] == '')
        $pom = 2.5; else $pom = $model['pot_masuk'];
    
    if($model['kd_pr_pulang'] === null || $model['kd_pr_pulang'] == '')
        $pop = 2.5; else $pop = $model['pot_pulang'];
    
    $pot_masuk += $pom;
    $pot_pulang += $pop;
    $jh += 1 ;
}

$footerValue = $pot_masuk + $pot_pulang;
if($footerValue < 0) $footerValue = 0;

?>
<div class="pres-harian-view">
    <?= DetailView::widget([
        'model' => $data,
        'options' => ['style' => 'font-size: 10pt;', 'class' => 'table table-responsive'],
        'attributes' => [
            [
                'attribute' => 'nip',
                'label' => 'NIP',
            ],
            'nama',
            'jabatan',
            [
                'attribute' => 'unor',
                'label' => 'Unit Kerja',
            ],
            [
                'attribute' => 'bul',
                'label' => 'Periode',
                'value' => function($dt){
                    return $dt['bul']." ".$dt['tahun'];
                }
            ],
            [
                'attribute' => 'jk',
                'label' => 'Jadwal',
            ],
        ],
    ]) ?>

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
        'columns' => [
            [
                'class' => 'kartik\grid\SerialColumn', 
                'headerOptions' => ['style' => 'background-color: #dc3545; color: #FFFFFF;vertical-align:middle;'],
                'header' => 'NO',
            ],
            [
                'label' => 'Tanggal',
                'headerOptions' => ['style' => 'background-color: #dc3545; color: #FFFFFF;vertical-align:middle;'],
                'contentOptions' => ['style' => 'vertical-align:middle;'],
                'format' => 'raw',
                'value' => function($dat){
                    return \app\models\Fungsi::tglkomplit($dat['tgl']);
                },
                'pageSummary' => 'Jumlah',
            ],
            [
                'label' => 'Jam Kerja',
                'headerOptions' => ['style' => 'background-color: #dc3545; color: #FFFFFF;vertical-align:middle;'],
                'contentOptions' => ['style' => 'vertical-align:middle;'],
                'format' => 'raw',
                'value' => function($dat){
                    return  date('H:i:s', strtotime($dat['jd_masuk'])).'<br>'.
                            date('H:i:s', strtotime($dat['jd_pulang']));
                }
            ],
            [
                'label' => 'Kehadiran',
                'headerOptions' => ['style' => 'background-color: #dc3545; color: #FFFFFF;vertical-align:middle;'],
                'contentOptions' => ['style' => 'vertical-align:middle;'],
                'format' => 'raw',
                'value' => function($dat){
                    if($dat['pr_masuk'] === null) $mas = '';
                    else $mas = date('H:i:s', strtotime($dat['pr_masuk']));

                    if($dat['pr_pulang'] === null) $pul = '';
                    else $pul = date('H:i:s', strtotime($dat['pr_pulang']));

                    return  $mas.'<br>'.$pul;
                }
            ],
            [
                'label' => 'Ket',
                'headerOptions' => ['style' => 'background-color: #dc3545; color: #FFFFFF;vertical-align:middle;'],
                'contentOptions' => ['style' => 'vertical-align:middle;'],
                'format' => 'raw',
                'value' => function($dat){
                    return  $dat['kd_pr_masuk'].'<br>'.
                            $dat['kd_pr_pulang'];
                }
            ],
            [
                'label' => 'Potongan (%)',
                'headerOptions' => ['style' => 'background-color: #dc3545; color: #FFFFFF;vertical-align:middle;'],
                'contentOptions' => ['style' => 'vertical-align:middle;'],
                'format' => 'raw',
                'value' => function($dat){
                    if($dat['kd_pr_masuk'] === null || $dat['kd_pr_masuk'] == '')
                        $pm = 2.5; else $pm = $dat['pot_masuk'];
                    
                    if($dat['kd_pr_pulang'] === null || $dat['kd_pr_pulang'] == '')
                        $pp = 2.5; else $pp = $dat['pot_pulang'];
                    
                    return  $pm.'<br>'.$pp;
                },
                'pageSummary' => $footerValue,
            ],
        ],
    ]); ?>

</div>

