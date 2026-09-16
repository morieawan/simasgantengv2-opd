<?php

namespace app\modules\sitampan\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\sitampan\models\PreskinAsn;

/**
 * PreskinAsnSearch represents the model behind the search form of `app\modules\sitampan\models\PreskinAsn`.
 */
class PreskinAsnSearch extends PreskinAsn
{
    public $nama, $opd, $bidang, $unor, $bln, $thn;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nip', 'idpns', 'tmt_stop', 'updated', 'nama', 'opd', 'bidang', 'unor'], 'safe'],
            [['kode_kelas_jab', 'kode_jadwal', 'pres', 'kin', 'tpp', 'status', 'bln', 'thn'], 'integer'],
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
        $query = PreskinAsn::find();

        // add conditions that should always apply here
        $query->joinWith('asnFip a');

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
            'kode_kelas_jab' => $this->kode_kelas_jab,
            'kode_jadwal' => $this->kode_jadwal,
            'pres' => $this->pres,
            'kin' => $this->kin,
            'tpp' => $this->tpp,
            'tmt_stop' => $this->tmt_stop,
            'status' => $this->status,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['ilike', 'preskin_asn.nip', $this->nip])
            ->andFilterWhere(['ilike', 'idpns', $this->idpns])
            ->andFilterWhere(['ilike', 'a.B_03', $this->nama]);

        if($this->opd != ''){
            $pd = substr($this->opd,0,2);
            $bid = substr($this->opd,4,2);
            $un = substr($this->opd,6,2);

            if($pd != '00' && $bid == '00' && $un == '00') 
                $query->andFilterWhere(['a.A_01' => $pd]);
                
            elseif($pd != '00' && $bid != '00' && $un == '00') 
                $query->andFilterWhere(['a.A_01' => $pd, 'a.A_03' => $bid]);

            elseif($pd != '00' && $bid != '00' && $un != '00') 
                $query->andFilterWhere(['a.A_01' => $pd, 'a.A_03' => $bid, 'a.A_04' => $un]);  

        }

        return $dataProvider;
    }
}
