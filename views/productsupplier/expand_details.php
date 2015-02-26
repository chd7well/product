<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel chd7well\sales\models\ProductpurchasepriceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>
<div class="productpurchaseprice-details">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
   // 'layout'=>"{items}{errors}",
    'panel' => [
    		'type' => GridView::TYPE_PRIMARY,
    		'heading' => Yii::t('sales', 'Suppliers'),
    ],
    'toolbar' => [
    		['content'=>
    				Html::a('<i class="glyphicon glyphicon-plus"></i>', ['productpurchaseprice/add', 'id' => $purchaseid], ['data-pjax'=>0, 'class' => 'btn btn-success', 'title'=>Yii::t('sales', 'New retail price')]),
    		],
    		//'{export}',
    		//'{toggleData}',
    ],
    
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'ID',
         //   'purchase_ID',
            'fromdate',
            [
            'attribute' => 'purchaseprice',
            'value' => function ($model, $key, $index, $widget) {
            	// \Yii::$app->formatter->locale = 'de-DE';
            	return \Yii::$app->formatter->asCurrency($model->purchaseprice+0);
            },
            ],
            [
            'attribute' => 'suggested_retailprice',
            'value' => function ($model, $key, $index, $widget) {
            	// \Yii::$app->formatter->locale = 'de-DE';
            	return \Yii::$app->formatter->asCurrency($model->suggested_retailprice+0);
            },
            ],
            [
            'attribute' => 'comment',
          //  		'class' => 'kartik\grid\EditableColumn',
            'value' => function ($model, $key, $index, $widget) {
            	// \Yii::$app->formatter->locale = 'de-DE';
            	return "". $model->comment;
            },
            ],

        ],
    ]); ?>
