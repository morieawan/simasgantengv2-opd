<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\integrasi\models\SiasnAnomaliSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="siasn-anomali-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'id' => 'cari-form', 
        'type' => ActiveForm::TYPE_INLINE,
        'fieldConfig' => ['options' => ['class' => 'form-group mr-1 mb-3']], 
    ]); ?>

    <?= $form->field($model, 'nipBaru')->textInput(['id' => 'tnip']) ?>
    <?= $form->field($model, 'nama')->textInput(['id' => 'tnama']) ?>
    <?= $form->field($model, 'unorNama')->textInput(['id' => 'tunor']) ?>
    <?= $form->field($model, 'unorIndukNama')->textInput(['id' => 'tinduk']) ?>

    <?php // echo $form->field($model, 'jabatanNama') ?>    
    <?php // echo $form->field($model, 'idPns') ?>
    <?php // echo $form->field($model, 'jenisJabatanId') ?>
    <?php // echo $form->field($model, 'jenisJabatan') ?>
    <?php // echo $form->field($model, 'jabatanId') ?>
    <?php // echo $form->field($model, 'unorId') ?>
    <?php // echo $form->field($model, 'kedudukanPnsId') ?>
    <?php // echo $form->field($model, 'kedudukanPnsNama') ?>
    <?php // echo $form->field($model, 'simpeg') ?>
    <?php // echo $form->field($model, 'skJabatan') ?>
    <?php // echo $form->field($model, 'skKP') ?>
    <?php // echo $form->field($model, 'updated') ?>
    <?php // echo $form->field($model, 'updateBy') ?>
    <?php // echo $form->field($model, 'verified') ?>
    <?php // echo $form->field($model, 'verifiedBy') ?>
    <?php // echo $form->field($model, 'flag') ?>

    <div class="form-group mb-3">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary mr-1', 'id' => 'sr-button']) ?>
        <?= Html::a('Reset', ['reset'], ['class' => 'btn btn-outline-secondary mr-1']) ?>  
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$script = <<< JS
$('#sr-button').click(function () {
    var c1 = $('#tnip').val();
    var c2 = $('#tnama').val();
    var c3 = $('#tinduk').val();
    var c4 = $('#tunor').val();
    if (c1 == '' && c2 == '' && c3 == '' && c4 == '') {
        Swal.fire({
            title : 'Error',
            text : 'Pencarian tidak boleh kosong !',
            icon : 'error',
            showConfirmButton : false,
            timer : 2000
        });
        return false;
    }
    return true;
});
JS;
$this->registerJs($script);
?>
