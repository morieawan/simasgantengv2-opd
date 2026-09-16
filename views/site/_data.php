<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;

?>
<div class="data-pns-index">

<?php 
$gridColumns = [
    [
        'class' => 'kartik\grid\SerialColumn',
        'header' => 'NO',
    ],
    [
        'attribute' => 'B_02',
        'label' => 'NIP',
    ],
    [
        'attribute' => 'B_03',
        'label' => 'NAMA',
        'value' => function($data){
            if($data['B_03'] === null) return '';
            else return $data['namaPegawai'];
        },
    ],
    [
        'attribute' => 'A_01',
        'label' => 'UNIT ORGANISASI',
        'value' => function($data){
            if($data['fipTablok'] === null) $tablok = '';
            else $tablok =  $data['fipTablok']['NM'];

            if($data['fipTablokb'] === null) $tablokb = '';
            else $tablokb =  $data['fipTablokb']['NALOK'];

            return $tablokb.' - '.$tablok;
       },
    ],
    [
        'attribute' => 'G_05B',
        'label' => 'JABATAN',
    ],
    [
          'class' => 'kartik\grid\ActionColumn',
          'template' => '{view}',
          'options' => ['style' => 'width: 5%'],
          'buttons' => [
            'view' => function ($url, $dt) {
                /*
                return Html::a('<span class="fas fa-eye"></span>',['view', 'id' => $dt['B_02']], 
                    ['title' => 'Update', 'class' => 'btn btn-link']
                );
                */
                return $this->render('_grid-form', ['model' => $dt]);
            },
        ],
    ],
];

echo GridView::widget([
    'dataProvider' => $data,
    'headerRowOptions' => ['style' => 'font-size:11pt;'],
    'columns' =>  $gridColumns,
    'summary' => '',
    'tableOptions' => ['style' => 'font-size:10pt'],
    'options' => [
        'style'=>'max-width:100%; min-height:100px; overflow: auto; word-wrap: break-word;'
    ],
    'striped' => false,
    'hover' => true,
    'responsiveWrap' => false,
]); 
?>

</div>