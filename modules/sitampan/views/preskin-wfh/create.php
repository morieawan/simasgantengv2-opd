<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\sitampan\models\PreskinWfh $model */

$this->title = 'Create Preskin Wfh';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="preskin-wfh-create">

    <?= $this->render('_form', [
        'model' => $model, 'asn' => $asn,
    ]) ?>

</div>
