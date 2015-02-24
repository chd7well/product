<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model chd7well\sales\models\ProductSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'productname') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'itemnumber') ?>

    <?= $form->field($model, 'GS1GTIN') ?>

    <?php // echo $form->field($model, 'unit_ID') ?>

    <?php // echo $form->field($model, 'productgrp_ID') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('sales', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('sales', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
