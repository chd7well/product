<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model chd7well\sales\models\ProductsupplierSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="productsupplier-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'product_ID') ?>

    <?= $form->field($model, 'supplier_ID') ?>

    <?= $form->field($model, 'ordernumber') ?>

    <?= $form->field($model, 'comment') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('sales', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('sales', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
