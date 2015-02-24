<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model chd7well\sales\models\Product */

$this->title = Yii::t('sales', 'Update {modelClass}: ', [
    'modelClass' => 'Product',
]) . ' ' . $model->ID;
$this->params['breadcrumbs'][] = ['label' => Yii::t('sales', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = Yii::t('sales', 'Update');
?>
<div class="product-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
