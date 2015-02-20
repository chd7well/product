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
 * This is the model class for table "{{%sales_product_retail_price}}".
 *
 * @property integer $ID
 * @property integer $product_ID
 * @property string $fromedate
 * @property double $retailprice
 *
 * @property SalesProduct $product
 * @author Christian Dumhart <christian.dumhart@chd.at>
 */
class Productretailprice extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%sales_product_retail_price}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_ID'], 'required'],
            [['product_ID'], 'integer'],
            [['fromedate'], 'safe'],
            [['retailprice'], 'number']
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
            'fromedate' => Yii::t('sales', 'Fromedate'),
            'retailprice' => Yii::t('sales', 'Retailprice'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(SalesProduct::className(), ['ID' => 'product_ID']);
    }
}
