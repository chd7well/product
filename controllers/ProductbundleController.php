<?php

namespace chd7well\sales\controllers;

use Yii;
use chd7well\sales\models\Productbundle;
use chd7well\sales\models\ProductbundleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use chd7well\master\models\Modellog;

/**
 * ProductbundleController implements the CRUD actions for Productbundle model.
 */
class ProductbundleController extends Controller
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
     * Lists all Productbundle models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductbundleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Productbundle model.
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
     * Creates a new Productbundle model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Productbundle();

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
    	$model = new Productbundle();
    	$model->product_ID = $id;
    
    	if ($model->load(Yii::$app->request->post()) && $model->save()) {
    		Modellog::logAction($model->className(), $model->product_ID, \Yii::$app->user->identity->ID, Modellog::ACTION_CREATE, "Added new product bundle" . $model->bundle->bundle_name);
    		return $this->redirect(['product/view', 'id' => $model->product_ID]);
    	} else {
    		return $this->render('add', [
    				'model' => $model,
    		]);
    	}
    }
    
    /**
     * Updates an existing Productbundle model.
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
     * Deletes an existing Productbundle model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
    	$model = $this->findModel($id);
    	$product_id = $model->product_ID;
        $model->delete();

        return $this->redirect(['product/view', 'id'=>$product_id]);
    }

    /**
     * Finds the Productbundle model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Productbundle the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Productbundle::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
