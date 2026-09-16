<?php

/* @var $this \yii\web\View */
/* @var $content string */

//use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\bootstrap4\Modal;
//use yii\widgets\Breadcrumbs;
//use yii\bootstrap4\Breadcrumbs;
use app\assets\AppAsset;
use dominus77\sweetalert2\Alert;

AppAsset::register($this);
\hail812\adminlte3\assets\FontAwesomeAsset::register($this);
\hail812\adminlte3\assets\AdminLteAsset::register($this);
\hail812\adminlte3\assets\PluginAsset::register($this);

//$dirAsset = Yii::$app->assetManager->getPublishedUrl('@webroot');

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <div class="container">
            <?= Alert::widget(['useSessionFlash' => true]); ?>  
            <br>         
            <div align="center">
                <img  width="10%" height="10%" src="<?= Yii::getAlias('@web/brebes.png') ?>">               
            <h2><?= (Yii::$app->name) ?></h2>
            <br>
        </div> 
         
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left"><b>&copy; 2023 BKPSDMD Kabupaten Brebes </b></p>

    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
