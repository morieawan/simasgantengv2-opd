<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\sitampan\models\PreskinTppHitung */

$this->title = 'Ubah Data Preskin Tpp Hitung: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Preskin Tpp Hitungs', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="preskin-tpp-hitung-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
