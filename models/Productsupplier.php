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
use yii\helpers\ArrayHelper;
use chd7well\resource\models\Partner;
/**
 * This is the model class for table "{{%sales_product_supplier}}".
 *
 * @property integer $ID
 * @property integer $product_ID
 * @property integer $supplier_ID
 * @property string $ordernumber
 * @property string $comment
 *
 * @property SalesProductPurchasePrice[] $salesProductPurchasePrices
 * @property ResPartner $supplier
 * @property SalesProduct $product
 * @author Christian Dumhart <christian.dumhart@chd.at>
 */
class Productsupplier extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%sales_product_supplier}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_ID', 'supplier_ID'], 'required'],
            [['product_ID', 'supplier_ID'], 'integer'],
        	[['active'], 'boolean'],
            [['ordernumber'], 'string', 'max' => 50],
            [['comment'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => Yii::t('sales', 'ID'),
            'product_ID' => Yii::t('sales', 'Product  ID'),
            'supplier_ID' => Yii::t('sales', 'Supplier  ID'),
            'ordernumber' => Yii::t('sales', 'Ordernumber'),
        		'active' => Yii::t('sales', 'Active'),
            'comment' => Yii::t('sales', 'Comment'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSalesProductPurchasePrices()
    {
        return $this->hasMany(ProductPurchasePrice::className(), ['purchase_ID' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSupplier()
    {
        return $this->hasOne(Partner::className(), ['ID' => 'supplier_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['ID' => 'product_ID']);
    }
    
    public function getSupplierList()
    {
    
    	$models = Supplier::find()->where([
    			'is_supplier'=>true,
    			'active'=>true
    	])->asArray()->all();
    	return ArrayHelper::map($models, 'ID', 'partnername');
    }
    
}
