<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Products;

/**
 * Products_Search represents the model behind the search form of `app\models\Products`.
 */
class Products_Search extends Products
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pr_id'], 'integer'],
            [['pr_name', 'pr_description', 'pr_image'], 'safe'],
            [['pr_price'], 'number'],
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
        $query = Products::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'pr_id' => $this->pr_id,
            'pr_price' => $this->pr_price,
        ]);

        $query->andFilterWhere(['like', 'pr_name', $this->pr_name])
            ->andFilterWhere(['like', 'pr_description', $this->pr_description])
            ->andFilterWhere(['like', 'pr_image', $this->pr_image]);

        return $dataProvider;
    }
}
