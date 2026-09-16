<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\modules\integrasi\models\SiasnDataUtama */

$this->title = strtoupper(Yii::$app->controller->action->id);
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="siasn-data-utama-view">

    <div class="mb-3">
        <?= $this->render('../layout/menu-spv.php', ['nip' => $model['nipBaru']]) ?>
    </div>
    
    <?= DetailView::widget([
        'template' => "<tr><th style='width:30%;'>{label}</th><td>{value}</td></tr>",
        'options' => ['class' => 'table table-striped', 'style' => 'font-size:10pt;'],
        'model' => $model,
        'attributes' => [
            'nipBaru',
            'nama',
            'unorNama',
            'unorIndukNama',
            'golRuangAkhir',
            'tmtGolAkhir',
        ],
    ]) ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'summary' => '',
        'tableOptions' => ['style' => 'font-size:10pt;'],
        'options' => [
            'class' => 'table-hover table-reponsive',
            'style'=>'overflow: auto; word-wrap: break-word;'
        ],
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
            'golongan',
            'pangkat',
            [
                'header' => 'No. SK<br>Tanggal',
                'attribute' => 'A_02',
                'format' => 'raw',
                'value' => function($dt){
                    if($dt !== null) return $dt['skNomor'].'<br>'.$dt['skTanggal'];
                    else return '';
                }
            ],
            [
                'label' => 'TMT',
                'attribute' => 'tmtGolongan',
                'format' => 'raw',
                'value' => function($dt){
                    if($dt !== null) return \app\models\Fungsi::tgldmy($dt['tmtGolongan']);
                    else return '';
                }
            ],
            // 'jenisKPNama',
        ],
    ]) ?>

</div>
