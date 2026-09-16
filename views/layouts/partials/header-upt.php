<?php

use yii\helpers\Html;
use yii\helpers\Url;
//echo Dialog::widget(['overrideYiiConfirm' => true]);

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">
	<nav class="main-header navbar navbar-expand navbar-dark bg-olive fixed-top">
		
		<ul class="navbar-nav">
			<li class="nav-item">
				<a class="nav-link" data-widget="pushmenu" href="#">
					<i class="fas fa-bars"></i>
				</a>
			</li>
		</ul>
		<ul class="navbar-nav">
			<li class="nav-item">
				<?= '<b>'.Yii::$app->session['mod_name'].'</b>' ?>
			</li>
		</ul>

		<div class="navbar-nav ml-auto">
			<li class="nav-item">
				<div class="nav-link">
            		<?= Yii::$app->session['namapengguna'].' - '.Yii::$app->session['nip'];?>
            	</div>
			</li>
			<li class="nav-item">
				<?= Html::button('<i class="fas fa-arrow-circle-left"></i>',['class' => 'nav-link btn bg-maroon logout', 'title' => 'Kembali', 'name' => 'logout', 'id' => 'logout-button'])?>
			</li>
		</div>&nbsp;&nbsp;
	</nav>
</header>
<?php
$urlData = Url::to(['/site/sign-out']);
$script = <<< JS

$('#logout-button').click(function () {
    Swal.fire({
        title: 'Kembali ke Menu Utama ???',
        icon: 'question',
		text: 'Menuju menu utama',
        showCancelButton: true,
        confirmButtonText: 'Ya, Kembali',
        cancelButtonText: 'Tidak',
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        //closeOnConfirm: true,
        //closeOnCancel: true
    }).then((result) => {
        if (result.isConfirmed) {
            $.post("{$urlData}");
        } 
    });
        
});

JS;
$this->registerJs($script);
?>
