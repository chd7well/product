<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel chd7well\sales\models\ProductpurchasepriceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('sales', 'Productpurchaseprices');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="productpurchaseprice-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('sales', 'Create {modelClass}', [
    'modelClass' => 'Productpurchaseprice',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ID',
            'purchase_ID',
            'fromdate',
            'purchaseprice',
            'suggested_retailprice',
            'comment',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
