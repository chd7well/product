<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model chd7well\sales\models\ProductpurchasepriceSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="productpurchaseprice-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'purchase_ID') ?>

    <?= $form->field($model, 'fromdate') ?>

     <?= $form->field($model, 'purchaseprice') ?>
     
    <?= $form->field($model, 'suggested_retailprice') ?>

    <?= $form->field($model, 'comment') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('sales', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('sales', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
