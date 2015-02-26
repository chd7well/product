<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\money\MaskMoney;
use kartik\datecontrol\DateControl;

/* @var $this yii\web\View */
/* @var $model chd7well\sales\models\Productbundle */
/* @var $form yii\widgets\ActiveForm */
$this->title = Yii::t('sales', 'Add new product retail price');
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="productbundle-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'retailprice')->widget(MaskMoney::classname(), [
'pluginOptions' => [
'prefix' => '',
'suffix' => ' €',
'allowNegative' => false,
		'thousands' => '.',
		'decimal' => ',',
		'precision' => 2,
]
]); ?>
    
        <?= $form->field($model, 'fromdate')->widget(DateControl::classname(), [
 'type'=>DateControl::FORMAT_DATE,
'ajaxConversion'=>false,
'options' => [
'pluginOptions' => [
'autoclose' => true
]
]
]); ?>
        
    <?= $form->field($model, 'product_ID')->hiddenInput()->label(false); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('sales', 'Add New Price'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
