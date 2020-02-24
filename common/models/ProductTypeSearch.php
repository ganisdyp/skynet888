<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ProductType;

/**
 * ProductTypeSearch represents the model behind the search form of `common\models\ProductType`.
 */
class ProductTypeSearch extends ProductType
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['main_photo'], 'safe'],
            //      [['name','description'], 'string'],
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
        $query = ProductType::find();

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
            'id' => $this->id,
            //'name' => $this->product_type_lang->name,
            //    'description' => $this->product_type_lang->description,
        ]);

        //    $query->andFilterWhere(['like', 'name', $this->product_type_lang->name]);
        //   $query->andFilterWhere(['like', 'description', $this->productTypeLang->description]);
        $query->andFilterWhere(['like', 'main_photo', $this->main_photo]);

        return $dataProvider;
    }
}
