<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model chd7well\sales\models\Productbundle */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="productbundle-form">



    <?= $form->field($model, 'bundle_ID')->dropDownList($model->getBundleList(true)) ?>

    


</div>
