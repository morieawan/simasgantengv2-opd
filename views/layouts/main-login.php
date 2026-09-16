<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\LoginAsset;
use dominus77\sweetalert2\Alert;
use yii\bootstrap4\Html;

LoginAsset::register($this);
\hail812\adminlte3\assets\FontAwesomeAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
$dirAsset = Yii::$app->assetManager->getPublishedUrl('@webroot');

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title)." : ".Yii::$app->name ?></title>
    <?php $this->head() ?>
</head>
<body>	
<?php $this->beginBody() ?>
<div id="particles-js"></div>
<div class="text">
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<?= Alert::widget(['useSessionFlash' => true]); ?>
				<?= $content ?>
			</div>
		</div>
	</div>
</div>
	
	<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>