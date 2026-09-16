<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\simpeg\models\EpsTabfung $model */

$this->title = 'Update Eps Tabfung: ' . $model->KODE;

?>
<div class="eps-tabfung-update">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
