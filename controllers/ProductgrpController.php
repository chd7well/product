<?php

namespace chd7well\sales\controllers;

use Yii;
use chd7well\sales\models\Productgrp;
use chd7well\sales\models\ProductgrpSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use chd7well\master\models\Modellog;

/**
 * ProductgrpController implements the CRUD actions for Productgrp model.
 */
class ProductgrpController extends Controller
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
     * Lists all Productgrp models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductgrpSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Productgrp model.
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
     * Creates a new Productgrp model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Productgrp();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
        	Modellog::logAction($model->className(), $id, \Yii::$app->user->identity->ID, Modellog::ACTION_CREATE, "Create Product Group");
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Productgrp model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		$oldmargin = $model->margin;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
        	Modellog::logAction($model->className(), $id, \Yii::$app->user->identity->ID, Modellog::ACTION_UPDATE, "Update Product Group - old profit margin:" . $oldmargin);
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Productgrp model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
    	Modellog::logAction($model->className(), $id, \Yii::$app->user->identity->ID, Modellog::ACTION_DELETE, "Delete Product Groupe");
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Productgrp model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Productgrp the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Productgrp::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
