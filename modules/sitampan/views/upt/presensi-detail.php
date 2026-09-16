<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\DetailView;
use yii\bootstrap4\Modal;

/* @var $this yii\web\View */
/* @var $model app\modules\sitampan\models\PresHarian */

$this->title = 'Detail Hasil Presensi';
$this->params['breadcrumbs'][] = $this->title;

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
        'showPageSummary' => false,
        'summary' => '',
        'striped' => true,
        'hover' => true,
        'responsiveWrap' => false,
        'columns' => [
            [
                'class' => 'kartik\grid\SerialColumn', 
                'headerOptions' => ['style' => 'vertical-align:middle;'],
                'header' => 'NO',
            ],
            [
                'label' => 'Tanggal',
                'headerOptions' => ['style' => 'vertical-align:middle;'],
                'contentOptions' => ['style' => 'vertical-align:middle;'],
                'format' => 'raw',
                'value' => function($dat){
                    return \app\models\Fungsi::tglkomplit($dat['tgl']);
                },
            ],
            [
                'label' => 'Jam Kerja',
                'headerOptions' => ['style' => 'vertical-align:middle;'],
                'contentOptions' => ['style' => 'vertical-align:middle;'],
                'format' => 'raw',
                'value' => function($dat){
                    return  date('H:i:s', strtotime($dat['jd_masuk'])).'<br>'.
                            date('H:i:s', strtotime($dat['jd_pulang']));
                }
            ],
            [
                'label' => 'Kehadiran',
                'headerOptions' => ['style' => 'vertical-align:middle;'],
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
                'headerOptions' => ['style' => 'vertical-align:middle;'],
                'contentOptions' => ['style' => 'vertical-align:middle;'],
                'format' => 'raw',
                'value' => function($dat){
                    return  $dat['kd_pr_masuk'].'<br>'.
                            $dat['kd_pr_pulang'];
                }
            ],
        ],
    ]); ?>

</div>

