<?php

namespace chd7well\sales\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use chd7well\sales\models\Productpurchaseprice;

/**
 * ProductpurchasepriceSearch represents the model behind the search form about `chd7well\sales\models\Productpurchaseprice`.
 */
class ProductpurchasepriceSearch extends Productpurchaseprice
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'purchase_ID'], 'integer'],
            [['fromdate', 'comment'], 'safe'],
            [['suggested_retailprice'], 'number'],
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
        $query = Productpurchaseprice::find();

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
            'purchase_ID' => $this->purchase_ID,
            'fromdate' => $this->fromdate,
            'suggested_retailprice' => $this->suggested_retailprice,
        ]);

        $query->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
}
