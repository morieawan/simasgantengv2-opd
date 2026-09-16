<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
//use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\sitampan\models\PreskinTppHitungSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Preskin Tpp Hitungs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="preskin-tpp-hitung-index">

    <p>
        <?=  Html::button('<i class="fas fa-plus-circle"></i> Tambah', ['value' => Url::to(['create']), 'title' => 'Tambah Preskin Tpp Hitung', 'class' => 'showModalButton btn btn-success']); ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'tableOptions' => ['style' => 'font-size:10pt'],
        'options' => [
            'class' => 'table-responsive',
            'style'=>'max-width:100%; min-height:100px; overflow: auto; word-wrap: break-word;'
        ],
        'showPageSummary' => true,
        'striped' => true,
        'hover' => true,
        'responsiveWrap' => false,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

            'id',
            'tahun',
            'bulan',
            'jtrans',
            'idpns',
            //'nip',
            //'nama',
            //'jenis_jab',
            //'kode_jab',
            //'nama_jab',
            //'kelas_jab_tpp',
            //'tablok',
            //'nama_opd',
            //'tablokb',
            //'nama_unor',
            //'gol',
            //'nama_gol',
            //'pagu',
            //'persen_tpp',
            //'beban_jab',
            //'beban_opd',
            //'kondisi_jab',
            //'kondisi_opd',
            //'pol_jab',
            //'pol_opd',
            //'prestasi_jab',
            //'prestasi_opd',
            //'tempat_jab',
            //'tempat_opd',
            //'profesi_jab',
            //'persen_tpp_rp',
            //'beban_jab_rp',
            //'beban_opd_rp',
            //'kondisi_jab_rp',
            //'kondisi_opd_rp',
            //'pol_jab_rp',
            //'pol_opd_rp',
            //'prestasi_jab_rp',
            //'prestasi_opd_rp',
            //'tempat_jab_rp',
            //'tempat_opd_rp',
            //'profesi_jab_rp',
            //'pagu_total',
            //'pagu_tpp',
            //'beban_kerja',
            //'produktivitas_kerja',
            //'kinerja',
            //'presensi',
            //'sakip',
            //'rb',
            //'kinerja_rp',
            //'presensi_rp',
            //'sakip_rp',
            //'rb_rp',
            //'tpp_jumlah',
            //'cuti',
            //'hukdis',
            //'tgr',
            //'lhkpn',
            //'aset',
            //'cuti_rp',
            //'hukdis_rp',
            //'tgr_rp',
            //'pengurangan',
            //'tpp_total',
            //'pph',
            //'pph_rp',
            //'bpjs4',
            //'tpp_bruto',
            //'bpjs1',
            //'pot_jml',
            //'tpp_net',
            //'status',
            //'tgl_cetak:date',
            //'updated',

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
