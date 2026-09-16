<?php

namespace app\modules\sitampan\models;

use yii\base\Model;
use yii\data\ArrayDataProvider;
use yii\data\Pagination;
use Yii;

use app\modules\sitampan\models\PreskinAsn;
use app\modules\simpeg\models\EpsMastfip;
use app\modules\simpeg\models\EpsTablokb;
use app\modules\sitampan\models\PreskinWfh;

class PreskinWfhSearch extends Model
{
    public $nip;
    public $nama;
    public $unit;
    public $periode;

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
        // 1. AMBIL OPD SESUAI USER
        // =========================
        $opd = EpsTablokb::find()
            ->select(['KOLOK'])
            ->where(['GROUP_USER' => $sess['group_user']])
            ->asArray()
            ->all();

        $so = array_column($opd, 'KOLOK');

        // =========================
        // 2. BASE QUERY ASN
        // =========================
        $query = PreskinAsn::find()
            ->select(['nip'])
            ->andWhere(['<', 'status', 13]);

        if (!empty($this->nip)) {
            $query->andWhere(['nip' => $this->nip]);
        }

        // =========================
        // 3. PAGINATION (HYBRID)
        // =========================

        $pageSize = 20;
        $buffer = 10; // ambil 10x lebih banyak

        $limit = $pageSize * $buffer;

        $nips = $query
            ->limit($limit)
            ->column();

        // =========================
        // 4. TABLE B (NAMA + TABLOK)
        // =========================
        $b = EpsMastfip::find()
            ->select([
                '"B_02" AS nip',
                '"B_03" AS nama',
                new \yii\db\Expression('CONCAT("A_01","A_02","A_03","A_04") AS tablok')
            ])
            ->where(['B_02' => $nips])
            ->andFilterWhere(['ilike', 'B_03', $this->nama])
            ->asArray()
            ->all();

        $bMap = [];
        $tablokList = [];

        foreach ($b as $row) {
            $bMap[$row['nip']] = $row;
            $tablokList[] = $row['tablok'];
        }

        // =========================
        // 5. TABLE C (FILTER GROUP_USER)
        // =========================
        $c = EpsTablokb::find()
            ->select(['KOLOK AS tablok', 'NALOK'])
            ->where(['KOLOK' => $tablokList])
            ->andWhere(['KOLOK' => $so]) // 🔥 filter user
            ->asArray()
            ->all();

        $cMap = [];
        foreach ($c as $row) {
            $cMap[$row['tablok']] = $row['NALOK'];
        }

        // =========================
        // 6. FILTER UNIT (OPSIONAL)
        // =========================
        if (!empty($this->unit)) {
            $bMap = array_filter($bMap, function ($row) {
                return $row['tablok'] == $this->unit;
            });
        }

        // =========================
        // 7. WFH (PERIODE)
        // =========================
        $wfhMap = [];

        if (!empty($this->periode)) {

            list($bln, $thn) = explode('-', $this->periode);

            $start = "$thn-$bln-01";
            $end = date("Y-m-t", strtotime($start));

            $wfh = PreskinWfh::find()
                ->select(['nip', 'tgl'])
                ->where(['nip' => $nips])
                ->andWhere(['between', 'tgl', $start, $end])
                ->asArray()
                ->all();

            foreach ($wfh as $row) {
                $wfhMap[$row['nip']][] = $row['tgl'];
            }
        }

        // =========================
        // 8. BUILD RESULT
        // =========================
        $result = [];

        foreach ($nips as $nip) {

            if (!isset($bMap[$nip])) continue;

            $bRow = $bMap[$nip];
            $tablok = $bRow['tablok'] ?? '';

            // 🔥 VALIDASI AKSES OPD
            if (!isset($cMap[$tablok])) continue;

            $result[] = [
                'nip' => $nip,
                'nama' => $bRow['nama'] ?? '',
                'unit' => $cMap[$tablok] ?? '',
                'tgl_list' => isset($wfhMap[$nip]) ? implode(',', $wfhMap[$nip]) : '',
            ];
        }

        // total hasil setelah filter
        $total = count($result);

        // pagination manual
        $pages = new Pagination([
            'totalCount' => $total,
            'pageSize' => $pageSize,
        ]);

        $result = array_slice($result, $pages->offset, $pages->limit);

        // =========================
        // 9. SORT
        // =========================
        usort($result, function ($a, $b) {
            return [$a['nama'], $a['nip']] <=> [$b['nama'], $b['nip']];
        });

        // =========================
        // 10. DATAPROVIDER
        // =========================
        return new ArrayDataProvider([
            'allModels' => $result,
            'pagination' => $pages,
            'sort' => [
                'attributes' => ['nip', 'nama', 'unit'],
                'defaultOrder' => [
                    'nama' => SORT_ASC,
                    'nip' => SORT_ASC,
                ],
            ],
        ]);
    }
}