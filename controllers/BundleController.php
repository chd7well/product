<?php

namespace chd7well\sales\controllers;

use Yii;
use chd7well\sales\models\Bundle;
use chd7well\sales\models\BundleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use chd7well\master\models\Modellog;

/**
 * BundleController implements the CRUD actions for Bundle model.
 */
class BundleController extends Controller
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
     * Lists all Bundle models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BundleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Bundle model.
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
     * Creates a new Bundle model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Bundle();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
        	Modellog::logAction($model->className(), $model->ID, \Yii::$app->user->identity->ID, Modellog::ACTION_CREATE, "Created Bundle");
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Bundle model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
        	Modellog::logAction($model->className(), $id, \Yii::$app->user->identity->ID, Modellog::ACTION_UPDATE, "Updated Bundle");
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Bundle model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
    	$model = $this->findModel($id);
    	Modellog::logAction($model->className(), $id, \Yii::$app->user->identity->ID, Modellog::ACTION_DELETE, "Deleted Bundle " . $model->bundle_name);
        $model->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Bundle model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Bundle the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Bundle::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
