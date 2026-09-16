<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\number\NumberControl;

/* @var $this yii\web\View */
/* @var $model app\modules\integrasi\models\TblDataUpdate */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="tbl-data-update-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput(['maxlength' => true, 'id' => 'idpns']) ?>

    <?= $form->field($model, 'nipBaru')->textInput(['maxlength' => true, 'id' => 'nip']) ?>

    <?php //echo $form->field($model, 'dataUtama')->textInput(['maxlength' => true]) ?>

    <?php //echo  $form->field($model, 'rwJabatan')->textInput(['maxlength' => true]) ?>

    <?php //echo  $form->field($model, 'rwGol')->textInput(['maxlength' => true]) ?>

    <?php //echo  $form->field($model, 'rwDiklat')->textInput(['maxlength' => true]) ?>

    <?php //echo  $form->field($model, 'rwPendidikan')->textInput(['maxlength' => true]) ?>

    <?php //echo  $form->field($model, 'rwSkp')->textInput(['maxlength' => true]) ?>

    <?php //echo  $form->field($model, 'rwAngkakredit')->textInput(['maxlength' => true]) ?>

    <?php //echo  $form->field($model, 'rwPwk')->textInput(['maxlength' => true]) ?>

    <?php //echo  $form->field($model, 'rwPnsunor')->textInput(['maxlength' => true]) ?>

    <?php //echo  $form->field($model, 'rwKursus')->textInput(['maxlength' => true]) ?>

    <?php //echo  $form->field($model, 'rwPemberhentian')->textInput(['maxlength' => true]) ?>

    <?php //echo  $form->field($model, 'rwPenghargaan')->textInput(['maxlength' => true]) ?>

    <?php //echo  $form->field($model, 'rwMasakerja')->textInput(['maxlength' => true]) ?>

    <?php //echo  $form->field($model, 'rwHukdis')->textInput(['maxlength' => true]) ?>

    <?php //echo  $form->field($model, 'rwDp3')->textInput(['maxlength' => true]) ?>

    <?php //echo  $form->field($model, 'rwCltn')->textInput(['maxlength' => true]) ?>

    <?php //echo  $form->field($model, 'rwPindahinstansi')->textInput(['maxlength' => true]) ?>

    <?php //echo  $form->field($model, 'rwskp22')->textInput(['maxlength' => true]) ?>

    <?php //echo  $form->field($model, 'flag')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?=  Html::submitButton('<i class=\"fas fa-save\"></i> Simpan', ['class' => 'btn btn-success']) ?>
        <?=  Html::a('<i class=\"fas fa-minus-circle\"></i> Batal',' ', ['class' => 'btn btn-danger', 'data-dismis' => 'modal']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$script = <<< JS
$(document).ready(function(){
    $('#idpns').change(function(){	
        $('#nip').val($('#idpns').val());
    });

    $('#nip').change(function(){	
        $('#idpns').val($('#nip').val());
    });
});

JS;
$this->registerJs($script);
?>
