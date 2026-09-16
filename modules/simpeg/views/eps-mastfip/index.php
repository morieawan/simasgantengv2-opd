<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
//use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\simpeg\models\EpsMastfipSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Simpeg BKPSDMD';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eps-mastfip-index">

    <h3><?= Html::encode($this->title) ?></h3>
    
    <div class="row">    
        <?= Card(3, 'light', 'success', 'fa-sync', Html::button('<b>Sinkron Data Simpeg</b>', ['value' => '', 'class' => 'btn btn-link', 'id' => 'sinkron-simpeg']), 0, 0) ?>
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
        'summary' => false,
        'striped' => true,
        'hover' => true,
        'responsiveWrap' => false,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

            // 'A_00',
            // 'A_01',
            // 'A_02',
            // 'A_03',
            // 'A_04',
            //'B_01',
            'B_02',
            [
                'attribute' => 'B_03',
                'value' => 'NamaPegawai',
            ],
            [
                'attribute' => 'E_04',
                'value' => 'golruAkhir.NAMA',
            ],
            [
                'attribute' => 'A_01',
                'value' => 'mastfipTablok.NM',
            ],
            [
                'attribute' => 'A_03',
                'value' => 'mastfipTablokb.NALOK',
            ],
            [
                'attribute' => 'B_10',
                'value' => 'pnsKedudukan.nama',
            ],
            // [
            //     'attribute' => 'B_08',
            //     'value' => 'pnsStatus.nama',
            // ],
            //'B_03A',
            //'B_03',
            //'B_03B',
            //'B_04',
            //'B_05:date',
            //'B_06:integer',
            //'B_07:integer',
            //'B_08:integer',
            //'B_09:integer',
            //'B_10:integer',
            //'B_11',
            //'B_12',
            //'B_13',
            //'B_14:integer',
            //'B_15',
            //'B_16',
            //'B_17',
            //'C_00',
            //'C_01:date',
            //'C_02',
            //'C_03:date',
            //'C_04:integer',
            //'D_00',
            //'D_01',
            //'D_02:date',
            //'D_03:integer',
            //'D_04:date',
            //'D_05:integer',
            //'E_01',
            //'E_02',
            //'E_03:date',
            //'E_04:integer',
            //'E_05:date',
            //'E_06',
            //'E_07',
            //'F_01:date',
            //'F_02',
            //'F_02A',
            //'F_03:integer',
            //'F_04',
            //'F_05',
            //'F_06:date',
            //'F_07:integer',
            //'G_01',
            //'G_02',
            //'G_03:date',
            //'G_04:date',
            //'G_05',
            //'G_05A:integer',
            //'G_05B',
            //'G_06:integer',
            //'G_07',
            //'G_08',
            //'G_09:date',
            //'G_10:date',
            //'G_11',
            //'G_11A',
            //'H_01:integer',
            //'H_02',
            //'H_03:integer',
            //'I_01:integer',
            //'I_02:date',
            //'I_03:integer',
            //'J_01',
            //'J_02',
            //'J_03:date',
            //'J_04',
            //'J_05',
            //'J_06',
            //'J_07:date',
            //'J_08',
            //'K_01',
            //'K_02',
            //'K_03:date',
            //'K_04:date',
            //'K_05:integer',
            //'K_06:integer',
            //'K_07',
            //'L_01:integer',
            //'L_02:integer',
            //'M_01',
            //'M_02',
            //'M_03:date',
            //'M_04:integer',
            //'M_05:date',
            //'M_06',
            //'M_07',
            //'Z_99:integer',
            //'no_telp',
            //'foto',
            //'nik',
            //'email:email',
            //'updated',
            //'email_gov:email',
            //'kartu_asn',

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

$urlData = Url::to(['/simpeg/eps-mastfip/sinkron']);
$script = <<< JS

$('#sinkron-simpeg').click(function(){
    var zipId = $.now();

    $.get("{$urlData}",{ zid : zipId },function(data){
        alert(data);
    });
});
JS;
$this->registerJs($script);
?>
