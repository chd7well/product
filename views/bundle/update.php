<?php

use yii\helpers\Html;
use chd7well\master\widgets\HistoryWidget;

/* @var $this yii\web\View */
/* @var $model chd7well\sales\models\Bundle */

$this->title = Yii::t('sales', 'Update Bundle ') . ' ' . $model->bundle_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('sales', 'Bundles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->bundle_name, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = Yii::t('sales', 'Update');
?>
<div class="bundle-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

    
</div>

<?php 
echo HistoryWidget::widget(['modelname' => $model->className(),
							'model_ID' => $model->ID]);

?>