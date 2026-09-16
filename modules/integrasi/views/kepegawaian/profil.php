<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\integrasi\models\SiasnDataUtama */

$this->title = strtoupper(Yii::$app->controller->action->id);
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="siasn-data-utama-view">

    <div class="mb-3">
        <?= $this->render('../layout/menu-spv.php', ['nip' => $model['nipBaru']]) ?>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <?= DetailView::widget([
                'template' => "<tr><th style='width:30%;'>{label}</th><td>{value}</td></tr>",
                'options' => ['class' => 'table table-striped', 'style' => 'font-size:12pt;'],
                'model' => $model,
                'attributes' => [
                    'nipBaru',
                    'nama',
                    'gelarDepan',
                    'gelarBelakang',
                    'tempatLahir',
                    'tglLahir',
                    'jenisKelamin',
                    'alamat',
                ],
            ]) ?>
        </div>
    </div>
</div>

<?php
$css = <<< CSS
.img {
    background:  #94fcc3 ;
    position: relative;
    text-align: center;
    transform: rotate(10deg);
}

.img:before{
    position: relative;
    text-align: center;
    transform: rotate(20deg);
}  

.img2{
      position: relative;
      text-align: center;
      transform: rotate(-10deg);
      /*border-radius: 5px;*/
    }  
    
CSS;
$this->registerCss($css);
?>