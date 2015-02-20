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
 * This is the model class for table "{{%sales_bundle}}".
 *
 * @property integer $ID
 * @property string $bundle_name
 * @property integer $bundle_unit_ID
 * @property integer $item_unit_ID
 * @property double $item_count
 *
 * @property MasterUnit $itemUnit
 * @property MasterUnit $bundleUnit
 * @property SalesProductBundle[] $salesProductBundles
 * @author Christian Dumhart <christian.dumhart@chd.at>
 */
class Bundle extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%sales_bundle}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bundle_name', 'bundle_unit_ID', 'item_unit_ID'], 'required'],
            [['bundle_unit_ID', 'item_unit_ID'], 'integer'],
            [['item_count'], 'number'],
            [['bundle_name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => Yii::t('sales', 'ID'),
            'bundle_name' => Yii::t('sales', 'Bundle Name'),
            'bundle_unit_ID' => Yii::t('sales', 'Bundle Unit  ID'),
            'item_unit_ID' => Yii::t('sales', 'Item Unit  ID'),
            'item_count' => Yii::t('sales', 'Item Count'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemUnit()
    {
        return $this->hasOne(MasterUnit::className(), ['ID' => 'item_unit_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBundleUnit()
    {
        return $this->hasOne(MasterUnit::className(), ['ID' => 'bundle_unit_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSalesProductBundles()
    {
        return $this->hasMany(SalesProductBundle::className(), ['bundle_ID' => 'ID']);
    }
}
