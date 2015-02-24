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
 * This is the model class for table "{{%sales_product_purchase_price}}".
 *
 * @property integer $ID
 * @property integer $purchase_ID
 * @property string $fromdate
 * @property double $suggested_retailprice
 * @property string $comment
 *
 * @property SalesProductSupplier $purchase
 * @author Christian Dumhart <christian.dumhart@chd.at>
 */
class Productpurchaseprice extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%sales_product_purchase_price}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['purchase_ID'], 'required'],
            [['purchase_ID'], 'integer'],
            [['fromdate'], 'safe'],
            [['suggested_retailprice', 'purchaseprice'], 'number'],
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
            'purchase_ID' => Yii::t('sales', 'Purchase  ID'),
            'fromdate' => Yii::t('sales', 'Fromdate'),
            'suggested_retailprice' => Yii::t('sales', 'Suggested Retailprice'),
        	'purchaseprice' => Yii::t('sales', 'Purchaseprice'),
            'comment' => Yii::t('sales', 'Comment'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchase()
    {
        return $this->hasOne(SalesProductSupplier::className(), ['ID' => 'purchase_ID']);
    }
}
