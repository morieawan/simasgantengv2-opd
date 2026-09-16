<?php

/** @var yii\web\View $this */
use yii\helpers\Html;
use yii\helpers\Url;
use \yii\bootstrap4\Modal;

$this->title = 'Data Pegawai';
\app\assets\AppAsset::register($this);

?>
<div class="site-index">
    
    <h3><?= Html::encode($this->title) ?></h3>
    
    <div class="row">
        <div class="mr-auto">
            <?= $this->render('_search', [
                'model' => $model,
            ]) ?>
        </div>
        <div class="ml-auto">
            <?= Html::submitButton('<i class="fas fa-plus-circle"></i> Tambah Data', [
                'value' => Url::to(['/tambah-data-pegawai']),
                'title' => 'Tambah Data Pegawai', 
                'class' => 'showModalButton btn btn-success mb-3',
                'id'=>'tambah-data-pegawai',
            ]);?>
        </div>
    </div>
    &nbsp;
    <div class="row">        
        <?= $this->render('_data', [
            'data' => $data,
        ]) ?>        
    </div>
</div>

<?php Modal::begin([
    'options' => [
        'tabindex' => false,
    ],
    'title' => Html::encode($this->title),
    'headerOptions' => ['class' => 'bg-info'],
    'id' => 'modal',
    'size' => 'modal-md',
    'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE],
]);

echo "<div id='modalContent'></div>";
Modal::end();
?>
