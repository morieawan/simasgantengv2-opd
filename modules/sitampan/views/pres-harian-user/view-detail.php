<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use yii\widgets\DetailView;
use yii\bootstrap4\Modal;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\modules\sitampan\models\PresHarian */

$this->title = 'Hasil Presensi Harian';
$this->params['breadcrumbs'][] = $this->title;

$pot_masuk = 0;
$pot_pulang = 0;
foreach ($dataProvider->models as $model) {
    $pot_masuk += $model['pot_masuk'];
    $pot_pulang += $model['pot_pulang'];
}

$footerValue = $pot_masuk + $pot_pulang;

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
            // 'jabatan',
            // [
            //     'attribute' => 'unor',
            //     'label' => 'Unit Kerja',
            // ],
            [
                'attribute' => 'jk',
                'label' => 'Jadwal',
            ],
            [
                'label' => 'Periode',
                'format' => 'raw',
                'value' => function($dt){
                    return $this->render('_search', [
                        'periode' => $dt['periode'],
                    ]);
                }
            ],
            [
                'label' => 'Cek',
                'format' => 'raw',
                'value' => function($dt){
                    return Html::button('<span class="fas fa-user-clock"></span> Data Mesin/ HP',[
                        'value' => Url::to([
                            'presensi', 'id' => $dt['nip'], 'bulan' => $dt['periode']
                        ]),
                        'title' => 'Data Presensi Tersimpan', 
                        'class' => 'showModalButton btn btn-danger',
                    ]);
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
                    return  $dat['pot_masuk'].'<br>'.
                            $dat['pot_pulang'];
                },
                'pageSummary' => $footerValue,
            ],
        ],
    ]); ?>

</div>

