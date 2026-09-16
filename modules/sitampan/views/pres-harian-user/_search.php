<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\modules\sitampan\models\PreskinAsnSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="preskin-asn-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'id' => 'cari-form', 
    ]); ?>

    <?= DatePicker::widget([
        'name' => 'periode',
        'value' => $periode,
        'removeButton' => false,
        'options' => [
            'placeholder' => 'Pilih ....', 'id' => 'pres', 'class' => 'form-control', 'readonly' => true,
        ],
        'pluginOptions' => [
            'autoclose' => false,
            'format' => 'mm-yyyy',
            'minViewMode' => 'months',
        ]
    ]);?>

    <?php ActiveForm::end(); ?>

</div>

<?php
$script = <<< JS

$('#pres').change(function(){	
	$('#cari-form').submit();
});

JS;
$this->registerJs($script);
?>
