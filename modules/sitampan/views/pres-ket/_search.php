<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\kinerja\KinBulananSearch */
/* @var $form yii\widgets\ActiveForm */
if($model['bulan'] === null) $model['bulan'] = date('n');
if($model['tahun'] === null) $model['tahun'] = date('Y');
?>

<div class="kin-bulanan-search">

<?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'id' => 'caribulanan', 
        'type' => ActiveForm::TYPE_INLINE,
        'fieldConfig' => ['options' => ['class' => 'form-group mr-2 mb-3']] 
    ]); ?>

    <div class="form-group mr-2 mb-3"><b>Cari Data : </b></div> 

        <?= $form->field($model, 'bulan')->widget(Select2::classname(), [
                'data' => \app\models\Fungsi::cariBulan(),
                'language' => 'id',
                'options' => [
                    //'placeholder' => '- Semua -',  
                    'autocomplete' => 'off',
                    'id'=>'sbulan',
                ],
                'pluginOptions' => [
                    'width' => '120px',
                    'allowClear' => false,
                ],
            ]);?>

        <?= $form->field($model, 'tahun')->widget(Select2::classname(), [
                'data' => \app\models\Fungsi::cariTahun(),
                'language' => 'id',
                'options' => [
                    'placeholder' => '- Pilih Tahun -',  
                    'autocomplete' => 'off',
                    'id'=>'stahun',
                ],
                'pluginOptions' => [
                    'width' => '100px',
                    'allowClear' => false,
                ],
            ]);?>

    
    <?php ActiveForm::end(); ?>

</div>

<?php
$script = <<< JS

$('#sbulan').change(function(){	
	$('#caribulanan').submit();
});

$('#stahun').change(function(){	
	$('#caribulanan').submit();
});

JS;
$this->registerJs($script);
?>
