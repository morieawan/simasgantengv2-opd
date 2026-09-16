<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\sitampan\models\PreskinAsn */

$this->title = 'Tambah Data Preskin Asn';
$this->params['breadcrumbs'][] = ['label' => 'Preskin Asns', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="preskin-asn-create">

    <?= $this->render('_form', [
        'model' => $model, 'jad' => $jad, 'kelas' => $kelas, 'sta' => $sta,
    ]) ?>

</div>
