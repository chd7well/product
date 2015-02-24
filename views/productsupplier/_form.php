<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model chd7well\sales\models\Productsupplier */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="productsupplier-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'product_ID')->textInput() ?>

    <?= $form->field($model, 'supplier_ID')->textInput() ?>

    <?= $form->field($model, 'ordernumber')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'comment')->textInput(['maxlength' => 255]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('sales', 'Create') : Yii::t('sales', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
