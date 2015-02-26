<?php

namespace chd7well\sales\controllers;

use Yii;
use chd7well\sales\models\Productpurchaseprice;
use chd7well\sales\models\ProductpurchasepriceSearch;
use chd7well\sales\models\Productsupplier;
use chd7well\sales\models\Productretailprice;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use chd7well\master\models\Modellog;
use chd7well\sales\models\Prices;

/**
 * ProductpurchasepriceController implements the CRUD actions for Productpurchaseprice model.
 */
class ProductpurchasepriceController extends Controller
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
     * Lists all Productpurchaseprice models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductpurchasepriceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Productpurchaseprice model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Productpurchaseprice model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Productpurchaseprice();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ID]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Creates a new Productbundle model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionAdd($id)
    {
    	$model = new Prices();
    	$model->purchase_ID = $id;
    
    	if ($model->load(Yii::$app->request->post()) && $model->validate()) {
    		$purchase = Productsupplier::findOne(['ID'=>$model->purchase_ID]);
    		
    		$pprice = new Productpurchaseprice();
    		$pprice->purchase_ID = $model->purchase_ID;
    		$pprice->fromdate = date("Y-m-d",time());
    		$pprice->suggested_retailprice = $model->suggestedprice;
    		$pprice->purchaseprice = $model->purchaseprice;
    		$pprice->comment = $model->comment;
    		$pprice->save(false);
    		Modellog::logAction($pprice->className(), $purchase->product_ID, \Yii::$app->user->identity->ID, Modellog::ACTION_CREATE, "Added purchaseprice " . $pprice->purchaseprice);
    		 
    		
    		$rprice = new Productretailprice();
    		$rprice->product_ID = $purchase->product_ID;
    		$rprice->fromdate = date("Y-m-d",time());
    		$model->setRetailprice($purchase->product->productgrp->margin/100);
    		$rprice->retailprice = $model->retailprice;
    		$rprice->save(false);
    		Modellog::logAction($rprice->className(), $purchase->product_ID, \Yii::$app->user->identity->ID, Modellog::ACTION_CREATE, "Added retail price " . $rprice->retailprice);
    		 
    
    	
    		return $this->redirect(['product/view', 'id' => $purchase->product_ID]);
    	} else {
    		return $this->render('add', [
    				'model' => $model,
    		]);
    	}
    }
    
    /**
     * Updates an existing Productpurchaseprice model.
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
     * Deletes an existing Productpurchaseprice model.
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
     * Finds the Productpurchaseprice model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Productpurchaseprice the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Productpurchaseprice::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
