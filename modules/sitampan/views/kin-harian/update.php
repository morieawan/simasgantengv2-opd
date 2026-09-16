<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\sitampan\models\KinHarian */

$this->title = 'Ubah Target Kinerja Harian';
?>
<div class="kin-harian-update">

    <?= $this->render('_form', [
        'model' => $model, 'output' => $output,
    ]) ?>

</div>
