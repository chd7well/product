<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\money\MaskMoney;

/* @var $this yii\web\View */
/* @var $model chd7well\sales\models\Productsupplier */
/* @var $form yii\widgets\ActiveForm */
$this->title = Yii::t('sales', 'Add Purchase Price');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="productsupplier-form">


 <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'purchaseprice')->widget(MaskMoney::classname(), [
'pluginOptions' => [
'prefix' => '',
'suffix' => ' €',
'allowNegative' => false,
		'thousands' => '.',
		'decimal' => ',',
		'precision' => 2,
]
]); ?>
    
                <?= $form->field($model, 'suggestedprice')->widget(MaskMoney::classname(), [
'pluginOptions' => [
'prefix' => '',
'suffix' => ' €',
'allowNegative' => false,
		'thousands' => '.',
		'decimal' => ',',
		'precision' => 2,
]
]); ?>
                
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
                        
                <?= $form->field($model, 'comment')->textarea(['rows' => 2]) ?>
                
    <div class="form-group">
        <?= Html::submitButton(Yii::t('sales', 'Add Purchase Price'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
