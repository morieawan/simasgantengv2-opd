<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\simpeg\models\EpsMastfip */

$this->title = 'Ubah Data Eps Mastfip: ' . $model->B_02;
$this->params['breadcrumbs'][] = ['label' => 'Eps Mastfips', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="eps-mastfip-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
