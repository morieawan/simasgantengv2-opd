<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\integrasi\models\SiasnDataUtama */

$this->title = strtoupper(Yii::$app->controller->action->id);
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="siasn-data-utama-view">
    
    <?= DetailView::widget([
        'template' => "<tr><th style='width:30%;'>{label}</th><td>{value}</td></tr>",
        'options' => ['class' => 'table table-striped', 'style' => 'font-size:10pt;'],
        'model' => $model,
        'attributes' => [
            'golongan',
            'pangkat',
            'skNomor',
            'skTanggal',
            [
                'label' => 'TMT',
                'attribute' => 'tmtGolongan',
                'format' => 'raw',
                'value' => function($dt){
                    if($dt !== null) return \app\models\Fungsi::tgldmy($dt['tmtGolongan']);
                    else return '';
                }
            ],
            'jenisKPNama',
            'noPertekBkn',
            'tglPertekBkn',
            'masaKerjaGolonganTahun',
            'masaKerjaGolonganBulan',
        ],
    ]) ?>

</div>
