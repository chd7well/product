<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model chd7well\sales\models\Productbundle */

$this->title = Yii::t('sales', 'Update {modelClass}: ', [
    'modelClass' => 'Productbundle',
]) . ' ' . $model->ID;
$this->params['breadcrumbs'][] = ['label' => Yii::t('sales', 'Productbundles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = Yii::t('sales', 'Update');
?>
<div class="productbundle-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
