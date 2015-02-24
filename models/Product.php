<?php
/*
 * This file is part of the chd7well project.
 *
 * (c) chd7well project <http://github.com/chd7well/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace chd7well\sales\models;

use Yii;
use chd7well\master\models\Unit;
use yii\helpers\ArrayHelper;


/**
 * This is the model class for table "{{%sales_product}}".
 *
 * @property integer $ID
 * @property string $productname
 * @property string $description
 * @property string $itemnumber
 * @property string $GS1GTIN
 * @property integer $unit_ID
 * @property integer $productgrp_ID
 *
 * @property SalesProductgrp $productgrp
 * @property SalesProductBundle[] $salesProductBundles
 * @property SalesProductRetailPrice[] $salesProductRetailPrices
 * @property SalesProductSupplier[] $salesProductSuppliers
 * @author Christian Dumhart <christian.dumhart@chd.at>
 */
class Product extends \yii\db\ActiveRecord
{
	public $genitemnumber;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%sales_product}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['productname', 'itemnumber'], 'required'],
            [['description'], 'string'],
            [['unit_ID', 'productgrp_ID'], 'integer'],
            [['productname'], 'string', 'max' => 255],
            [['itemnumber'], 'string', 'max' => 50],
            [['GS1GTIN'], 'string', 'max' => 128],
        	[['itemnumber'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => Yii::t('sales', 'ID'),
            'productname' => Yii::t('sales', 'Product Name'),
            'description' => Yii::t('sales', 'Description'),
            'itemnumber' => Yii::t('sales', 'Item Number (automatic number, change only if necessary)'),
            'GS1GTIN' => Yii::t('sales', 'GS1/EAN Number'),
            'unit_ID' => Yii::t('sales', 'Unit  ID'),
            'productgrp_ID' => Yii::t('sales', 'Product Group'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductgrp()
    {
        return $this->hasOne(Productgrp::className(), ['ID' => 'productgrp_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnit()
    {
    	return $this->hasOne(Unit::className(), ['ID' => 'unit_ID']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSalesProductBundles()
    {
        return $this->hasMany(ProductBundle::className(), ['product_ID' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSalesProductRetailPrices()
    {
        return $this->hasMany(ProductRetailPrice::className(), ['product_ID' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSalesProductSuppliers()
    {
        return $this->hasMany(ProductSupplier::className(), ['product_ID' => 'ID']);
    }
    
    public function getUnitList()
    {
    	$models = Unit::find()->asArray()->all();
    	return ArrayHelper::map($models, 'ID', 'unit');
    }
    
    public function getProductgrpList()
    {
    	$models = Productgrp::find()->asArray()->all();
    	return ArrayHelper::map($models, 'ID', 'groupname');
    }
    
    
}
