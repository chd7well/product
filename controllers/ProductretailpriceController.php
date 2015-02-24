<?php

namespace chd7well\sales\controllers;

use Yii;
use chd7well\sales\models\Bundle;
use chd7well\sales\models\BundleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use chd7well\master\models\Modellog;
use chd7well\sales\models\Productretailprice;

/**
 * BundleController implements the CRUD actions for Bundle model.
 */
class ProductretailpriceController extends Controller
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

  public function actionAdd($id)
  {
  	$model = new Productretailprice();
  	$model->product_ID = $id;
  	
  	if ($model->load(Yii::$app->request->post()) && $model->save()) {
  		if($model->fromdate == null || $model->fromdate==="")
  		{
  			$model->fromdate = date("Y-m-d",time());
  		}
  		Modellog::logAction($model->className(), $model->product_ID, \Yii::$app->user->identity->ID, Modellog::ACTION_CREATE, "Added new retail price " . $model->retailprice . " from " . $model->fromdate);
  		return $this->redirect(['product/view', 'id' => $model->product_ID]);
  	} else {
  		return $this->render('add', [
  				'model' => $model,
  		]);
  	}
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
