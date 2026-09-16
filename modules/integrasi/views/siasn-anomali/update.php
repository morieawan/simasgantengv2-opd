<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\integrasi\models\SiasnAnomali */

$this->title = 'Ubah Data Siasn Anomali: ' . $model->nipBaru;
$this->params['breadcrumbs'][] = ['label' => 'Siasn Anomalis', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="siasn-anomali-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
