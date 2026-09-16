<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\simpeg\models\EpsTabfungSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="eps-tabfung-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'id' => 'search-form', 
        'type' => ActiveForm::TYPE_INLINE,
        'fieldConfig' => ['options' => ['class' => 'form-group mr-1 mb-0']], 
    ]); ?>

    <?= $form->field($model, 'KODE') ?>

    <?= $form->field($model, 'FUNGSI') ?>

    <?= $form->field($model, 'ESEL') ?>

    <?= $form->field($model, 'KGOL') ?>

    <div class="form-group">
        <?= Html::submitButton('<i class="fas fa-search"></i> Cari Data', ['class' => 'btn btn-primary mr-1']) ?>
        <?= Html::a('<i class="fas fa-times"></i> Clear', ['index'], ['class' => 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
