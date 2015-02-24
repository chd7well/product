<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model chd7well\sales\models\Productsupplier */

$this->title = Yii::t('sales', 'Create {modelClass}', [
    'modelClass' => 'Productsupplier',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('sales', 'Productsuppliers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="productsupplier-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
