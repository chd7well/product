<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model chd7well\sales\models\Productbundle */

$this->title = $model->ID;
$this->params['breadcrumbs'][] = ['label' => Yii::t('sales', 'Productbundles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="productbundle-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('sales', 'Update'), ['update', 'id' => $model->ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('sales', 'Delete'), ['delete', 'id' => $model->ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('sales', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ID',
            'bundle_ID',
            'product_ID',
        ],
    ]) ?>

</div>
