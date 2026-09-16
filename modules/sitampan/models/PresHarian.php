<?php

namespace app\modules\sitampan\models;

use Yii;

/**
 * This is the model class for table "pres_harian".
 *
 * @property string $kode
 * @property string $tgl
 * @property string $idpns
 * @property string $nip
 * @property string $nama
 * @property string $tablokb
 * @property string $jd_masuk
 * @property string $jd_pulang
 * @property string|null $pr_masuk
 * @property string|null $pr_pulang
 * @property int|null $mnt_masuk
 * @property int|null $mnt_pulang
 * @property string|null $kd_pr_masuk
 * @property string|null $kd_pr_pulang
 * @property float|null $persen_masuk persen TL dibandingkan dengan tengah2
 * @property float|null $persen_pulang persen PSW dibandingkan dengan tengah2
 * @property float|null $pot_masuk pot_tpp
 * @property float|null $pot_pulang pot_tpp
 * @property int $flag
 * @property string $updated
 */
class PresHarian extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pres_harian';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db2');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode', 'nip', 'nama', 'tablokb', 'jd_masuk', 'jd_pulang'], 'required'],
            [['tgl', 'jd_masuk', 'jd_pulang', 'pr_masuk', 'pr_pulang', 'updated'], 'safe'],
            [['mnt_masuk', 'mnt_pulang', 'flag'], 'default', 'value' => null],
            [['mnt_masuk', 'mnt_pulang', 'flag'], 'integer'],
            [['persen_masuk', 'persen_pulang', 'pot_masuk', 'pot_pulang'], 'number'],
            [['kode'], 'string', 'max' => 50],
            [['idpns'], 'string', 'max' => 128],
            [['nip'], 'string', 'max' => 22],
            [['nama'], 'string', 'max' => 100],
            [['tablokb', 'kd_pr_masuk', 'kd_pr_pulang'], 'string', 'max' => 10],
            [['kode'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'kode' => 'Kode',
            'tgl' => 'Tgl',
            'idpns' => 'Idpns',
            'nip' => 'Nip',
            'nama' => 'Nama',
            'tablokb' => 'Tablokb',
            'jd_masuk' => 'Jd Masuk',
            'jd_pulang' => 'Jd Pulang',
            'pr_masuk' => 'Pr Masuk',
            'pr_pulang' => 'Pr Pulang',
            'mnt_masuk' => 'Mnt Masuk',
            'mnt_pulang' => 'Mnt Pulang',
            'kd_pr_masuk' => 'Kd Pr Masuk',
            'kd_pr_pulang' => 'Kd Pr Pulang',
            'persen_masuk' => 'Persen Masuk',
            'persen_pulang' => 'Persen Pulang',
            'pot_masuk' => 'Pot Masuk',
            'pot_pulang' => 'Pot Pulang',
            'flag' => 'Flag',
            'updated' => 'Updated',
        ];
    }

    public static function getCountPres($nip, $tahun, $bulan){
        $pres = PresHarian::find()->select(['nip', 'tgl'])
        ->where([
            'nip' => $nip,
            'EXTRACT(YEAR FROM tgl::date)' => $tahun,
            'EXTRACT(MONTH FROM tgl::date)' => $bulan,
        ])->count();

        return $pres;
    }
}
