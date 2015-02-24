<?php

namespace chd7well\sales\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use chd7well\sales\models\Product;

/**
 * ProductSearch represents the model behind the search form about `chd7well\sales\models\Product`.
 */
class ProductSearch extends Product
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'unit_ID', 'productgrp_ID'], 'integer'],
            [['productname', 'description', 'itemnumber', 'GS1GTIN', 'unit.unit', 'productgrp.groupname'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function attributes(){
    	return array_merge(parent::attributes(), ['unit.unit', 'productgrp.groupname']);
    }
    
    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Product::find();

        $query->joinWith(['unit']);
        $query->joinWith(['productgrp']);
        
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'ID' => $this->ID,
            'unit_ID' => $this->unit_ID,
            'productgrp_ID' => $this->productgrp_ID,
        ]);

        $query->andFilterWhere(['like', 'productname', $this->productname])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'itemnumber', $this->itemnumber])
            ->andFilterWhere(['like', 'GS1GTIN', $this->GS1GTIN])
        	->andFilterWhere(['like', 'unit', $this->getAttribute('unit.unit')])
        	->andFilterWhere(['like', 'sales_productgrp.groupname', $this->getAttribute('productgrp.groupname')]);

        $dataProvider->sort->attributes['unit.unit'] = [
        		'asc' => ['master_unit.unit' => SORT_ASC],
        		'desc' => ['master_unit.unit' => SORT_DESC],
        ];
        
        $dataProvider->sort->attributes['productgrp.groupname'] = [
        		'asc' => ['sales_productgrp.groupname' => SORT_ASC],
        		'desc' => ['sales_productgrp.groupname' => SORT_DESC],
        ];
        
        return $dataProvider;
    }
}
