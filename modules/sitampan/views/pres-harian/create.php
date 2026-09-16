<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\sitampan\models\PresHarian */

$this->title = 'Tambah Data Pres Harian';
$this->params['breadcrumbs'][] = ['label' => 'Pres Harians', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pres-harian-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
