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
 * This is the model class for table "{{%sales_productgrp}}".
 *
 * @property integer $ID
 * @property string $groupname
 * @property double $margin
 *
 * @property SalesProduct[] $salesProducts
 * @author Christian Dumhart <christian.dumhart@chd.at>
 */
class Productgrp extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%sales_productgrp}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['groupname'], 'required'],
            [['margin'], 'number'],
            [['groupname'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => Yii::t('sales', 'ID'),
            'groupname' => Yii::t('sales', 'Groupname'),
            'margin' => Yii::t('sales', 'Profit Margin'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSalesProducts()
    {
        return $this->hasMany(SalesProduct::className(), ['productgrp_ID' => 'ID']);
    }
}
