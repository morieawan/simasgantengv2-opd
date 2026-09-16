<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
//use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\sitampan\models\KinHarianSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kin Harians';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kin-harian-index">

    <p>
        <?=  Html::button('<i class="fas fa-plus-circle"></i> Tambah', ['value' => Url::to(['create']), 'title' => 'Tambah Kin Harian', 'class' => 'showModalButton btn btn-success']); ?>
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
            'id_pns',
            'nip',
            'nama',
            'tablok',
            //'tablokb',
            //'tgl:date',
            //'kode_kegiatan_h',
            //'uraian_keg_h:ntext',
            //'tgl_target',
            //'target_kuan_h',
            //'target_output_h',
            //'target_waktu_h',
            //'target_sat_waktu_h:integer',
            //'tgl_real',
            //'real_kuan_h',
            //'real_output_h:integer',
            //'real_waktu_h',
            //'real_sat_waktu_h:integer',
            //'tgl_ok',
            //'ok_kuan_h',
            //'ok_output_h:integer',
            //'ok_waktu_h',
            //'ok_sat_waktu_h:integer',
            //'penilai_nip',
            //'penilai_nama',
            //'penilai_tablok',
            //'penilai_tablokb',
            //'flag:integer',

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
