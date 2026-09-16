<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;

/* @var $this yii\web\View */
/* @var $model app\models\kinerja\KinHarianSearch */
/* @var $form yii\widgets\ActiveForm */

$bulan = $model['bulan'];
$tahun = $model['tahun'];
$nexbul = $model['bulan']+1;

if($nexbul == 13){
    $nexbul = 1;
    $tahun = $tahun + 1;
}
?>

<div class="kin-harian-search">

    <?php $form = ActiveForm::begin([
        'action' => ['target'],
        'method' => 'get',
        'id' => 'cari-form', 
        'type' => ActiveForm::TYPE_INLINE,
        'fieldConfig' => ['options' => ['class' => 'form-group mr-2 mb-3']] 
    ]); ?>

    <div class="form-group mr-2 mb-3"><b>Tanggal : </b></div> 

        <?= $form->field($model, 'tanggal')->textInput(['style'=>'width:50px;', 'id' => 'tglcari']) ?>  

        <?= $form->field($model, 'bulan')->widget(Select2::classname(), [
                'data' => \app\models\Fungsi::cariBulan(),
                'language' => 'id',
                'options' => [
                    'autocomplete' => 'off',
                    'id'=>'subcat-id',
                ],
                'pluginOptions' => [
                    'allowClear' => false,
                ],
            ]);?>

        <?= $form->field($model, 'tahun')->widget(Select2::classname(), [
                'data' => \app\models\Fungsi::cariTahun(),
                'language' => 'id',
                'options' => [
                    'placeholder' => '- Pilih Tahun -',  
                    'autocomplete' => 'off',
                    'id'=>'cat-id',
                ],
                'pluginOptions' => [
                    'allowClear' => false
                ],
            ]);?>               
            
    <?php ActiveForm::end(); ?>

</div>
<div class="ml-auto">
    <?php 
        if(Yii::$app->session['nip_atasan'] == ''){
            $class = 'success'; 
            $tambah = Html::a('<i class="fas fa-plus-circle"></i> Tambah', '#', 
            ['class' => 'btn btn-secondary mb-3 disabled', 'title' => 'Isi Dulu Penilai Kinerja',]);
        }else{
            $class = 'info'; 
            $tambah = Html::submitButton('<i class="fas fa-plus-circle"></i> Tambah', [
                'value' => Url::to(['create', 'tgl' => $model['tahun'].'-'.$model['bulan'].'-'.$model['tanggal']]),
                'title' => 'Tambah Kinerja Harian', 
                'class' => 'showModalButton btn btn-success mb-3',
                'id'=>'tambah',
            ]);
        }
    ?>    
    <?= Html::button('Penilai Kinerja', [
        'value' => Url::to(['atasan']),
        'title' => 'Penilai Kinerja', 
        'class' => "showModalButton btn btn-$class mb-3",
        'id'=>'tambah',
    ]);?>    

    <?= $tambah ?>
</div>

<?php
$script = <<< JS

$('#subcat-id').change(function(){	
	$('#cari-form').submit();
});

$('#cat-id').change(function(){	
	$('#cari-form').submit();
});

$('#tglcari').change(function(){	
	$('#cari-form').submit();
});

JS;
$this->registerJs($script);
?>