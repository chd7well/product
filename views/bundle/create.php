<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model chd7well\sales\models\Bundle */

$this->title = Yii::t('sales', 'Create Bundles');
$this->params['breadcrumbs'][] = ['label' => Yii::t('sales', 'Bundles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bundle-create">

    <h1><?= Html::encode($this->title) ?></h1>
 <?= Yii::t('sales', 'A bundle is the next bigger unit. For example:  You have one <strong>box</strong> which contain <strong>10 pieces</strong> of an item. 
				<ul><li>The <strong>Bundle name</strong> is choosen as <i>pack of 10</i></li>
				<li>The <strong>Bundle unit</strong> is selected as <i>box</i></li>
				<li>The <strong>Item unit</strong> is selected as <i>piece</i></li>
				<li>The <strong>Item count</strong> is <i>10</i></li></ul>
		')?>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
