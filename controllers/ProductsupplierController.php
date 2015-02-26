<?php

namespace chd7well\sales\controllers;

use Yii;
use chd7well\sales\models\Productsupplier;
use chd7well\sales\models\ProductsupplierSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use chd7well\master\models\Modellog;

/**
 * ProductsupplierController implements the CRUD actions for Productsupplier model.
 */
class ProductsupplierController extends Controller
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
     * Lists all Productsupplier models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductsupplierSearch();
     	
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
	
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Productsupplier model.
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
     * Creates a new Productsupplier model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Productsupplier();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ID]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Creates a new Productsupplier model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionAdd($id)
    {
    	$model = new Productsupplier();
    
    	$model->product_ID = $id;
    	$model->active = true;
    	
    	if ($model->load(Yii::$app->request->post()) && $model->save()) {
    		Modellog::logAction($model->className(), $model->product_ID, \Yii::$app->user->identity->ID, Modellog::ACTION_CREATE, "Create product supplier " . $model->supplier->partnername);
    		return $this->redirect(['productpurchaseprice/add', 'id' => $model->ID]);
    	} else {
    		return $this->render('add', [
    				'model' => $model,
    				'id'=>$id,
    		]);
    	}
    }
    
    /**
     * Updates an existing Productsupplier model.
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
     * Deletes an existing Productsupplier model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
		$model->active = false;
		$model->update('active');
		Modellog::logAction($model->className(), $model->product_ID, \Yii::$app->user->identity->ID, Modellog::ACTION_DISABLED, "Disabled supplier " . $model->supplier->partnername . "with ordnerumber ". $model->ordernumber);
        return $this->redirect(['product/view', 'id' => $model->product_ID]);
    }

    /**
     * Finds the Productsupplier model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Productsupplier the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Productsupplier::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
