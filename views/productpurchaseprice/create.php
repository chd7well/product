<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model chd7well\sales\models\Productpurchaseprice */

$this->title = Yii::t('sales', 'Create {modelClass}', [
    'modelClass' => 'Productpurchaseprice',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('sales', 'Productpurchaseprices'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="productpurchaseprice-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
