<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use chd7well\master\widgets\HistoryWidget;

/* @var $this yii\web\View */
/* @var $model chd7well\sales\models\Bundle */

$this->title = Yii::t('sales', 'Bundle') . $model->bundle_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('sales', 'Bundles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bundle-view">

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
            'bundle_name',
            'bundleUnit.unit',
            'itemUnit.unit',
            'item_count',
        ],
    ]) ?>

</div>
<?php 
echo HistoryWidget::widget(['modelname' => $model->className(),
							'model_ID' => $model->ID]);

?>