<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model chd7well\sales\models\Productbundle */

$this->title = Yii::t('sales', 'Create {modelClass}', [
    'modelClass' => 'Productbundle',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('sales', 'Productbundles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="productbundle-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
