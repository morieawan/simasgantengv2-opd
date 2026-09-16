<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\simpeg\models\EpsMastfip */

$this->title = $model->B_02;
$this->params['breadcrumbs'][] = ['label' => 'Eps Mastfips', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="eps-mastfip-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->B_02], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->B_02], [
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
            'A_00',
            'A_01',
            'A_02',
            'A_03',
            'A_04',
            'B_01',
            'B_02',
            'B_03A',
            'B_03',
            'B_03B',
            'B_04',
            'B_05:date',
            'B_06:integer',
            'B_07:integer',
            'B_08:integer',
            'B_09:integer',
            'B_10:integer',
            'B_11',
            'B_12',
            'B_13',
            'B_14:integer',
            'B_15',
            'B_16',
            'B_17',
            'C_00',
            'C_01:date',
            'C_02',
            'C_03:date',
            'C_04:integer',
            'D_00',
            'D_01',
            'D_02:date',
            'D_03:integer',
            'D_04:date',
            'D_05:integer',
            'E_01',
            'E_02',
            'E_03:date',
            'E_04:integer',
            'E_05:date',
            'E_06',
            'E_07',
            'F_01:date',
            'F_02',
            'F_02A',
            'F_03:integer',
            'F_04',
            'F_05',
            'F_06:date',
            'F_07:integer',
            'G_01',
            'G_02',
            'G_03:date',
            'G_04:date',
            'G_05',
            'G_05A:integer',
            'G_05B',
            'G_06:integer',
            'G_07',
            'G_08',
            'G_09:date',
            'G_10:date',
            'G_11',
            'G_11A',
            'H_01:integer',
            'H_02',
            'H_03:integer',
            'I_01:integer',
            'I_02:date',
            'I_03:integer',
            'J_01',
            'J_02',
            'J_03:date',
            'J_04',
            'J_05',
            'J_06',
            'J_07:date',
            'J_08',
            'K_01',
            'K_02',
            'K_03:date',
            'K_04:date',
            'K_05:integer',
            'K_06:integer',
            'K_07',
            'L_01:integer',
            'L_02:integer',
            'M_01',
            'M_02',
            'M_03:date',
            'M_04:integer',
            'M_05:date',
            'M_06',
            'M_07',
            'Z_99:integer',
            'no_telp',
            'foto',
            'nik',
            'email:email',
            'updated',
            'email_gov:email',
            'kartu_asn',
        ],
    ]) ?>

</div>
