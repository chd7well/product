<?php

use yii\helpers\Html;


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

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
