<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\integrasi\models\TblDataUpdate */

$this->title = 'Tambah Data Tbl Data Update';
$this->params['breadcrumbs'][] = ['label' => 'Tbl Data Updates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-data-update-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
