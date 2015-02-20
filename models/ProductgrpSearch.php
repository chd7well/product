<?php

namespace chd7well\sales\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use chd7well\sales\models\Productgrp;

/**
 * ProductgrpSearch represents the model behind the search form about `vendor\chd7well\sales\models\Productgrp`.
 */
class ProductgrpSearch extends Productgrp
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID'], 'integer'],
            [['groupname'], 'safe'],
            [['margin'], 'number'],
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

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Productgrp::find();

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
            'margin' => $this->margin,
        ]);

        $query->andFilterWhere(['like', 'groupname', $this->groupname]);

        return $dataProvider;
    }
}
