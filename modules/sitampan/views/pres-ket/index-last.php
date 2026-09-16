<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
//use kartik\datecontrol\DateControl;
use app\models\Fungsi;
//use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\kinerja\models\MasKetSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Keterangan Absensi';
$this->params['breadcrumbs'][] = $this->title;

$nexbul=$bulan + 1;
if($nexbul == 13){
    $nexbul = 1;
    $tahun = $tahun + 1;
}

?>
<div class="mas-ket-index">

    <div class="row ml-auto mr-auto">
        <?= $this->render('_search', ['model' => $searchModel]); ?>
    </div>

    <?php
        $aksi = [
            'class' => 'kartik\grid\ActionColumn',
            'template' => '{update}',
            'buttons' => [
                'update' => function ($url){
                    return '';
                },
            ],
        ];
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'tableOptions' => ['style' => 'font-size:10pt'],
        'options' => [
            'class' => 'table-responsive',
            'style'=>'max-width:100%; min-height:100px; overflow: auto; word-wrap: break-word;'
        ],
        'showPageSummary' => true,
        'summary' => false,
        'striped' => true,
        'hover' => true,
        'responsiveWrap' => false,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

            //'id:integer',
            //'jenis_ket:integer',
            [
                'attribute' => 'jenis_ket',
                'format' => 'raw',
                'headerOptions' => ['style' => 'width:10%'],
                'value' => function($data){
                    if($data['jenisSuket'] !== null) return $data['jenisSuket']['jenis_ket'];
                    else return '';
                },
                /*
                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'jenis_ket',
                    'data' => ArrayHelper::map($jenis,'id','jenis_ket'),
                    'language' => 'id',
                    'options' => ['placeholder' => '-Pilih-'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]),
                */
            ],
            [
                'attribute' => 'tgl_surat',
                'label' => 'Surat Keterangan',
                'format' => 'raw',
                //'headerOptions' => ['style' => 'width:30%'],
                'value' => function($data){
                    return '<b>Nomor</b> : '.$data['no_surat'].
                        '<br><b>Tanggal</b>` : '.\app\models\Fungsi::tglpanjang($data['tgl_surat']).
                        '<br><b>Tentang</b> : '.$data['detail'];
                }
            ],
            [
                'attribute' => 'tgl_awal',
                'label' => 'Tanggal Berlaku',
                'contentOptions' => ['style' => 'text-align:center;'],
                'format' => 'raw',
                'headerOptions' => ['style' => 'width:10%'],
                /*'filter' => DateControl::widget([
                    'type' => DateControl::FORMAT_DATE,
                    'name' => 'date_tgl_awal',
                ]),*/
                'value' => function($data){
                    if($data['tgl_awal'] == $data['tgl_akhir']){
                        return Fungsi::tgldmy($data['tgl_awal']);
                    }else{
                    return Fungsi::tgldmy($data['tgl_awal'])
                        .'<br>s.d<br>'.Fungsi::tgldmy($data['tgl_akhir']);
                    }
                }
            ],
            [
                'attribute' => 'nip',
                'label' => 'Pegawai',
                'format' => 'raw',
                'headerOptions' => ['style' => 'width:30%'],
                'value' => function($data){
                    if($data['nip'] !== null){
                        $nip = explode(";", $data['nip']);
                        $pegawai = '';
                        foreach($nip as $nips){
                            if($nips != '' && $nips != ' '){
                                $pns = \app\models\EpsMastfip::find()
                                    ->select(['B_02', 'B_03', 'B_03A', 'B_03B'])->where(['B_02' => $nips])->one();
                                    if($pns !== null){
                                        if($pns['namaPegawai'] !== null) $pegawai = $pegawai.$nips.' '.$pns['namaPegawai'].'<br>';
                                        else $pegawai = $pegawai.'-'.$nips.'<br>';
                                    }else $pegawai = $pegawai.'-'.$nips.'<br>';
                            }
                        }
                    }else{
                        //if($data['jenis_ket'] == 3 && $pegawai == '') $pegawai = 'Semua ASN pada OPD ini';
                        //else $pegawai = '';
                        $pegawai = '';
                    }

                    return $pegawai;
                }
            ],
            $aksi,
        ],
    ]); ?>


</div>
