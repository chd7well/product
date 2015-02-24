<?php

namespace chd7well\sales\models;

use Yii;
use yii\base\Model;
/**

 */
class Prices extends Model
{

	public $purchaseprice;
	public $retailprice;
	public $suggestedprice;
	
	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
				[['purchaseprice', 'retailprice', 'suggestedprice'], 'number'],
			];
	}
	
	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
				'purchaseprice' => Yii::t('sales', 'Purchase Price'),
				'retailprice' => Yii::t('sales', 'Retail Price'),
				'suggestedprice' => Yii::t('sales', 'Suggested Price'),
		];
	}
	
	
	
				 
}