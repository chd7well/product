<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel chd7well\sales\models\ProductgrpSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('sales', 'Product Groups');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="productgrp-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('sales', 'Create Product Group'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'groupname',
            'margin',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
