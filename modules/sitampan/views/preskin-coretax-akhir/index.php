<?php

use app\modules\sitampan\models\PreskinCoretaxAkhir;
use app\models\Angka;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use kartik\grid\GridView;

/** @var yii\web\View $this */
/** @var app\modules\sitampan\models\PreskinCoretaxAkhirSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Coretax Akhir Masa Pajak';
$this->params['breadcrumbs'][] = $this->title;

if($searchModel['tablok'] == ''){
    $dnip = array_map(function ($model) {
        return $model->toArray();
    }, $dataProvider->getModels());

    $dt = array_column($dnip, 'nip');
}
?>
<div class="preskin-coretax-akhir-index">

    <?=  Html::a('<i class="fas fa-search"></i> Cari Data', '#', ['title' => 'Cari Data', 'class' => 'btn btn-primary float-right mb-2', 'id' => 'search']); ?>

    <?= Html::a('Export Excel', [
        'export-excel', 
        'tahun' => $searchModel['tahun_pajak'],
        'opd' => $searchModel['tablok']
        ], ['class' => 'btn btn-success']);
    ?>

    <?= Html::a('Cetak Coretax', [
        'cetak', 
        'tahun' => $searchModel['tahun_pajak'],
        'name' => $searchModel['tablok']
        ], ['class' => 'btn btn-danger', 'target' => '_blank']);
    ?>   

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'options' => ['style' => 'font-size:10pt;'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'pemberi_kerja',
            // 'masa_awal',
            // 'masa_akhir',
            // 'tahun_pajak',
            [
                'header' => 'NPWP/NIK<br>NIP<br>Nama<br>Status',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->npwp.'<br>'.$model->nip.'<br>'.$model->nama.'<br>'.$model->status;
                },
            ],
            [
                'header' => 'OPD',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->satker;
                },
            ],
            [
                'header' => 'Tahun Pajak<br>Masa Pajak<br>Jml Bulan',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->tahun_pajak.'<br>'.
                        ucfirst(Angka::Bulan($model->masa_awal)).' s.d '.ucfirst(Angka::Bulan($model->masa_akhir)).
                        '<br>'.$model->jml_bln;
                },
            ],
            [
                'header' => 'Bruto',
                'attribute' => 'bruto_total',
                'format' => 'integer',
            ],
            [
                'header' => 'Bea_Jabatan<br>Iuran_Pensiun<br>PTKP',
                'format' => 'raw',
                'value' => function ($model) {
                    return Angka::Ribuan($model->pot_bea_jabatan).'<br>'.
                        Angka::Ribuan($model->pot_iuran_pensiun).'<br>'.
                        Angka::Ribuan($model->ptkp);
                },
            ],
            [
                'header' => 'PKP Disetahunkan',
                'attribute' => 'pkp_total',
                'format' => 'integer',
            ],
            [
                'header' => 'PPh21 Setahun',
                'attribute' => 'pph_total',
                'format' => 'integer',
            ],
            [
                'header' => 'PPh21 Terbayar',
                'attribute' => 'pph_terbayar',
                'format' => 'integer',
            ],
            [
                'header' => 'Lebih_Bayar(-)/<br>Kurang_Bayar',
                'attribute' => 'pph_terhutang',
                'format' => 'integer',
            ],
        ],
    ]); ?>
</div>


<div id="cari-block" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
            <h5 class="modal-title">Cari Data</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <?= $this->render('_search', ['model' => $searchModel, 'skpd' => $skpd]); ?>
            </div>
        </div>
    </div>
</div>

<?php
$script = <<< JS

$('#search').click(function(){
	$("#cari-block").modal('show');
});
JS;
$this->registerJs($script);
?>
