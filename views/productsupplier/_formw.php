<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model chd7well\sales\models\Productsupplier */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="productsupplier-form">



    <?= $form->field($model, 'supplier_ID')->dropDownList($model->SupplierList) ?>

    <?= $form->field($model, 'ordernumber')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'comment')->textInput(['maxlength' => 255]) ?>





</div>
