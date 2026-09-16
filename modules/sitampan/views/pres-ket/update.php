<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\sitampan\models\PresKet */

$this->title = 'Ubah Keterangan Absen';
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pres-ket-update">

    <?= $this->render('_form', [
        'model' => $model, 'jenis' => $jenis, 'asn' => $asn,
    ]) ?>

</div>
