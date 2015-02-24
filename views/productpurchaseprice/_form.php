<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model chd7well\sales\models\Productpurchaseprice */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="productpurchaseprice-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'purchase_ID')->textInput() ?>

    <?= $form->field($model, 'fromdate')->textInput() ?>
    
     <?= $form->field($model, 'purchaseprice')->textInput() ?>

    <?= $form->field($model, 'suggested_retailprice')->textInput() ?>

    <?= $form->field($model, 'comment')->textInput(['maxlength' => 255]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('sales', 'Create') : Yii::t('sales', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
