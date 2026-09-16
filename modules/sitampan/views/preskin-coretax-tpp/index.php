<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;

$this->title = 'Coretax';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="preskin-coretax-tpp-index">

    <?=  Html::a('<i class="fas fa-search"></i> Cari Data', '#', ['title' => 'Cari Data', 'class' => 'btn btn-outline-primary float-right mb-2', 'id' => 'search']); ?>

    <?= Html::a('Export Excel', [
        'export-excel', 
        'bulan' => $searchModel['masa_pajak'],
        'tahun' => $searchModel['tahun_pajak'],
        'id' => $searchModel['tablok']
        ], ['class' => 'btn btn-outline-success']) ?>

    <?= Html::a('Cetak Coretax', [
        'cetak', 
        'bulan' => $searchModel['masa_pajak'],
        'tahun' => $searchModel['tahun_pajak'],
        'name' => $searchModel['tablok']
        ], ['class' => 'btn btn-outline-danger', 'target' => '_blank']);
    ?>            

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'options' => ['style' => 'font-size: 10pt;'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'header' => 'NIP<BR>NIK<BR>Nama',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->nip.'<br>'.$model->nik.'<br>'.$model->nama;
                },
            ],
            [
                'header' => 'Masa Pajak',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->masaPajak.'<br>'.$model->tahun_pajak;
                },
            ],
            [
                'header' => 'KODE<BR>OPD<BR>TKU',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->tablok.'<br>'.$model->coretaxSkpd->NMSKPD.'<br>'.$model->id_tku;
                },
            ],
            [
                'header' => 'Bruto Gaji<BR>Bruto TPP<BR>Bruto Total',
                'format' => 'raw',
                'headerOptions' => ['style' => 'text-align: right;'],
                'contentOptions' => ['style' => 'text-align: right;'],
                'value' => function ($model) {
                    return number_format($model->bruto_gaji,'0', ',', '.').'<br>'.
                        number_format($model->bruto_tpp,'0', ',', '.').'<br>'.
                        number_format($model->bruto,'0', ',', '.');
                },
            ],
            [
                'header' => 'Status<BR>Tarif',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->status.'<br>'.number_format($model->tarif,'2', ',', '.').' %';
                },
            ],
            [
                'header' => 'PPh Gaji<BR>PPh TPP<BR>PPh Total',
                'format' => 'raw',
                'headerOptions' => ['style' => 'text-align: right;'],
                'contentOptions' => ['style' => 'text-align: right;'],
                'value' => function ($model) {
                    return number_format($model->pph_gaji,'0', ',', '.').'<br>'.
                        number_format($model->pph_tpp,'0', ',', '.').'<br>'.
                        number_format($model->pph_total,'0', ',', '.');
                },
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
