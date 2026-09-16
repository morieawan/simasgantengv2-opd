<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\integrasi\models\SiasnTempRwJabatan */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Siasn Temp Rw Jabatans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="siasn-temp-rw-jabatan-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'eselonId',
            'id',
            'instansiId',
            'jabatanFungsionalId',
            'jabatanFungsionalUmumId',
            'jenisJabatan',
            'jenisMutasiId',
            'jenisPenugasanId',
            'nomorSk',
            'pnsId',
            'satuanKerjaId',
            'subJabatanId',
            'tanggalSk',
            'tmtJabatan',
            'tmtMutasi',
            'tmtPelantikan',
            'unorId',
            'flag',
            'updated',
            'by',
        ],
    ]) ?>

</div>
