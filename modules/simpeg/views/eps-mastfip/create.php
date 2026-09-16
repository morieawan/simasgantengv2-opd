<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\simpeg\models\EpsMastfip */

$this->title = 'Tambah Data Eps Mastfip';
$this->params['breadcrumbs'][] = ['label' => 'Eps Mastfips', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eps-mastfip-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
