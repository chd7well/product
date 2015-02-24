<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model chd7well\sales\models\Productbundle */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="productbundle-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'bundle_ID')->textInput() ?>

    <?= $form->field($model, 'product_ID')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('sales', 'Create') : Yii::t('sales', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
