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

    <div class="card card-danger card-outline direct-chat">
        <div class="card-header">
            <h3 class="card-title">Riwayat SKP</h3>   
        </div>         
        <div class="card-body">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => '-'],
            'tableOptions' => ['class' => 'table table-hover', 'style' => 'font-size:10pt;'],
            'summary' => '',
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'tahun',
                'jenisPeraturanKinerjaKd',
                'nilaiSkp',
                'nilaiPerilakuKerja',
                'nilaiPrestasiKerja',
                'jumlah',
                'nilairatarata',
            ]
        ]); ?>
        </div>
    </div>

    <div class="card card-success card-outline direct-chat">
        <div class="card-header">
            <h3 class="card-title">Riwayat SKP22/ Kinerja</h3>   
        </div>         
        <div class="card-body">
        <?= GridView::widget([
            'dataProvider' => $dataProvider2,
            'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => '-'],
            'tableOptions' => ['class' => 'table table-hover', 'style' => 'font-size:10pt;'],
            'summary' => '',
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'tahun',
                'hasilKinerja',
                'hasilKinerjaNilai',            
                'perilakuKerja',
                'PerilakuKerjaNilai',
                'kuadranKinerja',
                'KuadranKinerjaNilai',
            ]
        ]); ?>
        </div>
    </div>

</div>
