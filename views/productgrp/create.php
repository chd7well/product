<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model chd7well\sales\models\Productgrp */

$this->title = Yii::t('sales', 'Create {modelClass}', [
    'modelClass' => 'Productgrp',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('sales', 'Productgrps'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="productgrp-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
