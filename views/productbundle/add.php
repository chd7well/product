<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model chd7well\sales\models\Productbundle */
/* @var $form yii\widgets\ActiveForm */
$this->title = Yii::t('sales', 'Add Bundle');
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="productbundle-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'bundle_ID')->dropDownList($model->getBundleList(false)) ?>

    <?= $form->field($model, 'product_ID')->hiddenInput()->label(false); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('sales', 'Add Bundle'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
