<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\gaji\models\SimasGajiMstpegawai */

$this->title = 'Tambah Data Simas Gaji Mstpegawai';
$this->params['breadcrumbs'][] = ['label' => 'Simas Gaji Mstpegawais', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="simas-gaji-mstpegawai-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
