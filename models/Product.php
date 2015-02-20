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
            [['productname', 'itemnumber', 'GS1GTIN'], 'required'],
            [['description'], 'string'],
            [['unit_ID', 'productgrp_ID'], 'integer'],
            [['productname'], 'string', 'max' => 255],
            [['itemnumber'], 'string', 'max' => 50],
            [['GS1GTIN'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => Yii::t('sales', 'ID'),
            'productname' => Yii::t('sales', 'Productname'),
            'description' => Yii::t('sales', 'Description'),
            'itemnumber' => Yii::t('sales', 'Itemnumber'),
            'GS1GTIN' => Yii::t('sales', 'Gs1 Gtin'),
            'unit_ID' => Yii::t('sales', 'Unit  ID'),
            'productgrp_ID' => Yii::t('sales', 'Productgrp  ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductgrp()
    {
        return $this->hasOne(SalesProductgrp::className(), ['ID' => 'productgrp_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSalesProductBundles()
    {
        return $this->hasMany(SalesProductBundle::className(), ['product_ID' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSalesProductRetailPrices()
    {
        return $this->hasMany(SalesProductRetailPrice::className(), ['product_ID' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSalesProductSuppliers()
    {
        return $this->hasMany(SalesProductSupplier::className(), ['product_ID' => 'ID']);
    }
}
