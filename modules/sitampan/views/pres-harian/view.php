<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\sitampan\models\PresHarian */

$this->title = $model->kode;
$this->params['breadcrumbs'][] = ['label' => 'Pres Harians', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="pres-harian-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->kode], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->kode], [
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
            'kode',
            'tgl:date',
            'id_pns',
            'nip',
            'nama',
            'tablok',
            'tablokb',
            'jd_masuk',
            'jd_pulang',
            'pr_masuk',
            'pr_pulang',
            'mnt_masuk:integer',
            'mnt_pulang:integer',
            'kd_pr_masuk',
            'kd_pr_pulang',
            'pot_masuk',
            'pot_pulang',
            'flag',
            'updated',
        ],
    ]) ?>

</div>
