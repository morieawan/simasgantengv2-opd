<?php
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;

$this->title = 'Tambah Data Pegawai';

?>
<div class="simpeg-create-index">

<h3><?= Html::encode($this->title) ?></h3>

<?php $form = ActiveForm::begin([
        'id' => 'login-form', 
        'type' => ActiveForm::TYPE_VERTICAL
    ]); ?>

    <?= $form->field($model, 'B_02')->textInput()->label('Masukkan NIP') ?>
    <?= $form->field($model, 'B_03')->hiddenInput(['value' => 'not set'])->label(false) ?>
    <?= $form->field($model, 'B_08')->hiddenInput(['value' => 1])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('<i class="fas fa-save"></i> Simpan', ['class' => 'btn btn-success']) ?>
        <?= Html::a('<i class="fas fa-minus-circle"></i> Batal',' ', ['class' => 'btn btn-danger', 'data-dismis' => 'modal']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
