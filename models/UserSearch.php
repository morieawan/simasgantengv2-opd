<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\User;

/**
 * UserSearch represents the model behind the search form of `app\models\User`.
 */
class UserSearch extends User
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status'], 'integer'],
            [['username', 'auth_key', 'password_hash', 'pengguna', 'created', 'modified', 'role', 'tablok', 'namapengguna', 'namaopd', 'nipBaru', 'tcari'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = User::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        //$dataProvider->query->joinWith('userVpegawai a');

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            //'role' => $this->role,
            'pengguna' => $this->pengguna,
            'tablok' => $this->tablok,
            'created' => $this->created,
            'modified' => $this->modified,
        ]);

        $query->andFilterWhere(['ilike', 'username', $this->username])
            ->andFilterWhere(['ilike', 'auth_key', $this->auth_key])
            ->andFilterWhere(['ilike', 'password_hash', $this->password_hash])
            ->andFilterWhere(['ilike', 'role', $this->role])
            ->andFilterWhere(['ilike', 'nipBaru', $this->nipBaru])
            ->andFilterWhere(['ilike', 'namapengguna', $this->namapengguna])
            ->andFilterWhere(['ilike', 'namaopd', $this->namaopd]);

        return $dataProvider;
    }
}
