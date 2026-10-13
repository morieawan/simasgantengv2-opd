<?php
namespace app\modules\bpjs\models;

use yii\base\Model;

class PesertaForm extends Model
{

    public $id;
    public $id_peserta;
    public $periode;
    public $pagu_rinc;
    public $pagu_total;
    public $persen_pot;
    public $jml_iuran;
    public $tgl_bayar;
    public $sumber_iuran;

    public function rules()
    {
        return [
            [['id', 'id_peserta', 'periode'], 'required'],
            [['periode', 'tgl_bayar'], 'safe'],
            [['pagu_rinc'], 'string'],
            [['pagu_total', 'jml_iuran', 'sumber_iuran'], 'integer'],
            [['persen_pot'], 'number'],
            [['id'], 'string', 'max' => 50],
            [['id_peserta'], 'string', 'max' => 25],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_peserta' => 'ID Peserta',
            'periode' => 'Periode',
            'pagu_rinc' => 'Pagu Rinc',
            'pagu_total' => 'Pagu Total',
            'persen_pot' => 'Persen Pot (%)',
            'jml_iuran' => 'Jumlah Iuran',
            'tgl_bayar' => 'Tanggal Bayar',
            'sumber_iuran' => 'Sumber Iuran',
        ];
    }
}