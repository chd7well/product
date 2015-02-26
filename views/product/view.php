<?php

use yii\helpers\Html;
//use yii\widgets\DetailView;
use kartik\detail\DetailView;
//use yii\grid\GridView;
use kartik\grid\GridView;
use chd7well\master\models\Unit;
use chd7well\sales\models\Bundle;
use yii\widgets\ActiveForm;
use chd7well\master\widgets\HistoryWidget;
use chd7well\sales\models\Productpurchaseprice;
use yii\data\ActiveDataProvider;
/* @var $this yii\web\View */
/* @var $model chd7well\sales\models\Product */

$this->title = $model->productname;
$this->params['breadcrumbs'][] = ['label' => Yii::t('sales', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view">

	<h1><?= Html::encode($this->title) ?></h1>

	<p>
        <?php ?>
    </p>

    <?php 

        echo DetailView::widget ( [ 
						'model' => $model,
		//				'condensed' => true,
	//					'hover' => true,
						'mode' => DetailView::MODE_VIEW,
						'panel' => [ 
								'heading' => Yii::t('sales', 'Product Details'),
								'type' => DetailView::TYPE_INFO 
						],
						'attributes' => [ 
								//'itemnumber',
								[
								'attribute'=>'itemnumber',	
								'label'=>Yii::t('sales', 'Itemnumber'),
								'type'=>DetailView::INPUT_TEXT,
								'value' => $model->itemnumber,
								//'rowOptions'=>['class'=>'kv-view-hidden'],
        						],
								'productname',
								[
										'attribute'=>'description',
										'format'=>'raw',
										'value'=>'<span class="text-justify"><em>' . $model->description . '</em></span>',
										'type'=>DetailView::INPUT_TEXTAREA,
										'options'=>['rows'=>4],
        						],
								'GS1GTIN',
							//	'unit_ID',
								[
								'attribute'=>'unit_ID',
								'format'=>'raw',
								'value'=>$model->unit->unit,
								'type'=>DetailView::INPUT_SELECT2,
								'widgetOptions'=>[
												'data'=>Unit::getUnitList(),
												'options' => ['placeholder' => 'Select ...'],
												'pluginOptions' => ['allowClear'=>true]
    							],
												'inputWidth' => '40%'
],
								'productgrp_ID',
								
						],
        		'deleteOptions'=>[
        				'url'=>['delete', 'id'=>$model->ID],
        				'data'=>[
        						'confirm'=>Yii::t('sales',
        						'Are you sure you want to delete this record?'
            						),
            						'method'=>'post',
        		            ],
        		            ]
        		 
				] );
        ?>
                <?= GridView::widget([
        'dataProvider' => $suppliers,
        'panel' => [
        		'type' => GridView::TYPE_PRIMARY,
        		'heading' => Yii::t('sales', 'Suppliers'),
        ],
        'toolbar' => [
        		['content'=>
        				Html::a('<i class="glyphicon glyphicon-plus"></i>', ['productsupplier/add', 'id' => $model->ID], ['data-pjax'=>0, 'class' => 'btn btn-success', 'title'=>Yii::t('sales', 'New retail price')]),
        		],
        		//'{export}',
        		//'{toggleData}',
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
            'class'=>'kartik\grid\ExpandRowColumn',
            'width'=>'50px',
            'value'=>function ($model, $key, $index, $column) {
            	return GridView::ROW_COLLAPSED;
            },
            'detail'=>function ($model, $key, $index, $column) {
		            $query = Productpurchaseprice::find();
		            $query->andFilterWhere(['purchase_ID'=>$model->ID])->orderBy(['fromdate' => SORT_DESC, 'ID'=> SORT_DESC]);
		            $dataProvider = new ActiveDataProvider([
		            		'query' => $query,
		            ]);

            	return Yii::$app->controller->renderPartial('../productsupplier/expand_details', ['dataProvider'=>$dataProvider, 'purchaseid'=>$model->ID]);
            },
            'headerOptions'=>['class'=>'kartik-sheet-style']
            //'disabled'=>true,
            //'detailUrl'=>Url::to(['/site/test-expand'])
            ],
            
           'supplier.partnername',
           'ordernumber',
           'comment',
            //'bundle_ID',
                [
			    'class' => 'yii\grid\ActionColumn',
			    'template' => '{delete}',
    		'buttons' => [
    		'delete' => function ($url, $model, $key) {
    			 /*return Html::a('<span class="glyphicons glyphicons-trash"></span>', ['productsupplier/delete', 'id' => $model->ID], [
							'title' => Yii::t('yii', 'Inactivate'),
							'data-confirm' => Yii::t('yii', 'Are you sure you want to disable the supplier entry?'),
							'data-method' => 'post',
							'data-pjax' => '0',
							]);*/
    			 return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['productsupplier/delete', 'id' => $model->ID], [
    			 		'title' => Yii::t('yii', 'Disable'),
    			 		'data-confirm' => Yii::t('yii', 'Are you sure you want to disable the supplier entry?'),
    			 		'data-method' => 'post',
    			 		'data-pjax' => '0',
    			 ]);
    		},],
    ],
        ],
    ]); ?>
    
        <div class="row">
