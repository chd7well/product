<?php

namespace chd7well\sales\controllers;

use Yii;
use yii\base\Model;
use chd7well\sales\models\Product;
use chd7well\sales\models\ProductSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use chd7well\master\models\Ron;
use chd7well\sales\models\Supplier;
use chd7well\sales\models\Productsupplier;
use chd7well\sales\models\Prices;
use chd7well\sales\models\Productbundle;
use chd7well\sales\models\Productpurchaseprice;
use chd7well\sales\models\Productretailprice;
use yii\data\ActiveDataProvider;
use yii\helpers\Json;
use chd7well\master\models\Modellog;
/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
    	$model = $this->findModel($id);

    	$bundles = Productbundle::find();
    	$bundles->where(['product_ID'=>$model->ID]);

    	$retailprices = Productretailprice::find();
    	$retailprices->where(['product_ID'=>$model->ID]);
    	$retailprices->orderBy(['fromdate' => SORT_DESC, 'ID'=> SORT_DESC]);
    	
    	$suppliers = Productsupplier::find();
    	$suppliers->where(['product_ID'=>$model->ID, 'active'=>true]);
    
    	if (\Yii::$app->request->post('hasEditable')) {
    		$out = Json::encode(['output'=>'', 'message'=>'']);
    		$editableKey = $_POST['editableKey'];
    		$post = [];
    		
    		if(isset($_POST['Productbundle']))
    		{
    			$bundle = Productbundle::findOne($editableKey);
    			$posted = current($_POST['Productbundle']);
    			$post['Productbundle'] = $posted;
    			if($bundle->load($post))
    			{
    				$bundle->update(true, ['bundle_ID']);
    				Modellog::logAction($bundle->className(), $bundle->product_ID, \Yii::$app->user->identity->ID, Modellog::ACTION_UPDATE, "Updated Bundle unit to" . $bundle->bundle->bundle_name);
    				$output = $bundle->bundle->bundle_name;
    			}
    			else {
    				$output = "error";
    			}
    		}
    			
    		
    		$out = Json::encode(['output'=>$output, 'message'=>'']);
    		// return ajax json encoded response and exit
    		echo $out;
    		return;
    	
    	}
    	
    	if($model->load(\Yii::$app->request->post()) && $model->save())
    	{
    		Modellog::logAction($model->className(), $model->ID, \Yii::$app->user->identity->ID, Modellog::ACTION_UPDATE, "Updated Product " . $model->productname);
    		return $this->redirect(['view', 'id'=>$model->ID]);
    	}
        return $this->render('view', [
            'model' => $model,
        	'bundles' => new ActiveDataProvider([
    						'query' => $bundles,
    					]),
        		'retailprices'=> new ActiveDataProvider([
    							'query' => $retailprices,
    							]),
        		'suppliers'=>new ActiveDataProvider([
    							'query' => $suppliers,
    							]),
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();
		$model->itemnumber = Ron::getNextValue('Itemnumber');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ID]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    
    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreatewizard()
    {
    	$product = new Product();
    	$product->itemnumber = Ron::getNextValue('Itemnumber');
    	$product->genitemnumber = $product->itemnumber;
    	$supplier = new Productsupplier();
    	$prices = new Prices();
    	$productbundle = new Productbundle();
    	$productbundle->bundle_ID = 0;
    	print_r(Yii::$app->request->post());
    	//if ($product->load(Yii::$app->request->post()) && $product->save()) {
    	if(
    			$product->load(Yii::$app->request->post()) 
    			&& $supplier->load(Yii::$app->request->post()) 
    			&& $prices->load(Yii::$app->request->post()) 
    			&& $productbundle->load(Yii::$app->request->post()) 
    			//&& Model::validateMultiple([$product, $supplier, $prices, $productbundle])
    			&& $product->validate()
    			&& $supplier->validate(['supplier_ID', 'ordernumber', 'comment'])
    			&& $prices->validate()
    			&& $productbundle->validate(['bundle_ID'])
    			){
   
    		//return $this->redirect(['view', 'id' => $product->ID]);
    			if($product->itemnumber === $product->genitemnumber)
    			{
    				$product->itemnumber = Ron::getAndIncValue('Itemnumber');
    			}
    			$product->save(false);
    			Modellog::logAction($product->className(), $product->ID, \Yii::$app->user->identity->ID, Modellog::ACTION_CREATE, "Create product " . $model->productname);
    			
    			$supplier->product_ID = $product->ID;
    			$supplier->active = true;
    			$supplier->save(false);
    			Modellog::logAction($supplier->className(), $product->ID, \Yii::$app->user->identity->ID, Modellog::ACTION_CREATE, "Create product supplier " . $supplier->supplier->partnername);
    			
    			
    			if($productbundle->bundle_ID != 0)
    			{
    				$productbundle->product_ID = $product->ID;
    				$productbundle->save(false);
    			}
    			
    			$pprice = new Productpurchaseprice();
    			$pprice->purchase_ID = $supplier->ID;
    			$pprice->fromdate = date("Y-m-d",time());
    			$pprice->suggested_retailprice = $prices->suggestedprice;
    			$pprice->purchaseprice = $prices->purchaseprice;
    			$pprice->save(false);
    			Modellog::logAction($pprice->className(), $product->ID, \Yii::$app->user->identity->ID, Modellog::ACTION_CREATE, "Added purchaseprice " . $pprice->purchaseprice);
    			
    			$rprice = new Productretailprice();
    			$rprice->product_ID = $product->ID;
    			$rprice->fromdate = date("Y-m-d",time());
    			$prices->setRetailprice($product->productgrp->margin/100);
    			$rprice->retailprice = $prices->retailprice;
    			
    			/*if($prices->retailprice == null || $prices->retailprice === "" || $prices->retailprice == 0)
    			{
    				if($prices->suggestedprice == null || $prices->suggestedprice === "" || $prices->suggestedprice == 0)
    				{
    					$margin = $product->productgrp->margin/100;
    					$rprice->retailprice = $prices->purchaseprice * (1+$margin);
    				}
    				else {
    					$rprice->retailprice = $prices->suggestedprice;
    				}
    			}
    			else 
    			{
    				$prices->retailprice = $prices->retailprice;
    			}*/
    			$rprice->save(false);
    			Modellog::logAction($rprice->className(), $product->ID, \Yii::$app->user->identity->ID, Modellog::ACTION_CREATE, "Added retail price " . $rprice->retailprice);
    			
    			return $this->redirect(['view', 'id' => $product->ID]);
    			
    	} else {
    		return $this->render('createwizard', [
    				'product' => $product,
    				'productbundle'=> $productbundle,
    				'supplier' => $supplier,
    				'prices' => $prices,
    		]);
    	}
    }
    
    
    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ID]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
