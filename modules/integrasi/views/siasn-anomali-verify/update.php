<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\integrasi\models\SiasnAnomali */

$this->title = 'Ubah Data Anomali';
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="siasn-anomali-update">

    <?= $this->render('_verify', [
        'model' => $model,
    ]) ?>

</div>
