<?php

namespace chd7well\sales\models;

use Yii;
use yii\base\Model;
/**

 */
class Prices extends Model
{

	public $purchase_ID;
	public $comment;
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
				[['comment'], 'string', 'max' => 255]
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
	
	
	public function setRetailprice($margin = 0)
	{
		if($this->retailprice == null || $this->retailprice === "" || $this->retailprice == 0)
		{
			if($this->suggestedprice == null || $this->suggestedprice === "" || $this->suggestedprice == 0)
			{
				$this->retailprice = $this->purchaseprice * (1+$margin);
			}
			else {
				$this->retailprice = $this->suggestedprice;
			}
		}
		else
		{
			$this->retailprice = $this->retailprice;
		}
	}
				 
}