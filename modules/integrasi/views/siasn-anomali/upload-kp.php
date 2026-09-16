<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\widgets\FileInput;
use yii\helpers\Url;

$this->title = 'Tambah E-File';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="uploadKP">

    <?php $form = ActiveForm::begin([
            'options'=>['enctype'=>'multipart/form-data']
        ]); ?>

        <?= $form->field($model, 'nipBaru')->textInput(['disabled' => true, 'value' => $model['nipBaru'].' - '.$model['nama']]) ?>

        <?= $form->field($model, 'skKP')->widget(FileInput::classname(), [
        //'options' => ['accept' => 'gdocs/*'],
        'options' => ['id' => 'unggahan'], 
        'pluginOptions' => [
            'showRemove'=> false,
            'showUpload' => false,
            'showCancel' => false,
            'overwriteInitial' => false,
            //'previewFileType' => 'image',
            'uploadAsync'=> true,
            'maxFileSize' => 1024,
            'allowedFileExtensions' => ['pdf'], 
        ]
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton('<i class="fas fa-save"></i> Simpan', ['class' => 'btn btn-success', 'id' => 'simpan']) ?>
        <?= Html::a('<i class="fas fa-minus-circle"></i> Batal',' ', ['class' => 'btn btn-danger', 'data-dismis' => 'modal']) ?>
    </div>
 
    <?php ActiveForm::end(); ?> 
</div>

<?php
$script = <<< JS
$('#simpan').click(function () {
    var c1 = $('#unggahan').val();
    if (c1 == '') {
        Swal.fire({
            title : 'Error',
            text : 'File upload tidak boleh kosong, ukuran Maksimal 1 MB, format PDF !',
            icon : 'error',
            showConfirmButton : false,
            timer : 2500
        });
        return false;
    }
    return true;
});
JS;
$this->registerJs($script);
?>