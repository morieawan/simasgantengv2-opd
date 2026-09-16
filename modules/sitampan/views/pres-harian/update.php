<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\sitampan\models\PresHarian */

$this->title = 'Ubah Data Pres Harian: ' . $model->kode;
$this->params['breadcrumbs'][] = ['label' => 'Pres Harians', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pres-harian-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
