<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\integrasi\models\SiasnDataUtama */

$this->title = 'Ubah Data Siasn Data Utama: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Siasn Data Utamas', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="siasn-data-utama-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
