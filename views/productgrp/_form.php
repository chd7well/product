<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\money\MaskMoney;

/* @var $this yii\web\View */
/* @var $model chd7well\sales\models\Productgrp */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="productgrp-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'groupname')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'margin')->widget(MaskMoney::classname(), [
'pluginOptions' => [
'prefix' => '',
'suffix' => ' %',
'allowNegative' => false,
'decimal' => '.',
'precision' => 2,
]
]);?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('sales', 'Create') : Yii::t('sales', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
