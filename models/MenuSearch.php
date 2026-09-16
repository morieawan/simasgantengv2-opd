<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Menu;

/**
 * MenuSearch represents the model behind the search form of `app\models\Menu`.
 */
class MenuSearch extends Menu
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'urutan', 'tipe', 'flag'], 'integer'],
            [['nama_menu', 'link', 'icon'], 'safe'],
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
        $query = Menu::find();

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
            'urutan' => $this->urutan,
        ]);

        if($this->tipe != 1){
            $query->andFilterWhere([
                'tipe' => $this->tipe,
            ]);
        }

        $query->andFilterWhere(['ilike', 'nama_menu', $this->nama_menu])
            ->andFilterWhere(['ilike', 'link', $this->link])
            ->andFilterWhere(['ilike', 'icon', $this->icon]);

        return $dataProvider;
    }
}
