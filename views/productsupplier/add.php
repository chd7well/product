<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model chd7well\sales\models\Productsupplier */
/* @var $form yii\widgets\ActiveForm */
$this->title = Yii::t('sales', 'Add Supplier');
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="productsupplier-form">


 <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'supplier_ID')->dropDownList($model->SupplierList) ?>

    <?= $form->field($model, 'product_ID')->hiddenInput()->label(false) ?>
    
    <?= $form->field($model, 'ordernumber')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'comment')->textInput(['maxlength' => 255]) ?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('sales', 'Add Supplier'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    </div>
    