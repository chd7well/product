<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\money\MaskMoney;

/* @var $this yii\web\View */
/* @var $model chd7well\sales\models\Productsupplier */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="productsupplier-form">




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
                
                <?= Yii::t('sales', 'If you leaf retail price blank, the system will fill in the price automatically. (e.g. by the suggested price or by the purchase price additional product group marge)') . "<br>"?>
                
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
        





</div>
