<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\sitampan\models\PresHarian */

$this->title = 'Data Presensi Tersimpan';
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
        'striped' => false,
        'hover' => true,
        'responsiveWrap' => false,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn', 'header' => 'NO'],
            [
                'attribute' => 'checktime',
                'label' => 'Tanggal',
                'format' => 'raw',
                'value' => function($dat){
                    return \app\models\Fungsi::tglkomplit($dat['checktime']);
                },
                'pageSummary' => 'Jumlah',
                'group' => true,  // enable grouping
            ],
            [
                'attribute' => 'checktime',
                'label' => 'Jam Presensi',
                'format' => 'raw',
                'value' => function($dat){
                    return date('H:i:s', strtotime($dat['checktime']));
                }
            ],
            [
                'attribute' => 'light',
                'label' => 'Keterangan',
                'format' => 'raw',
                'value' => function($dat){
                    return $dat['light'].' '.$dat['sn'];
                }
            ],
        ],
    ]); ?>

</div>
