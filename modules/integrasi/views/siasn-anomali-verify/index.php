<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
//use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\integrasi\models\SiasnAnomaliSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Anomali Data';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="siasn-anomali-index">

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'tableOptions' => ['style' => 'font-size:10pt'],
        'options' => [
            'class' => 'table-responsive',
            'style'=>'max-width:100%; min-height:100px; overflow: auto; word-wrap: break-word;'
        ],
        'striped' => true,
        'hover' => true,
        'responsiveWrap' => false,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

            'nipBaru',
           //'idPns',
            'nama',
            //'jenisJabatanId',
            //'jenisJabatan',
            //'jabatanId',
            'jabatanNama',
            //'unorId',
            'unorIndukNama',
            'unorNama',
            //'kedudukanPnsId',
            //'kedudukanPnsNama',
            //'simpeg',
            [
                'attribute' => 'skJabatan',
                'format' => 'raw',
                'value' => function($dt){
                    $prevj = Html::a('<span class="fas fa-search"></span>', Url::to(['prev-jab', 'id' => $dt['nipBaru']]), ['title' => 'Preview SK Jabatan Terakhir', 'class' => 'btn-sm btn-warning', 'target' => '_blank' ]);

                    if($dt['skJabatan'] !== null || $dt['skJabatan'] != '')  return $prevj;
                    else return 'Belum Upload';
                }
            ],
            [
                'attribute' => 'flag',
                'format' => 'raw',
                'value' => function($dt){
                    if($dt['flag'] == 0) return 'Usul'; else return 'Final';
                }
            ],
            // [
            //     'attribute' => 'skKP',
            //     'format' => 'raw',
            //     'value' => function($dt){
            //         $up = Html::button('<span class="fas fa-cloud-upload-alt"></span>', ['value' => Url::to(['upload-kp', 'id' => $dt['nipBaru']]), 'title' => 'Upload SK KP Terakhir', 'class' => 'showModalButton btn-xs btn-danger']);

            //         $prev = ' '.Html::a('<span class="fas fa-search"></span>', Url::to(['preview-kp', 'id' => $dt['nipBaru']]), ['title' => 'Preview SK KP Terakhir', 'class' => 'btn-sm btn-secondary', 'target' => '_blank']);
            //         return $up.$prev;
            //     }
            // ],
            //'updated',
            //'updateBy',
            //'verified',
            //'verifiedBy',
            //'flag',

            [
                'class' => 'kartik\grid\ActionColumn',
                'template' => '{update}',
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