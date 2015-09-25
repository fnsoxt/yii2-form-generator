<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Field;

/**
 * FieldSearch represents the model behind the search form about `common\models\Field`.
 */
class FieldSearch extends Field
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'form_id', 'order', 'required', 'create_at'], 'integer'],
            [['name', 'desc', 'type', 'default', 'options'], 'safe'],
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
        $query = Field::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'form_id' => $this->form_id,
            'order' => $this->order,
            'required' => $this->required,
            'create_at' => $this->create_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'desc', $this->desc])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'default', $this->default])
            ->andFilterWhere(['like', 'options', $this->options]);

        return $dataProvider;
    }
}
