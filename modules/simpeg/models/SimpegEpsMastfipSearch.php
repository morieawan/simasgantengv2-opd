<?php

namespace app\modules\simpeg\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\simpeg\models\SimpegEpsMastfip;

/**
 * EpsMastfipSearch represents the model behind the search form of `app\models\EpsMastfip`.
 */
class SimpegEpsMastfipSearch extends EpsMastfip
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['A_00', 'A_01', 'A_02', 'A_03', 'A_04', 'B_01', 'B_02', 'B_03A', 'B_03', 'B_03B', 'B_04', 'B_05', 'B_11', 'B_12', 'B_13', 'B_15', 'B_16', 'C_00', 'C_01', 'C_02', 'C_03', 'D_00', 'D_01', 'D_02', 'D_04', 'E_01', 'E_02', 'E_03', 'E_05', 'E_06', 'E_07', 'F_01', 'F_02', 'F_02A', 'F_04', 'F_05', 'F_06', 'G_01', 'G_02', 'G_03', 'G_04', 'G_05', 'G_05B', 'G_07', 'G_08', 'G_09', 'G_10', 'G_11', 'G_11A', 'H_02', 'I_02', 'J_01', 'J_02', 'J_03', 'J_04', 'J_05', 'J_06', 'J_07', 'J_08', 'K_01', 'K_02', 'K_03', 'K_04', 'K_07', 'M_01', 'M_02', 'M_03', 'M_05', 'M_06', 'M_07', 'no_telp', 'foto'], 'safe'],
            [['B_06', 'B_07', 'B_08', 'B_09', 'B_10', 'B_14', 'B_17', 'C_04', 'D_03', 'D_05', 'E_04', 'F_03', 'F_07', 'G_05A', 'G_06', 'H_01', 'H_03', 'I_01', 'I_03', 'K_05', 'K_06', 'L_01', 'L_02', 'M_04', 'Z_99'], 'integer'],
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
        $query = EpsMastfip::find();

        // add conditions that should always apply here
        $query->andFilterWhere([
            '<', 'B_08', 3
        ]);
        $query->orderBy([
            'A_01' => SORT_ASC,
            'A_03' => SORT_ASC,
            'A_04' => SORT_ASC
        ]);

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
            'B_02' => $this->B_02,
            'B_05' => $this->B_05,
            'B_06' => $this->B_06,
            'B_07' => $this->B_07,
            'B_08' => $this->B_08,
            'B_09' => $this->B_09,
            'B_10' => $this->B_10,
            'B_14' => $this->B_14,
            'B_17' => $this->B_17,
            'C_01' => $this->C_01,
            'C_03' => $this->C_03,
            'C_04' => $this->C_04,
            'D_02' => $this->D_02,
            'D_03' => $this->D_03,
            'D_04' => $this->D_04,
            'D_05' => $this->D_05,
            'E_03' => $this->E_03,
            'E_04' => $this->E_04,
            'E_05' => $this->E_05,
            'F_01' => $this->F_01,
            'F_03' => $this->F_03,
            'F_06' => $this->F_06,
            'F_07' => $this->F_07,
            'G_03' => $this->G_03,
            'G_04' => $this->G_04,
            'G_05A' => $this->G_05A,
            'G_06' => $this->G_06,
            'G_09' => $this->G_09,
            'G_10' => $this->G_10,
            'H_01' => $this->H_01,
            'H_03' => $this->H_03,
            'I_01' => $this->I_01,
            'I_02' => $this->I_02,
            'I_03' => $this->I_03,
            'J_03' => $this->J_03,
            'J_07' => $this->J_07,
            'K_03' => $this->K_03,
            'K_04' => $this->K_04,
            'K_05' => $this->K_05,
            'K_06' => $this->K_06,
            'L_01' => $this->L_01,
            'L_02' => $this->L_02,
            'M_03' => $this->M_03,
            'M_04' => $this->M_04,
            'M_05' => $this->M_05,
            'Z_99' => $this->Z_99,
        ]);

        $query->andFilterWhere(['ilike', 'A_00', $this->A_00])
            ->andFilterWhere(['ilike', 'A_01', $this->A_01])
            ->andFilterWhere(['ilike', 'A_02', $this->A_02])
            ->andFilterWhere(['ilike', 'A_03', $this->A_03])
            ->andFilterWhere(['ilike', 'A_04', $this->A_04])
            ->andFilterWhere(['ilike', 'B_01', $this->B_01])
            //->andFilterWhere(['ilike', 'B_02', $this->B_02])
            ->andFilterWhere(['ilike', 'B_03A', $this->B_03A])
            ->andFilterWhere(['ilike', 'B_03', $this->B_03])
            ->andFilterWhere(['ilike', 'B_03B', $this->B_03B])
            ->andFilterWhere(['ilike', 'B_04', $this->B_04])
            ->andFilterWhere(['ilike', 'B_11', $this->B_11])
            ->andFilterWhere(['ilike', 'B_12', $this->B_12])
            ->andFilterWhere(['ilike', 'B_13', $this->B_13])
            ->andFilterWhere(['ilike', 'B_15', $this->B_15])
            ->andFilterWhere(['ilike', 'B_16', $this->B_16])
            ->andFilterWhere(['ilike', 'C_00', $this->C_00])
            ->andFilterWhere(['ilike', 'C_02', $this->C_02])
            ->andFilterWhere(['ilike', 'D_00', $this->D_00])
            ->andFilterWhere(['ilike', 'D_01', $this->D_01])
            ->andFilterWhere(['ilike', 'E_01', $this->E_01])
            ->andFilterWhere(['ilike', 'E_02', $this->E_02])
            ->andFilterWhere(['ilike', 'E_06', $this->E_06])
            ->andFilterWhere(['ilike', 'E_07', $this->E_07])
            ->andFilterWhere(['ilike', 'F_02', $this->F_02])
            ->andFilterWhere(['ilike', 'F_02A', $this->F_02A])
            ->andFilterWhere(['ilike', 'F_04', $this->F_04])
            ->andFilterWhere(['ilike', 'F_05', $this->F_05])
            ->andFilterWhere(['ilike', 'G_01', $this->G_01])
            ->andFilterWhere(['ilike', 'G_02', $this->G_02])
            ->andFilterWhere(['ilike', 'G_05', $this->G_05])
            ->andFilterWhere(['ilike', 'G_05B', $this->G_05B])
            ->andFilterWhere(['ilike', 'G_07', $this->G_07])
            ->andFilterWhere(['ilike', 'G_08', $this->G_08])
            ->andFilterWhere(['ilike', 'G_11', $this->G_11])
            ->andFilterWhere(['ilike', 'G_11A', $this->G_11A])
            ->andFilterWhere(['ilike', 'H_02', $this->H_02])
            ->andFilterWhere(['ilike', 'J_01', $this->J_01])
            ->andFilterWhere(['ilike', 'J_02', $this->J_02])
            ->andFilterWhere(['ilike', 'J_04', $this->J_04])
            ->andFilterWhere(['ilike', 'J_05', $this->J_05])
            ->andFilterWhere(['ilike', 'J_06', $this->J_06])
            ->andFilterWhere(['ilike', 'J_08', $this->J_08])
            ->andFilterWhere(['ilike', 'K_01', $this->K_01])
            ->andFilterWhere(['ilike', 'K_02', $this->K_02])
            ->andFilterWhere(['ilike', 'K_07', $this->K_07])
            ->andFilterWhere(['ilike', 'M_01', $this->M_01])
            ->andFilterWhere(['ilike', 'M_02', $this->M_02])
            ->andFilterWhere(['ilike', 'M_06', $this->M_06])
            ->andFilterWhere(['ilike', 'M_07', $this->M_07])
            ->andFilterWhere(['ilike', 'no_telp', $this->no_telp])
            ->andFilterWhere(['ilike', 'foto', $this->foto]);

        return $dataProvider;
    }
}
