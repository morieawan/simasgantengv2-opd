<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;

/** @var yii\web\View $this */
/** @var app\modules\sitampan\models\KinAtasanSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Penilaian Bawahan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kin-atasan-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => ['style' => 'font-size:10pt'],
        'options' => [
            'class' => 'table-responsive',
            'style'=>'max-width:100%; min-height:100px; overflow: auto; word-wrap: break-word;'
        ],
        'showPageSummary' => true,
        'striped' => true,
        'hover' => true,
        'responsiveWrap' => false,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'nip',
            'nama',
            //'tablok',
            //'tablokb',
            //'nip_atasan',
            //'nama_atasan',
            //'tablok_atasan',
            //'tablokb_atasan',
            //'updated',
            [
                'class' => 'kartik\grid\ActionColumn',
                'template' => '{kinerja-bawahan}',
                'buttons' => [
                    'kinerja-bawahan' => function ($url, $model) {
                        return Html::a('<span class="fas fa-chart-pie"></span>', Url::to($url), 
                            ['title' => 'Penilaian Kinerja Bawahan', 'class' => 'btn btn-link',
                        ]);
                    },
                ],
            ],
        ],
    ]); ?>


</div>
