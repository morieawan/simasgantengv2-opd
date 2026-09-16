<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\depdrop\DepDrop;
use kartik\select2\Select2;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\modules\integrasi\models\SiasnDataUtamaSearch */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Cari Data ASN';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="siasn-data-utama-search">

    <h4><?= Html::encode($this->title) ?></h4>

    <?php $form = ActiveForm::begin([
        'action' => ['index-opd'],
        'method' => 'get',
        'id' => 'cari-form', 
        'type' => ActiveForm::TYPE_HORIZONTAL,
        'fieldConfig' => ['options' => ['class' => 'form-group mr-2 mb-3']], 
    ]); ?>

    <?= $form->field($model, 'simpeg')->widget(Select2::classname(), [
            'data' => ArrayHelper::map($pd, 'KOLOK', 'pd'),
            'language' => 'id',
            'options' => [
              'placeholder' => '- Pilih -',
              'id'=>'cat-id',
            ],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])->label('OPD');?>  

    <div class="form-group">
        <?= Html::submitButton('<span class="fas fa-search"></span> Cari Data', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
