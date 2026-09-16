<?php

namespace app\modules\sitampan\models;

use Yii;
use yii\base\Model;
use yii\data\ArrayDataProvider;
use yii\db\Expression;
use app\modules\sitampan\models\PreskinAsn;
use app\modules\sitampan\models\PreskinWfh;
use app\modules\simpeg\models\EpsMastfip;
use app\modules\simpeg\models\EpsTablokb;

class PreskinWfhSearch extends Model
{
    public $nip;
    public $nama;
    public $unit;     // tablok
    public $periode;  // mm-yyyy

    public function rules()
    {
        return [
            [['nip', 'nama', 'unit', 'periode'], 'safe'],
        ];
    }

    public function search($params)
    {
        $this->load($params);

        $sess = Yii::$app->session;

        // =========================
        // GET OPD (GROUP USER)
        // =========================
        $opd = EpsTablokb::find()
            ->select(['KOLOK', 'NALOK'])
            ->where(['GROUP_USER' => $sess['group_user']])
            ->asArray()
            ->all();

        $so = array_column($opd, 'KOLOK');

        // =========================
        // PARSE PERIODE
        // =========================
        $start = null;
        $end = null;

        if (!empty($this->periode)) {
            [$bln, $thn] = explode('-', $this->periode);
            $start = "$thn-$bln-01";
            $end = date("Y-m-t", strtotime($start));
        }

        // =========================
        // QUERY A (ASN)
        // =========================
        $a = PreskinAsn::find()
            ->select(['nip'])
            ->andWhere(['<', 'status', 13])
            ->andFilterWhere(['nip' => $this->nip])
            ->asArray()
            ->all();

        $idsA = array_column($a, 'nip');

        if (empty($idsA)) {
            return new ArrayDataProvider(['allModels' => []]);
        }

        // =========================
        // QUERY B (NAMA + TABLOK)
        // =========================
        $bQuery = EpsMastfip::find()
            ->select([
                '"B_02" AS nip',
                '"B_03" AS nama',
                new Expression('CONCAT("A_01","A_02","A_03","A_04") AS tablok'),
                '"G_05A" AS j_jabatan',
                '"G_05B" AS jabatan',
            ])
            ->where(['B_02' => $idsA]);

        if (!empty($this->nama)) {
            $bQuery->andFilterWhere(['ilike', 'B_03', $this->nama]);
        }

        if (!empty($this->unit)) {
            $bQuery->andWhere(new Expression(
                'CONCAT("A_01","A_02","A_03","A_04") = :unit',
                [':unit' => $this->unit]
            ));
        } else {
            // default filter group_user
            $bQuery->andWhere(['in',
                new Expression('CONCAT("A_01","A_02","A_03","A_04")'),
                $so
            ]);
        }

        $b = $bQuery->asArray()->all();
        $idsB = array_column($b, 'nip');

        if (empty($idsB)) {
            return new ArrayDataProvider(['allModels' => []]);
        }

        // =========================
        // FINAL IDS
        // =========================
        $finalIds = array_intersect($idsA, $idsB);

        // =========================
        // QUERY WFH (OPTIONAL)
        // =========================
        $t = [];

        if (!empty($this->periode)) {
            $t = PreskinWfh::find()
                ->select(['nip', 'tgl'])
                ->where(['nip' => $finalIds])
                ->andWhere(['between', 'tgl', $start, $end])
                ->asArray()
                ->all();
        }

        $tMap = $this->groupAllTgl($t);

        // =========================
        // MAP DATA
        // =========================
        $bMap = $this->indexBy($b, 'nip');

        $tablokList = array_unique(array_column($b, 'tablok'));

        $c = EpsTablokb::find()
            ->select(['KOLOK AS tablok', 'NALOK'])
            ->where(['KOLOK' => $tablokList])
            ->asArray()
            ->all();

        $cMap = $this->indexBy($c, 'tablok');

        // =========================
        // JOIN FINAL
        // =========================
        $result = [];

        foreach ($finalIds as $nip) {

            $tablok = $bMap[$nip]['tablok'] ?? null;

            $j_jab = $bMap[$nip]['j_jabatan'] ?? '';
            if($j_jab == 0) $j_jab = 4;

            $result[] = [
                'nip'    => $nip,
                'nama'   => $bMap[$nip]['nama'] ?? '',
                'tablok' => $tablok,
                'nalok'  => $cMap[$tablok]['NALOK'] ?? '',
                'j_jab'   => $j_jab,
                'jab'   => $bMap[$nip]['jabatan'] ?? '',
                'tgl_list' => !empty($this->periode) ? ($tMap[$nip] ?? '') : null,
                // 'tgl1'   => !empty($this->periode) ? ($tMap[$nip]['tgl1'] ?? 0) : null,
                // 'tgl2'   => !empty($this->periode) ? ($tMap[$nip]['tgl2'] ?? 0) : null,
            ];
        }

        usort($result, function ($a, $b) {
            // 1. sort nama ASC
            $cmp = strcmp($a['nama'], $b['nama']);
            if ($cmp !== 0) return $cmp;

            // 2. kalau nama sama → sort nip ASC
            return strcmp($a['nip'], $b['nip']);
        });

        return new ArrayDataProvider([
            'allModels' => $result,
            'pagination' => ['pageSize' => 20],
            'sort' => [
                'attributes' => ['j_jab', 'tablok', 'nip', 'nama', 'nalok', 'tgl_list'],
                'defaultOrder' => [
                    'j_jab' => SORT_ASC,
                    'tablok' => SORT_ASC,
                    'nip' => SORT_ASC,
                ],
            ],
        ]);
    }

    // =========================
    // HELPERS
    // =========================

    private function indexBy($rows, $key)
    {
        $map = [];
        foreach ($rows as $row) {
            $map[$row[$key]] = $row;
        }
        return $map;
    }

    private function groupAllTgl($rows)
    {
        $result = [];

        foreach ($rows as $r) {
            $nip = $r['nip'];
            $tgl = date('Y-m-d', strtotime($r['tgl'])); // ambil hari

            if (!isset($result[$nip])) {
                $result[$nip] = [];
            }

            $result[$nip][] = $tgl;
        }

        // ubah jadi string
        foreach ($result as $nip => $days) {
            sort($days);
            $result[$nip] = implode(',', $days);
        }

        return $result;
    }
}