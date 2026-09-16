<?php

namespace app\modules\gaji\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\gaji\models\SimasGajiMstpegawai;

/**
 * SimasGajiMstpegawaiSearch represents the model behind the search form of `app\modules\gaji\models\SimasGajiMstpegawai`.
 */
class SimasGajiMstpegawaiSearch extends SimasGajiMstpegawai
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['NIP', 'NAMA', 'GLRDEPAN', 'GLRBELAKANG', 'TEMPATLHR', 'TGLLHR', 'PENDIDIKAN', 'TMTCAPEG', 'TMTSKMT', 'TMTSTOP', 'KDPANGKAT', 'TMTTABEL', 'TMTKGB', 'TMTKGBYAD', 'KDESELON', 'KDFUNGSI', 'KDGURU', 'KDTERPENCIL', 'KDTJKHUSUS', 'KDKORPRI', 'KDKOPERASI', 'KDIRDHATA', 'NODOSIR', 'KDCABTASPEN', 'KDSSBP', 'KDSKPD', 'KDSATKER', 'ALAMAT', 'KDDATI4', 'KDDATI3', 'KDDATI2', 'KDDATI1', 'NOTELP', 'NOKTP', 'NPWP', 'NPWPZ', 'NIPLAMA', 'KODEBYR', 'induk_bank', 'NOREK', 'TMTBERLAKU', 'CATATAN', 'UPDSTAMP', 'INPUTER', 'NOKARPEG', 'EMAIL', 'updated'], 'safe'],
            [['KDJENKEL', 'AGAMA', 'zakat_dg', 'KDSTAWIN', 'JISTRI', 'JANAK', 'KDSTAPEG', 'MKGOLT', 'BLGOLT', 'GAPOK', 'MASKER', 'TJESELON', 'KDFUNGSI1', 'TJFUNGSI', 'BUP', 'KDSTRUK', 'TJSTRUK', 'TJGURU', 'KDBERAS', 'KDLANGKA', 'TJLANGKA', 'KDTKD', 'TJTKD', 'TJTERPENCIL', 'TJKHUSUS', 'PKORPRI', 'PKOPERASI', 'PIRDHATA', 'TAPERUM', 'PSEWA', 'KDHITUNG', 'KDJNSTRANS', 'kd_infaq', 'jnsguru', 'KD_JNS_PEG'], 'integer'],
            [['PRSNGAPOK'], 'number'],
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
        $query = SimasGajiMstpegawai::find();

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
            'KDJENKEL' => $this->KDJENKEL,
            'TGLLHR' => $this->TGLLHR,
            'AGAMA' => $this->AGAMA,
            'zakat_dg' => $this->zakat_dg,
            'TMTCAPEG' => $this->TMTCAPEG,
            'TMTSKMT' => $this->TMTSKMT,
            'KDSTAWIN' => $this->KDSTAWIN,
            'JISTRI' => $this->JISTRI,
            'JANAK' => $this->JANAK,
            'KDSTAPEG' => $this->KDSTAPEG,
            'TMTSTOP' => $this->TMTSTOP,
            'MKGOLT' => $this->MKGOLT,
            'BLGOLT' => $this->BLGOLT,
            'GAPOK' => $this->GAPOK,
            'MASKER' => $this->MASKER,
            'PRSNGAPOK' => $this->PRSNGAPOK,
            'TMTTABEL' => $this->TMTTABEL,
            'TMTKGB' => $this->TMTKGB,
            'TMTKGBYAD' => $this->TMTKGBYAD,
            'TJESELON' => $this->TJESELON,
            'KDFUNGSI1' => $this->KDFUNGSI1,
            'TJFUNGSI' => $this->TJFUNGSI,
            'BUP' => $this->BUP,
            'KDSTRUK' => $this->KDSTRUK,
            'TJSTRUK' => $this->TJSTRUK,
            'TJGURU' => $this->TJGURU,
            'KDBERAS' => $this->KDBERAS,
            'KDLANGKA' => $this->KDLANGKA,
            'TJLANGKA' => $this->TJLANGKA,
            'KDTKD' => $this->KDTKD,
            'TJTKD' => $this->TJTKD,
            'TJTERPENCIL' => $this->TJTERPENCIL,
            'TJKHUSUS' => $this->TJKHUSUS,
            'PKORPRI' => $this->PKORPRI,
            'PKOPERASI' => $this->PKOPERASI,
            'PIRDHATA' => $this->PIRDHATA,
            'TAPERUM' => $this->TAPERUM,
            'PSEWA' => $this->PSEWA,
            'KDHITUNG' => $this->KDHITUNG,
            'TMTBERLAKU' => $this->TMTBERLAKU,
            'KDJNSTRANS' => $this->KDJNSTRANS,
            'UPDSTAMP' => $this->UPDSTAMP,
            'kd_infaq' => $this->kd_infaq,
            'jnsguru' => $this->jnsguru,
            'KD_JNS_PEG' => $this->KD_JNS_PEG,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['ilike', 'NIP', $this->NIP])
            ->andFilterWhere(['ilike', 'NAMA', $this->NAMA])
            ->andFilterWhere(['ilike', 'GLRDEPAN', $this->GLRDEPAN])
            ->andFilterWhere(['ilike', 'GLRBELAKANG', $this->GLRBELAKANG])
            ->andFilterWhere(['ilike', 'TEMPATLHR', $this->TEMPATLHR])
            ->andFilterWhere(['ilike', 'PENDIDIKAN', $this->PENDIDIKAN])
            ->andFilterWhere(['ilike', 'KDPANGKAT', $this->KDPANGKAT])
            ->andFilterWhere(['ilike', 'KDESELON', $this->KDESELON])
            ->andFilterWhere(['ilike', 'KDFUNGSI', $this->KDFUNGSI])
            ->andFilterWhere(['ilike', 'KDGURU', $this->KDGURU])
            ->andFilterWhere(['ilike', 'KDTERPENCIL', $this->KDTERPENCIL])
            ->andFilterWhere(['ilike', 'KDTJKHUSUS', $this->KDTJKHUSUS])
            ->andFilterWhere(['ilike', 'KDKORPRI', $this->KDKORPRI])
            ->andFilterWhere(['ilike', 'KDKOPERASI', $this->KDKOPERASI])
            ->andFilterWhere(['ilike', 'KDIRDHATA', $this->KDIRDHATA])
            ->andFilterWhere(['ilike', 'NODOSIR', $this->NODOSIR])
            ->andFilterWhere(['ilike', 'KDCABTASPEN', $this->KDCABTASPEN])
            ->andFilterWhere(['ilike', 'KDSSBP', $this->KDSSBP])
            ->andFilterWhere(['ilike', 'KDSKPD', $this->KDSKPD])
            ->andFilterWhere(['ilike', 'KDSATKER', $this->KDSATKER])
            ->andFilterWhere(['ilike', 'ALAMAT', $this->ALAMAT])
            ->andFilterWhere(['ilike', 'KDDATI4', $this->KDDATI4])
            ->andFilterWhere(['ilike', 'KDDATI3', $this->KDDATI3])
            ->andFilterWhere(['ilike', 'KDDATI2', $this->KDDATI2])
            ->andFilterWhere(['ilike', 'KDDATI1', $this->KDDATI1])
            ->andFilterWhere(['ilike', 'NOTELP', $this->NOTELP])
            ->andFilterWhere(['ilike', 'NOKTP', $this->NOKTP])
            ->andFilterWhere(['ilike', 'NPWP', $this->NPWP])
            ->andFilterWhere(['ilike', 'NPWPZ', $this->NPWPZ])
            ->andFilterWhere(['ilike', 'NIPLAMA', $this->NIPLAMA])
            ->andFilterWhere(['ilike', 'KODEBYR', $this->KODEBYR])
            ->andFilterWhere(['ilike', 'induk_bank', $this->induk_bank])
            ->andFilterWhere(['ilike', 'NOREK', $this->NOREK])
            ->andFilterWhere(['ilike', 'CATATAN', $this->CATATAN])
            ->andFilterWhere(['ilike', 'INPUTER', $this->INPUTER])
            ->andFilterWhere(['ilike', 'NOKARPEG', $this->NOKARPEG])
            ->andFilterWhere(['ilike', 'EMAIL', $this->EMAIL]);

        return $dataProvider;
    }
}
