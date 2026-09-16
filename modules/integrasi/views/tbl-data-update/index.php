<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
//use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\integrasi\models\TblDataUpdateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cek Sinkronisasi Data ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-data-update-index">

    <h3><?= Html::encode($this->title) ?></h3>

    <div class="row">
        <div class="col-lg-12">
            <?= Html::button('<i class="fas fa-plus-circle"></i> Tambah', ['value' => Url::to(['create']), 'title' => 'Tambah Data', 'class' => 'showModalButton btn btn-info']); ?>
            
            <?= Html::button('<i class="fas fa-file-excel"></i> Upload', ['value' => Url::to(['excel']), 'title' => 'Tambah Data From Excel File', 'class' => 'showModalButton btn btn-success']); ?>
            
            <?= Html::a('<i class="fas fa-sync"></i> Simgaji', ['simgaji'], ['title' => 'Sinkron data dari Simgaji', 'class' => 'btn btn-warning']); ?>

            <?= Html::a('<i class="fas fa-sync"></i> Simpeg', ['simpeg'], ['title' => 'Sinkron data dari Simpeg', 'class' => 'btn btn-danger']); ?>
        </div>
    </div>

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

            //'id',
            //'nipBaru',
            [
                'attribute' => 'nipBaru',
                'label' => 'ID',
                'format' => 'raw',
                'value' => function($dt){
                    if($dt['id'] === null) $dt['id'] = 'null';
                    if($dt['nipBaru'] === null) $dt['nipBaru'] = 'null';
                    return $dt['id'].'<br>'.$dt['nipBaru'];
                }
            ],
            [
                'attribute' =>  'dataUtama',
                'format' => 'raw',
                'value' => function($dt){
                    if($dt['dataUtama'] === null) $dt['dataUtama'] = 'sinkron';
                    return Html::a($dt['dataUtama'],['sync-data-utama', 'nip' => $dt['nipBaru']], ['class' => 'btn-sm btn-info']);
                }
            ],
            'rwJabatan',
            'rwGol',
            // 'rwDiklat',
            // 'rwPendidikan',
            // 'rwSkp',
            // 'rwAngkakredit',
            // 'rwPwk',
            // 'rwPnsunor',
            // 'rwKursus',
            // 'rwPemberhentian',
            // 'rwPenghargaan',
            // 'rwMasakerja',
            // 'rwHukdis',
            // 'rwDp3',
            // 'rwCltn',
            // 'rwPindahinstansi',
            // 'rwskp22',
            [
                'attribute' =>  'flag',
                'headerOptions' => ['style' => 'width:7%'],
            ],
            [
                'class' => 'kartik\grid\ActionColumn',
                'options' => ['style' => 'width:10%'],
                'template' => '{view} {sync}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::button('<span class="fas fa-eye"></span>',['value' => Url::to($url), 
                            'title' => 'Update', 'class' => 'showModalButton btn btn-link',
                        ]);
                    },
                    'sync' => function ($url, $model) {
                        return Html::button('<span class="fas fa-sync"></span>',['value' => Url::to($url), 
                            'title' => 'Update', 'class' => 'showModalButton btn btn-link',
                        ]);
                    },
                ],
            ],
        ],
    ]); ?>


</div>
