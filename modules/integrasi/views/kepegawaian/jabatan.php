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
            // 'nipLama',
            'nama',
            'unorNama',
            // 'unorIndukId',
            'unorIndukNama',
            // 'jenisJabatanId',
            'jenisJabatan',
            'jabatanNama',
            'tmtJabatan',
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
            [
                'header' => 'Jabatan<br>Unor - OPD',
                'attribute' => 'namaJabatan',
                'format' => 'raw',
                'value' => function($dt){
                    if($dt['namaJabatan'] != '') $ja = $dt['namaJabatan'];
                    elseif($dt['jabatanFungsionalNama'] != '') $ja = $dt['jabatanFungsionalNama'];
                    elseif($dt['jabatanFungsionalUmumNama'] != '') $ja = $dt['jabatanFungsionalUmumNama'];
                    else $ja = '';

                    if($dt['unorNama'] !== null) $uno = '<br>'.$dt['unorNama']; else $uno = '';
                    
                    if($dt['unorIndukNama'] !== null) $induk = '<br>'.$dt['unorIndukNama']; else $induk = '';
                    
                    return $ja.$uno.$induk;
                }
            ],
            [
                'header' => 'No. SK<br>Tanggal SK<br>TMT',
                'attribute' => 'nomorSk',
                'format' => 'raw',
                'value' => function($dt){
                    if($dt['nomorSk'] !== null) $nosk = $dt['nomorSk']; else $nosk = '';
                    if($dt['tanggalSk'] !== null) $tglsk = '<br>'.$dt['tanggalSk']; else $tglsk = '';
                    if($dt['tmtJabatan'] !== null) $tmtjab = '<br>'. \app\models\Fungsi::tgldmy($dt['tmtJabatan']); else $tmtjab = '';
                    return $nosk.$tglsk.$tmtjab;
                }
            ],
        ],
    ]) ?>

</div>
