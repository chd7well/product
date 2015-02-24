<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model chd7well\sales\models\Productpurchaseprice */

$this->title = Yii::t('sales', 'Update {modelClass}: ', [
    'modelClass' => 'Productpurchaseprice',
]) . ' ' . $model->ID;
$this->params['breadcrumbs'][] = ['label' => Yii::t('sales', 'Productpurchaseprices'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = Yii::t('sales', 'Update');
?>
<div class="productpurchaseprice-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
