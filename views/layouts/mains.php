<?php

/* @var $this \yii\web\View */
/* @var $content string */

use dominus77\sweetalert2\Alert;
//use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\bootstrap4\Modal;

\app\assets\AppAsset::register($this);

\hail812\adminlte3\assets\FontAwesomeAsset::register($this);
\hail812\adminlte3\assets\AdminLteAsset::register($this);
$this->registerCssFile('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback');

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);

$adminlteAssets = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
<title><?= Html::encode($this->title).' : '.Yii::$app->name ?></title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<style type="text/css">
		.preloader {
			position: fixed;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			z-index: 9999;
			background-color: #fff;
		}
		.loading {
			position: absolute;
			left: 50%;
			top: 50%;
			transform: translate(-50%,-50%);
			font: 14px arial;
		}
	</style>
    <?php $this->registerCsrfMetaTags() ?>
    <?php $this->head() ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<?php $this->beginBody() ?>

<!--<div class="preloader">
    <div class="loading">

		<div class="spinner-border text-primary"></div>
		<div class="spinner-border text-success"></div>
		<div class="spinner-border text-info"></div>
		<div class="spinner-border text-warning"></div>
		<div class="spinner-border text-danger"></div>

    </div>
</div>
	-->
<div class="wrapper">

	<?= $this->render('partials/header', ['adminlteAssets' => $adminlteAssets]); ?>

	<?= $this->render('partials/nav', ['adminlteAssets' => $adminlteAssets]); ?>

	<div class="content-wrapper">
		
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0">
							<?php
							if (!is_null($this->title)) {
								echo \yii\helpers\Html::encode($this->title);
							} else {
								echo \yii\helpers\Inflector::camelize($this->context->id);
							}
							?>
						</h1>
					</div><!-- /.col -->
					<div class="col-sm-6">
						<?php/*
						echo Breadcrumbs::widget([
							'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
							'options' => [
								'class' => 'breadcrumb float-sm-right'
							]
						]);
						*/?>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.container-fluid -->
		</div>
		<!-- /.content-header -->
	
		<section class="content">
			<?= Alert::widget(['useSessionFlash' => true]); ?>
			
			<div class="text">
				<div class="col-lg-12">
					<?= $content ?>
				</div>
			</div>
		</section>
	</div>

	<?= $this->render('partials/footer'); ?>
	<?php
		Modal::begin([
			'title' => Html::encode($this->title),
			'headerOptions' => ['class' => 'bg-info'],
			'id' => 'modal',
			'size' => 'modal-md',
			'options' => [
				'tabindex' => false // important for Select2 to work properly
			],
		]);

		echo "<div id='modalContent'></div>";
		Modal::end();
	?>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php 
/*
$script = <<< JS

$(document).ready(function() {
	$(".preloader").hide();
});

$("input[type=submit]").click(function() {
	$(".preloader").show();
});

JS;
$this->registerJs($script);
*/?>

<?php $this->endPage() ?>
