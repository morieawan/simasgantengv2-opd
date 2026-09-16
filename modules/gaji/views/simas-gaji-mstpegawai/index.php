<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
//use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\gaji\models\SimasGajiMstpegawaiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Simgaji';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="simas-gaji-mstpegawai-index">

    <h3><?= Html::encode($this->title) ?></h3>

    <div class="row">
        
        <?= Card(3, 'light', 'success', 'fa-sync', Html::button('<b>Sinkron Data Gaji</b>', ['value' => '', 'class' => 'btn btn-link', 'id' => 'sinkron-gaji']), 0, 0) ?>
        <?= Card(3, 'light', 'info', 'fa-users', 'Jumlah ASN', $data['jml'], 0) ?>
        <?= Card(3, 'light', 'danger', 'fa-users', 'Jumlah CPNS/PNS', $data['pns'], ($data['pns']/$data['jml']*100)) ?>
        <?= Card(3, 'light', 'warning', 'fa-users', 'Jumlah PPPK', $data['p3k'], ($data['p3k']/$data['jml']*100)) ?>
        
    </div>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'tableOptions' => ['style' => 'font-size:10pt'],
        'options' => [
            'class' => 'table-responsive',
            'style'=>'max-width:100%; min-height:100px; overflow: auto; word-wrap: break-word;'
        ],
        'showPageSummary' => false,
        'summary' => false,
        'striped' => true,
        'hover' => true,
        'responsiveWrap' => false,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

            'NIP',
            [
                'attribute' => 'NAMA',
                'value' => 'NamaPegawai',
            ],
            [
                'attribute' => 'KDSTAPEG',
                'value' => 'stapeg.NMSTAPEG',
            ],
            'KDPANGKAT',
            [
                'attribute' => 'KDSKPD',
                'value' => 'skpd.NMSKPD',
            ],
            [
                'attribute' => 'KDSATKER',
                'value' => 'satker.NMSATKER',
            ],
            //'GLRDEPAN',
            //'GLRBELAKANG',
            //'KDJENKEL',
            //'TEMPATLHR',
            //'TGLLHR:date',
            //'AGAMA',
            //'zakat_dg',
            //'PENDIDIKAN',
            //'TMTCAPEG:date',
            //'TMTSKMT:date',
            //'KDSTAWIN',
            //'JISTRI',
            //'JANAK',
            //'KDSTAPEG',
            //'TMTSTOP:date',
            //'MKGOLT',
            //'BLGOLT',
            //'GAPOK',
            //'MASKER',
            //'PRSNGAPOK',
            //'TMTTABEL:date',
            //'TMTKGB:date',
            //'TMTKGBYAD:date',
            //'KDESELON',
            //'TJESELON',
            //'KDFUNGSI1:integer',
            //'KDFUNGSI',
            //'TJFUNGSI',
            //'BUP:integer',
            //'KDSTRUK',
            //'TJSTRUK',
            //'KDGURU',
            //'TJGURU',
            //'KDBERAS',
            //'KDLANGKA',
            //'TJLANGKA',
            //'KDTKD',
            //'TJTKD',
            //'KDTERPENCIL',
            //'TJTERPENCIL',
            //'KDTJKHUSUS',
            //'TJKHUSUS',
            //'KDKORPRI',
            //'PKORPRI',
            //'KDKOPERASI',
            //'PKOPERASI',
            //'KDIRDHATA',
            //'PIRDHATA',
            //'TAPERUM',
            //'PSEWA',
            //'NODOSIR',
            //'KDCABTASPEN',
            //'KDSSBP',
            //'KDSKPD',
            //'KDSATKER',
            //'ALAMAT',
            //'KDDATI4',
            //'KDDATI3',
            //'KDDATI2',
            //'KDDATI1',
            //'NOTELP',
            //'NOKTP',
            //'NPWP',
            //'NPWPZ',
            //'NIPLAMA',
            //'KDHITUNG',
            //'KODEBYR',
            //'induk_bank',
            //'NOREK',
            //'TMTBERLAKU:date',
            //'CATATAN',
            //'KDJNSTRANS:integer',
            //'UPDSTAMP',
            //'INPUTER',
            //'kd_infaq:integer',
            //'NOKARPEG',
            //'jnsguru',
            //'EMAIL:email',
            //'KD_JNS_PEG:integer',
            'updated',

            [
                'class' => 'kartik\grid\ActionColumn',
                'template' => '{update} {delete}',
                'buttons' => [
                    'update' => function ($url) {
                        return Html::button('<span class="fas fa-pencil-alt"></span>',['value' => Url::to($url), 
                            'title' => 'Update', 'class' => 'showModalButton btn btn-link',
                        ]);
                    },
                ],
            ],
        ],
    ]); ?>

</div>
<?php
function Card($row, $warna, $bg, $icon, $text, $val, $persen){
    if($persen == 0) $nilai = number_format($val, '0', ',', '.');
    else $nilai = number_format($val, '0', ',', '.')." ( ". number_format($persen, '2', ',', '.'). "% )";

    if($val == 0) $nilai = '';

    echo "<div class=\"col-12 col-sm-6 col-md-$row\">
    <div class=\"info-box bg-$warna\">
        <span class=\"info-box-icon bg-$bg elevation-1\"><i class=\"fas $icon\"></i></span>
        <div class=\"info-box-content\">
            <span class=\"info-box-text\">$text</span>
            <span class=\"info-box-number\">$nilai</span>
        </div>
    </div>
</div>";
}

$urlData = Url::to(['/gaji/simas-gaji-mstpegawai/sinkron']);
$script = <<< JS

$('#sinkron-gaji').click(function(){
    var zipId = $.now();

    $.get("{$urlData}",{ zid : zipId },function(data){
        alert(data);
    });
});
JS;
$this->registerJs($script);
?>
