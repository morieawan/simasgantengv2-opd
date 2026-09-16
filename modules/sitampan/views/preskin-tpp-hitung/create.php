<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\sitampan\models\PreskinTppHitung */

$this->title = 'Tambah Data Preskin Tpp Hitung';
$this->params['breadcrumbs'][] = ['label' => 'Preskin Tpp Hitungs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="preskin-tpp-hitung-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
