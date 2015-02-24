<?php

namespace chd7well\sales\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use chd7well\sales\models\Productsupplier;

/**
 * ProductsupplierSearch represents the model behind the search form about `chd7well\sales\models\Productsupplier`.
 */
class ProductsupplierSearch extends Productsupplier
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'product_ID', 'supplier_ID'], 'integer'],
            [['ordernumber', 'comment'], 'safe'],
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
        $query = Productsupplier::find();

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
            'product_ID' => $this->product_ID,
            'supplier_ID' => $this->supplier_ID,
        ]);

        $query->andFilterWhere(['like', 'ordernumber', $this->ordernumber])
            ->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
}
