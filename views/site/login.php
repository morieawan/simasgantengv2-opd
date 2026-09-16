<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

//use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\captcha\Captcha;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;

$fieldOptions1 = [
    //'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "<div class='wrap-input100 validate-input' data-validate ='Masukkan Username'>
        {input}<span class='focus-input100' data-placeholder='Username'></span></div>"
];

$fieldOptions2 = [
    //'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "<div class='wrap-input100 validate-input' data-validate ='Masukkan Password'>
        <span class='btn-show-pass'><i class='fas fa-eye'></i></span>
        {input}<span class='focus-input100' data-placeholder='Password'></span></div>"
];

?>
<div class="site-login">
    
    <?php $form = ActiveForm::begin([
        'id' => 'login-form', 'enableClientValidation' => false,
        'options' => ['class'=> 'login100-form validate-form'],
    ]); ?>

        <span class="login100-form-title p-b-20">
            &nbsp;
        </span>
        <span class="login100-form-title p-b-0">
            <img src="<?= Yii::getAlias('@web/brebes.png') ?>" width="30%" height="30%">
        </span>
        
        <span class="login100-form-title p-b-0">
            <?= (Yii::$app->name) ?>
        </span>

        <span class="login100-form-title p-b-10">            
            <font size="-1">Sistem Informasi Manajemen Aparatur Sipil Negara Online Terintegrasi</font>
        </span>

        <?= $form
            ->field($model, 'username', $fieldOptions1)
            ->label(false)
            ->textInput([
                'class' => 'input100',
                'autofocus' => true,
                'id' => 'username',
            ]) ?>

        <?= $form
            ->field($model, 'password', $fieldOptions2)
            ->label(false)
            ->passwordInput([
                'class' => 'input100',
                'id' => 'password',
            ]) ?>  

        <?= $form
        ->field($model, 'verifyCode')
        ->widget(Captcha::className(), [
            'template' => 
            '<div class="row">
                <div class="col-lg-4"><button>{image}</button></div>
                <div class="col-lg-8">{input}</div>
                <div class="wrap-input100 validate-input" data-validate ="Kode Verifikasi"></div>
            </div>',
        ]) ?>    

        <div class="form-group">
            <div class="container-login100-form-btn">
                <div class="wrap-login100-form-btn">
                    <div class="login100-form-bgbtn"></div>
                    <?= Html::submitButton('Login', ['class' => 'login100-form-btn', 'name' => 'login-button', 'id' => 'login-button']) ?>
                </div>
            </div>
        </div>

        <div class="text-center p-t-30">
            <span class="txt1">
                Versi 2.0
            </span>
        </div>

    <?php ActiveForm::end(); ?>
</div>
<?php
$script = <<< JS

$('#login-button').click(function () {
    
    var username = $('#username').val();
    var password = $('#password').val();
    var verifycode= $('#loginform-verifycode').val();
    
    if (username == '') {
        Swal.fire({
            title : 'Username',
            text : 'Username tidak boleh kosong !',
            icon : 'error',
            showConfirmButton : false,
            timer : 2000
        });        
        return false;
    }
    if(password == '') {
        Swal.fire({
            title : 'Password',
            text : 'Password tidak boleh kosong !',
            icon : 'error',
            showConfirmButton : false,
            timer : 2000
        });        
        return false;
    }
    if(verifycode == '') {
        Swal.fire({
            title : 'Kode Verifikasi',
            text : 'Kode Verifikasi tidak boleh kosong !',
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