<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\integrasi\models\SiasnAnomali */

$this->title = $model->nipBaru;
$this->params['breadcrumbs'][] = ['label' => 'Siasn Anomalis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="siasn-anomali-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->nipBaru], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->nipBaru], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nipBaru',
            'idPns',
            'nama',
            'jenisJabatanId',
            'jenisJabatan',
            'jabatanId',
            'jabatanNama',
            'unorId',
            'unorIndukNama',
            'unorNama',
            'kedudukanPnsId',
            'kedudukanPnsNama',
            'simpeg',
            'skJabatan',
            'skKP',
            'updated',
            'updateBy',
            'verified',
            'verifiedBy',
            'flag',
        ],
    ]) ?>

</div>
