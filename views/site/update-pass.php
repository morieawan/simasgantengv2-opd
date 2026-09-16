<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Ubah Username dan Password ';

?>
<div class="user-update">
<div class="row">

    <div class="col-md-8">
        <h4> <?= Html::encode($this->title) ?> </h4><br>
        <?php $form = ActiveForm::begin([
            'id' => 'login-form-horizontal', 
            'type' => ActiveForm::TYPE_HORIZONTAL,
            'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL],
        ]); ?>
            
            <?= $form->field($model, 'pengguna')->textInput([
                'value'=> $model['nipBaru'].' '.$model['namapengguna'], 
                'class' => 'form-control class-content-title_series', 
                'disabled' => true])->label('Pengguna') ?>

            <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>    

            <?= $form->field($model, 'password')->passwordInput(['id' => 'pass1'])->label('Password Baru') ?>
            
            <?= $form->field($model, 'password2')->passwordInput(['id' => 'pass2'])->label('Ulangi Password Baru') ?>
            
            <div id="pesan" style="color: red;"></div>
        
        <div class="form-group">
            <?= Html::submitButton('Simpan', ['class' => 'btn btn-success', 'id' => 'signup-button']) ?>
            <?= Html::a('Batal', ['/site/logout'],['class' => 'btn btn-danger', 'title' => 'Batal', 'data-method' => 'post']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>

    <div class="col-sm-4">
        <h4>&nbsp;</h4><br>
        
        <p style="font-size:15pt"> <b>Ketentuan : </b><br>Wajib mengubah password dengan kombinasi huruf besar, huruf kecil dan angka atau <b>sesuaikan dengan password MyASN - BKN </b></p>
    </div>

</div>
</div>

<?php
$script = <<< JS

$('#signup-button').click(function () {
    var password = $('#pass1').val();
    var confirmPassword = $('#pass2').val();
    if (password == '') {
        Swal.fire({
            title : 'Password',
            text : 'Password baru tidak boleh kosong !',
            icon : 'error',
            showConfirmButton : true,
            //timer : 2000
        });
        
        return false;
    }else if(password.length < 8){ 
        Swal.fire({
            title : 'Password',
            text : 'Password minimal 8 karakter !',
            icon : 'error',
            showConfirmButton : true,
            //timer : 2000
        });
        
        return false;
    }
    else if (password != confirmPassword) {
        /*$('#signup-button').prop('disabled',true) ;*/
        //$('#pesan').html('<b> Ulangi Password tidak sama ! </b><br><br>');
        Swal.fire({
            title : 'Ulangi Password',
            text : 'Ulangi Password Baru tidak sama !',
            icon : 'error',
            showConfirmButton : true,
            //timer : 2000
        });
        return false;
    }
    /*$('#signup-button').prop('disabled',false);*/
    //$('#pesan').html('');
    return true;
});

JS;
$this->registerJs($script);
?>
