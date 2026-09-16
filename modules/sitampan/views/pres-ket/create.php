<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\sitampan\models\PresKet */

$this->title = 'Tambah Keterangan Absen';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pres-ket-create">

    <?= $this->render('_form', [
        'model' => $model, 'jenis' => $jenis, 'asn' => $asn,
    ]) ?>

</div>
