<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\integrasi\models\SiasnAnomali */

$this->title = 'Tambah Data Siasn Anomali';
$this->params['breadcrumbs'][] = ['label' => 'Siasn Anomalis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="siasn-anomali-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
