<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\gaji\models\SimasGajiMstpegawai */

$this->title = 'Ubah Data Simas Gaji Mstpegawai: ' . $model->NIP;
$this->params['breadcrumbs'][] = ['label' => 'Simas Gaji Mstpegawais', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="simas-gaji-mstpegawai-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
