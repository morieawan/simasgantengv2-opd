<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\gaji\models\SimasGajiMstpegawai */

$this->title = $model->NIP;
$this->params['breadcrumbs'][] = ['label' => 'Simas Gaji Mstpegawais', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="simas-gaji-mstpegawai-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->NIP], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->NIP], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'NIP',
            'NAMA',
            'GLRDEPAN',
            'GLRBELAKANG',
            'KDJENKEL',
            'TEMPATLHR',
            'TGLLHR:date',
            'AGAMA',
            'zakat_dg',
            'PENDIDIKAN',
            'TMTCAPEG:date',
            'TMTSKMT:date',
            'KDSTAWIN',
            'JISTRI',
            'JANAK',
            'KDSTAPEG',
            'TMTSTOP:date',
            'KDPANGKAT',
            'MKGOLT',
            'BLGOLT',
            'GAPOK',
            'MASKER',
            'PRSNGAPOK',
            'TMTTABEL:date',
            'TMTKGB:date',
            'TMTKGBYAD:date',
            'KDESELON',
            'TJESELON',
            'KDFUNGSI1:integer',
            'KDFUNGSI',
            'TJFUNGSI',
            'BUP:integer',
            'KDSTRUK',
            'TJSTRUK',
            'KDGURU',
            'TJGURU',
            'KDBERAS',
            'KDLANGKA',
            'TJLANGKA',
            'KDTKD',
            'TJTKD',
            'KDTERPENCIL',
            'TJTERPENCIL',
            'KDTJKHUSUS',
            'TJKHUSUS',
            'KDKORPRI',
            'PKORPRI',
            'KDKOPERASI',
            'PKOPERASI',
            'KDIRDHATA',
            'PIRDHATA',
            'TAPERUM',
            'PSEWA',
            'NODOSIR',
            'KDCABTASPEN',
            'KDSSBP',
            'KDSKPD',
            'KDSATKER',
            'ALAMAT',
            'KDDATI4',
            'KDDATI3',
            'KDDATI2',
            'KDDATI1',
            'NOTELP',
            'NOKTP',
            'NPWP',
            'NPWPZ',
            'NIPLAMA',
            'KDHITUNG',
            'KODEBYR',
            'induk_bank',
            'NOREK',
            'TMTBERLAKU:date',
            'CATATAN',
            'KDJNSTRANS:integer',
            'UPDSTAMP',
            'INPUTER',
            'kd_infaq:integer',
            'NOKARPEG',
            'jnsguru',
            'EMAIL:email',
            'KD_JNS_PEG:integer',
            'updated',
        ],
    ]) ?>

</div>
