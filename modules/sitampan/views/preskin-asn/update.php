<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\sitampan\models\PreskinAsn */

$this->title = 'Ubah Data Preskin Asn: ' . $model->nip;
$this->params['breadcrumbs'][] = ['label' => 'Preskin Asns', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="preskin-asn-update">

    <?= $this->render('_form', [
        'model' => $model, 'jad' => $jad, 'kelas' => $kelas, 'sta' => $sta,
    ]) ?>

</div>
