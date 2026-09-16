<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\modules\integrasi\models\SiasnDataUtama */

$this->title = 'Data CPNS PNS PPPK';
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
        ],
    ]) ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => '-'],
        'tableOptions' => ['class' => 'table table-hover', 'style' => 'font-size:10pt;'],
        'summary' => '',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'hargaNama',
            'tahun',
            'skNomor',
            'skDate',
        ]
    ]); ?>

</div>
