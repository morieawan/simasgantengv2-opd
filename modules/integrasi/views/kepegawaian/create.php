<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\integrasi\models\SiasnDataUtama */

$this->title = 'Tambah Data Siasn Data Utama';
$this->params['breadcrumbs'][] = ['label' => 'Siasn Data Utamas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="siasn-data-utama-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
