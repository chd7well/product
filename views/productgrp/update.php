<?php

use yii\helpers\Html;
use chd7well\master\widgets\HistoryWidget;

/* @var $this yii\web\View */
/* @var $model chd7well\sales\models\Productgrp */

$this->title = Yii::t('sales', 'Update Product Group ');
$this->params['breadcrumbs'][] = ['label' => Yii::t('sales', 'Product Group'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->groupname, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = Yii::t('sales', 'Update');
?>
<div class="productgrp-update">

     <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php 
echo HistoryWidget::widget(['modelname' => $model->className(),
							'model_ID' => $model->ID]);

?>