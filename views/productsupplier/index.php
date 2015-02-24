<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel chd7well\sales\models\ProductsupplierSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('sales', 'Productsuppliers');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="productsupplier-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('sales', 'Create {modelClass}', [
    'modelClass' => 'Productsupplier',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ID',
            'product_ID',
            'supplier_ID',
            'ordernumber',
            'comment',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
