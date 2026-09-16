<?php

use app\modules\simpeg\models\EpsTabfung;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\ActionColumn;
use kartik\grid\GridView;

/** @var yii\web\View $this */
/** @var app\modules\simpeg\models\EpsTabfungSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Eps Tabfungs';

?>
<div class="eps-tabfung-index">

    <h3><?= Html::encode($this->title) ?></h3>

    <div class="row">
        <div class="mr-auto">
        <?= $this->render('_search', [
                'model' => $searchModel,
            ]) ?>
        </div>
        <div class="ml-auto">
            <?= Html::a('<i class="fas fa-plus-circle"></i> Tambah Data', ['create'], ['class' => 'btn btn-success']) ?>
        </div>
    </div>

    &nbsp;

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'tableOptions' => ['style' => 'font-size:12pt'],
        'options' => [
            'class' => 'table-responsive',
            'style'=>'max-width:100%; min-height:100px; overflow: auto; word-wrap: break-word;'
        ],
        'summary' => '',
        'striped' => true,
        'hover' => true,
        'responsiveWrap' => false,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

            'KODE',
            'FUNGSI',
            'ESEL',
            'KGOL',
            [
                'class' => ActionColumn::className(),
                'template' => '{update} {delete}',
                'urlCreator' => function ($action, EpsTabfung $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->KODE]);
                 }
            ],
        ],
    ]); ?>


</div>
