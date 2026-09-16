<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\gaji\models\SimasGajiMstpegawaiSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="simas-gaji-mstpegawai-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'id' => 'cari-form', 
        'type' => ActiveForm::TYPE_INLINE,
        'fieldConfig' => ['options' => ['class' => 'form-group mr-2 mb-3']], 
    ]); ?>

    <?= $form->field($model, 'NIP') ?>

    <?= $form->field($model, 'NAMA') ?>

    <?= $form->field($model, 'GLRDEPAN') ?>

    <?= $form->field($model, 'GLRBELAKANG') ?>

    <?= $form->field($model, 'KDJENKEL') ?>

    <?php // echo $form->field($model, 'TEMPATLHR') ?>

    <?php // echo $form->field($model, 'TGLLHR') ?>

    <?php // echo $form->field($model, 'AGAMA') ?>

    <?php // echo $form->field($model, 'zakat_dg') ?>

    <?php // echo $form->field($model, 'PENDIDIKAN') ?>

    <?php // echo $form->field($model, 'TMTCAPEG') ?>

    <?php // echo $form->field($model, 'TMTSKMT') ?>

    <?php // echo $form->field($model, 'KDSTAWIN') ?>

    <?php // echo $form->field($model, 'JISTRI') ?>

    <?php // echo $form->field($model, 'JANAK') ?>

    <?php // echo $form->field($model, 'KDSTAPEG') ?>

    <?php // echo $form->field($model, 'TMTSTOP') ?>

    <?php // echo $form->field($model, 'KDPANGKAT') ?>

    <?php // echo $form->field($model, 'MKGOLT') ?>

    <?php // echo $form->field($model, 'BLGOLT') ?>

    <?php // echo $form->field($model, 'GAPOK') ?>

    <?php // echo $form->field($model, 'MASKER') ?>

    <?php // echo $form->field($model, 'PRSNGAPOK') ?>

    <?php // echo $form->field($model, 'TMTTABEL') ?>

    <?php // echo $form->field($model, 'TMTKGB') ?>

    <?php // echo $form->field($model, 'TMTKGBYAD') ?>

    <?php // echo $form->field($model, 'KDESELON') ?>

    <?php // echo $form->field($model, 'TJESELON') ?>

    <?php // echo $form->field($model, 'KDFUNGSI1') ?>

    <?php // echo $form->field($model, 'KDFUNGSI') ?>

    <?php // echo $form->field($model, 'TJFUNGSI') ?>

    <?php // echo $form->field($model, 'BUP') ?>

    <?php // echo $form->field($model, 'KDSTRUK') ?>

    <?php // echo $form->field($model, 'TJSTRUK') ?>

    <?php // echo $form->field($model, 'KDGURU') ?>

    <?php // echo $form->field($model, 'TJGURU') ?>

    <?php // echo $form->field($model, 'KDBERAS') ?>

    <?php // echo $form->field($model, 'KDLANGKA') ?>

    <?php // echo $form->field($model, 'TJLANGKA') ?>

    <?php // echo $form->field($model, 'KDTKD') ?>

    <?php // echo $form->field($model, 'TJTKD') ?>

    <?php // echo $form->field($model, 'KDTERPENCIL') ?>

    <?php // echo $form->field($model, 'TJTERPENCIL') ?>

    <?php // echo $form->field($model, 'KDTJKHUSUS') ?>

    <?php // echo $form->field($model, 'TJKHUSUS') ?>

    <?php // echo $form->field($model, 'KDKORPRI') ?>

    <?php // echo $form->field($model, 'PKORPRI') ?>

    <?php // echo $form->field($model, 'KDKOPERASI') ?>

    <?php // echo $form->field($model, 'PKOPERASI') ?>

    <?php // echo $form->field($model, 'KDIRDHATA') ?>

    <?php // echo $form->field($model, 'PIRDHATA') ?>

    <?php // echo $form->field($model, 'TAPERUM') ?>

    <?php // echo $form->field($model, 'PSEWA') ?>

    <?php // echo $form->field($model, 'NODOSIR') ?>

    <?php // echo $form->field($model, 'KDCABTASPEN') ?>

    <?php // echo $form->field($model, 'KDSSBP') ?>

    <?php // echo $form->field($model, 'KDSKPD') ?>

    <?php // echo $form->field($model, 'KDSATKER') ?>

    <?php // echo $form->field($model, 'ALAMAT') ?>

    <?php // echo $form->field($model, 'KDDATI4') ?>

    <?php // echo $form->field($model, 'KDDATI3') ?>

    <?php // echo $form->field($model, 'KDDATI2') ?>

    <?php // echo $form->field($model, 'KDDATI1') ?>

    <?php // echo $form->field($model, 'NOTELP') ?>

    <?php // echo $form->field($model, 'NOKTP') ?>

    <?php // echo $form->field($model, 'NPWP') ?>

    <?php // echo $form->field($model, 'NPWPZ') ?>

    <?php // echo $form->field($model, 'NIPLAMA') ?>

    <?php // echo $form->field($model, 'KDHITUNG') ?>

    <?php // echo $form->field($model, 'KODEBYR') ?>

    <?php // echo $form->field($model, 'induk_bank') ?>

    <?php // echo $form->field($model, 'NOREK') ?>

    <?php // echo $form->field($model, 'TMTBERLAKU') ?>

    <?php // echo $form->field($model, 'CATATAN') ?>

    <?php // echo $form->field($model, 'KDJNSTRANS') ?>

    <?php // echo $form->field($model, 'UPDSTAMP') ?>

    <?php // echo $form->field($model, 'INPUTER') ?>

    <?php // echo $form->field($model, 'kd_infaq') ?>

    <?php // echo $form->field($model, 'NOKARPEG') ?>

    <?php // echo $form->field($model, 'jnsguru') ?>

    <?php // echo $form->field($model, 'EMAIL') ?>

    <?php // echo $form->field($model, 'KD_JNS_PEG') ?>

    <?php // echo $form->field($model, 'updated') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
