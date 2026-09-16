<?php

namespace app\modules\integrasi\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\integrasi\models\TblDataUpdate;

/**
 * TblDataUpdateSearch represents the model behind the search form of `app\modules\integrasi\models\TblDataUpdate`.
 */
class TblDataUpdateSearch extends TblDataUpdate
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
           // [['id', 'nipBaru', 'dataUtama', 'rwJabatan', 'rwGol', 'rwDiklat', 'rwPendidikan', 'rwSkp', 'rwAngkakredit', 'rwPwk', 'rwPnsunor', 'rwKursus', 'rwPemberhentian', 'rwPenghargaan', 'rwMasakerja', 'rwHukdis', 'rwDp3', 'rwCltn', 'rwPindahinstansi', 'rwskp22'], 'safe'],
           [['id', 'nipBaru'], 'safe'],
           [['flag'], 'integer'],
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
        $query = TblDataUpdate::find();

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
        // $query->andFilterWhere([
        //     'dataUtama' => $this->dataUtama,
        //     'rwJabatan' => $this->rwJabatan,
        //     'rwGol' => $this->rwGol,
        //     'rwDiklat' => $this->rwDiklat,
        //     'rwPendidikan' => $this->rwPendidikan,
        //     'rwSkp' => $this->rwSkp,
        //     'rwAngkakredit' => $this->rwAngkakredit,
        //     'rwPwk' => $this->rwPwk,
        //     'rwPnsunor' => $this->rwPnsunor,
        //     'rwKursus' => $this->rwKursus,
        //     'rwPemberhentian' => $this->rwPemberhentian,
        //     'rwPenghargaan' => $this->rwPenghargaan,
        //     'rwMasakerja' => $this->rwMasakerja,
        //     'rwHukdis' => $this->rwHukdis,
        //     'rwDp3' => $this->rwDp3,
        //     'rwCltn' => $this->rwCltn,
        //     'rwPindahinstansi' => $this->rwPindahinstansi,
        //     'rwskp22' => $this->rwskp22,
        //     'flag' => $this->flag,
        // ]);

        $query->andFilterWhere(['ilike', 'id', $this->id])
            ->andFilterWhere(['ilike', 'nipBaru', $this->nipBaru]);

        return $dataProvider;
    }
}
