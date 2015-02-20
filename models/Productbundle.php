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
 * This is the model class for table "{{%sales_product_bundle}}".
 *
 * @property integer $ID
 * @property integer $bundle_ID
 * @property integer $product_ID
 *
 * @property SalesBundle $bundle
 * @property SalesProduct $product
 * @author Christian Dumhart <christian.dumhart@chd.at>
 */
class Productbundle extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%sales_product_bundle}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bundle_ID', 'product_ID'], 'required'],
            [['bundle_ID', 'product_ID'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => Yii::t('sales', 'ID'),
            'bundle_ID' => Yii::t('sales', 'Bundle  ID'),
            'product_ID' => Yii::t('sales', 'Product  ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBundle()
    {
        return $this->hasOne(SalesBundle::className(), ['ID' => 'bundle_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(SalesProduct::className(), ['ID' => 'product_ID']);
    }
}
