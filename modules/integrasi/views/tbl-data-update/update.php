<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\integrasi\models\TblDataUpdate */

$this->title = 'Ubah Data Tbl Data Update: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tbl Data Updates', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tbl-data-update-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
