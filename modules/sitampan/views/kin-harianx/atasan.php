<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;

$this->title = 'Tambah Target Kinerja Harian';

?>

<div class="atasan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nip_atasan', [
		'addon' => [
			'append' => [
				'content' => Html::button('Cari', ['class'=>'btn btn-primary']), 
				'asButton' => true
			],
		],
    ])->textInput(['id' => 'nip_atasan']) ?>

    <?= $form->field($model, 'nama_atasan')->textInput(['maxlength' => true, 'id' => 'nama_atasan', 'readonly' => true]) ?>

    <?= $form->field($model, 'tablok_atasan')->hiddenInput(['maxlength' => true, 'id' => 'tablok_atasan'])->label(false) ?>

    <?= $form->field($model, 'tablokb_atasan')->hiddenInput(['maxlength' => true, 'id' => 'tablokb_atasan'])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('<i class=\"fas fa-save\"></i> Simpan', ['class' => 'btn btn-success', 'id' => 'simpan']) ?>
        <?= Html::a('<i class=\"fas fa-minus-circle\"></i> Batal',' ', ['class' => 'btn btn-danger', 'data-dismis' => 'modal']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$urlData = Url::to(['/sitampan/kin-harian/get-atasan']);
$script = <<< JS

$(document).ready(function(){
	if($("#nama_atasan").val() != '') $("#simpan").show();
	else $("#simpan").hide();	
});

$('#nip_atasan').change(function(){
	var zipId = $(this).val();
    
	$.get("{$urlData}",{ zipId : zipId },function(data){
		if (data == '' ){

            Swal.fire({
                icon: 'error',
                title: 'Gagal !!!',
                text: "Data dengan NIP "+ zipId +" tidak ditemukan !",
                showConfirmButton: false,
                timer: 2000
            })

            $("#simpan").hide();

			$('#nama_atasan').attr('value','');
			$('#tablok_atasan').attr('value','');
			$('#tablokb_atasan').attr('value','');

		}else{
            $("#simpan").show();

            var data = $.parseJSON(data);
			$('#nama_atasan').attr('value',data.namaAtasan);
			$('#tablok_atasan').attr('value',data.tablokAtasan);
			$('#tablokb_atasan').attr('value',data.tablokbAtasan);
		}
	});
});
JS;
$this->registerJs($script);
?>