<div class="col-lg-6">
    <?= GridView::widget([
        'dataProvider' => $bundles,
        'panel' => [
        		'type' => GridView::TYPE_PRIMARY,
        		'heading' => Yii::t('sales', 'Bundles'),
        ],
        'toolbar' => [
        		['content'=>
        		Html::a('<i class="glyphicon glyphicon-plus"></i>', ['productbundle/add', 'id' => $model->ID], ['data-pjax'=>0, 'class' => 'btn btn-success', 'title'=>Yii::t('sales', 'Add Bundle')]),	
        		],
      
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           //'bundle.bundle_name',
           [
           'class' => 'kartik\grid\EditableColumn',
           'attribute' => 'bundle_ID',
           'value' => 'bundle.bundle_name',
           /*'value' =>  function ($model, $key, $index, $widget) { 
	        return "-" . $model->bundle->bundle_name;
    		},*/
           'vAlign' => 'middle',
           'width' => '220px',
            'editableOptions' =>   [
    		'header' => Yii::t('sales', 'Bundles'),
    		'inputType' => \kartik\editable\Editable::INPUT_SELECT2, 
    		'options' => [
    		'data'=>Bundle::getBundleList(),
    		'value'=>'bundle_name',
    		'pluginOptions'=>[
    				'autoclose'=>true
    		]
    		]
    ],
           ],
            //'bundle_ID',
            ['class' => 'yii\grid\ActionColumn',
        		'template' => '{delete}',
        		'buttons' => [
        				/*'update' => function ($url, $model, $key) {
        				 return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'practice/update/id/' . $model->ID, [
        				 		'title' => Yii::t('yii', 'Update'),
        				 		'data-pjax' => '0',
        				 ]);
        		},*/
        				'delete' => function ($url, $model, $key) {
        					return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['productbundle/delete', 'id' => $model->ID], [
        							'title' => Yii::t('yii', 'Delete'),
        							'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this bundle?'),
        							'data-method' => 'post',
        							'data-pjax' => '0',
        					]);
        				},],
        		],
        ],
    ]); ?>
    </div><div class="col-lg-6">
    
        <?= GridView::widget([
        'dataProvider' => $retailprices,
        'panel' => [
        		'type' => GridView::TYPE_PRIMARY,
        		'heading' => Yii::t('sales', 'Retail Prices'),
        ],
        'toolbar' => [
        		['content'=>
        				Html::a('<i class="glyphicon glyphicon-plus"></i>', ['productretailprice/add', 'id' => $model->ID], ['data-pjax'=>0, 'class' => 'btn btn-success', 'title'=>Yii::t('sales', 'New retail price')]),
        		],
        		//'{export}',
        		//'{toggleData}',
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           [
           'attribute' => 'fromdate',
           'value' => function ($model, $key, $index, $widget) { 
          // \Yii::$app->formatter->locale = 'de-DE';
        	return \Yii::$app->formatter->asDate($model->fromdate);
    },
           ],
           [
           'attribute' => 'retailprice',
           'value' => function ($model, $key, $index, $widget) {
           	// \Yii::$app->formatter->locale = 'de-DE';
           	return \Yii::$app->formatter->asCurrency($model->retailprice);
           },
           ],
            //'bundle_ID',
            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    </div></div>

    
</div>

<?php 
echo HistoryWidget::widget(['modelname' => ['chd7well\sales\models\Product', 'chd7well\sales\models\Productbundle', 'chd7well\sales\models\Productretailprice', 'chd7well\sales\models\Productsupplier', 'chd7well\sales\models\Productpurchaseprice'],
							'model_ID' => $model->ID]);

?>

