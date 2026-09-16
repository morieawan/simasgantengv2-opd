<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\integrasi\models\TblDataUpdate */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tbl Data Updates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tbl-data-update-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nipBaru',
            'dataUtama',
            'rwJabatan',
            'rwGol',
            'rwDiklat',
            'rwPendidikan',
            'rwSkp',
            'rwAngkakredit',
            'rwPwk',
            'rwPnsunor',
            'rwKursus',
            'rwPemberhentian',
            'rwPenghargaan',
            'rwMasakerja',
            'rwHukdis',
            'rwDp3',
            'rwCltn',
            'rwPindahinstansi',
            'rwskp22',
            'flag',
        ],
    ]) ?>

</div>
