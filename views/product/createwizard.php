<?php

use yii\helpers\Html;
use chd7well\wizard\Wizard;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model chd7well\sales\models\Product */

$this->title = Yii::t('sales', 'Create {modelClass}', [
    'modelClass' => 'Product',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('sales', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php //echo $this->render('_form', [ 'model' => $model,]) ?>

        <?php $form = ActiveForm::begin(); ?>
    <?php 
  $tabs = [
  		[
  			'tabtitle'=>Yii::t('sales', 'Product'),
  			'tabcontent'=>$this->render('_formw', [ 'model' => $product, 'form'=>$form]) . $this->render('../productbundle/_formw', [ 'model' => $productbundle, 'form'=>$form]),		
  		],
  		[
  		'tabtitle'=>Yii::t('sales', 'Supplier'),
  		'tabcontent'=>$this->render('../productsupplier/_formw', [ 'model' => $supplier, 'form'=>$form]),
  		],
  		[
  		'tabtitle'=>Yii::t('sales', 'Price'),
  		'tabcontent'=>$this->render('../prices/_formw', [ 'model' => $prices, 'form'=>$form]),
  		],
  ];
    
    echo Wizard::widget(['tabs'=>$tabs]);

    ?>
    
    <div class="form-group">
        <?= Html::submitButton(Yii::t('sales', 'Create'), ['class' => 'btn btn-success']) ?>
    </div>
    
</div>
