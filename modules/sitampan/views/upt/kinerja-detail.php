<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\sitampan\models\KinHarianSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kinerja Harian ASN';
$this->params['breadcrumbs'][] = $this->title;

$target = 0;
$realisasi = 0;
$nilai = 0;
foreach ($dataProvider->models as $model) {
    $target = $target + $model['target_waktu_h'];
    $realisasi = $realisasi + $model['real_waktu_h'];
    $nilai = $nilai + $model['ok_waktu_h'];
}

?>
<div class="kin-harian-index">
    
    <?= DetailView::widget([
        'model' => $data,
        'options' => ['style' => 'font-size: 10pt;', 'class' => 'table table-responsive'],
        'attributes' => [
            [
                'attribute' => 'nip',
                'label' => 'NIP',
            ],
            'nama',
            [  
                'attribute' => 'penilai_nip',
                'label' => 'NIP Atasan',
            ],
            [  
                'attribute' => 'penilai_nama',
                'label' => 'Nama Atasan',
            ],
        ],
    ]) ?>
    
    <?=  Html::a('<i class="fas fa-arrow-alt-circle-left"></i> Kembali', Url::previous(), ['title' => 'Kembali', 'class' => 'btn bg-olive float-left mb-2', 'id' => 'search']); ?>

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
            ['class' => 'kartik\grid\SerialColumn'],
            [
                'header' => 'Tgl',
                'headerOptions' => ['style' => 'vertical-align: middle;width: 15%'],
                'contentOptions' => ['style' => 'vertical-align: middle;'],
                'format' => 'raw',
                'pageSummary' => 'Jumlah',
                'value' => function($dt){
                    return \app\models\Fungsi::tglkomplit($dt['tgl']);
                },
                'group' => true, 
            ],
            [
                'attribute' => 'uraian_keg_h',
                'headerOptions' => ['style' => 'vertical-align: middle;width: 44%'],
                'contentOptions' => ['style' => 'vertical-align: middle;'],
                'format' => 'raw',
            ],
            [
                'header' => 'Target',
                'headerOptions' => ['style' => 'vertical-align: middle; width: 12%'],
                'contentOptions' => ['style' => 'vertical-align: middle;'],
                'format' => 'raw',
                'value' => function($dt){
                    return $dt['target_kuan_h'].' '.$dt['target_output_h'].'<br>'.$dt['target_waktu_h'].' menit';
                },
                'pageSummary' => \app\models\Angka::ribuan($target). ' menit',
            ],
            [
                'header' => 'Realisasi',
                'headerOptions' => ['style' => 'vertical-align: middle; width: 12%'],
                'contentOptions' => ['style' => 'vertical-align: middle;'],
                'format' => 'raw',
                'value' => function($dt){
                    return $dt['real_kuan_h'].' '.$dt['real_output_h'].'<br>'.$dt['real_waktu_h'].' menit';
                },
                'pageSummary' => \app\models\Angka::ribuan($realisasi). ' menit',
            ],
            [
                'header' => 'Persetujuan',
                'headerOptions' => ['style' => 'vertical-align: middle; width: 12%'],
                'contentOptions' => ['style' => 'vertical-align: middle;'],
                'format' => 'raw',
                'value' => function($dt){
                    return $dt['ok_kuan_h'].' '.$dt['ok_output_h'].'<br>'.$dt['ok_waktu_h'].' menit';
                },
                'pageSummary' => \app\models\Angka::ribuan($nilai). ' menit',
            ],
        ],
    ]); ?>

    <?=  Html::a('<i class="fas fa-arrow-alt-circle-left"></i> Kembali', Url::previous(), ['title' => 'Kembali', 'class' => 'btn bg-olive float-left', 'id' => 'search']); ?>
    
    <br><br>

</div>
