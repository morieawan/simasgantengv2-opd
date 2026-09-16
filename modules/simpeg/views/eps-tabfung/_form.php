<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\simpeg\models\EpsTabfung $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="eps-tabfung-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'KODE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'FUNGSI')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ESEL')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'KGOL')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('<i class="fas fa-save"></i> Simpan', ['class' => 'btn btn-success']) ?>
        <?= Html::a('<i class="fas fa-minus-circle"></i> Batal', Url::previous(), ['class' => 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
