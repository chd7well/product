<?php

namespace chd7well\sales\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use chd7well\sales\models\Bundle;

/**
 * BundleSearch represents the model behind the search form about `chd7well\sales\models\Bundle`.
 */
class BundleSearch extends Bundle
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'bundle_unit_ID', 'item_unit_ID'], 'integer'],
            [['bundle_name', 'itemUnit.unit', 'bundleUnit.unit'], 'safe'],
            [['item_count'], 'number'],
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
    	return array_merge(parent::attributes(), ['itemUnit.unit', 'bundleUnit.unit']);
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
        $query = Bundle::find();
       // $query->joinWith(['bundleUnit']);
        $query->joinWith(['itemUnit']);
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
            'bundle_unit_ID' => $this->bundle_unit_ID,
            'item_unit_ID' => $this->item_unit_ID,
            'item_count' => $this->item_count,
        ]);

        $query->andFilterWhere(['like', 'bundle_name', $this->bundle_name])
        ->andFilterWhere(['like', 'bundleUnit.unit', $this->getAttribute('bundleUnit.unit')])
        ->andFilterWhere(['like', 'itemUnit.unit', $this->getAttribute('itemUnit.unit')]);

        $dataProvider->sort->attributes['bundleUnit.unit'] = [
        		'asc' => ['master_unit.unit' => SORT_ASC],
        		'desc' => ['master_unit.unit' => SORT_DESC],
        ];
        
        $dataProvider->sort->attributes['itemUnit.unit'] = [
        		'asc' => ['master_unit.unit' => SORT_ASC],
        		'desc' => ['master_unit.unit' => SORT_DESC],
        ];
        
        return $dataProvider;
    }
}
