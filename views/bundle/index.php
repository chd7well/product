<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel chd7well\sales\models\BundleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('sales', 'Bundles');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bundle-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('sales', 'Create {modelClass}', [
    'modelClass' => 'Bundle',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'bundle_name',
            'bundleUnit.unit',
            'itemUnit.unit',
            'item_count',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
