<?php

namespace app\modules\sitampan\controllers;

use app\modules\sitampan\models\PreskinCoretaxAkhir;
use app\modules\sitampan\models\PreskinCoretaxAkhirSearch;
use app\modules\gaji\models\SimasGajiSkpdTbl;
use app\modules\gaji\models\SimasGajiMstpegawai;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Cell\DataType;

use Yii;
use yii\web\Response;
use yii\helpers\Json;
use kartik\mpdf\Pdf;

/**
 * PreskinCoretaxAkhirController implements the CRUD actions for PreskinCoretaxAkhir model.
 */
class PreskinCoretaxAkhirController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all PreskinCoretaxAkhir models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PreskinCoretaxAkhirSearch(['jenis' => 3]);
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->query->orderBy(['tahun_pajak' => SORT_DESC, 'tablok' => SORT_ASC, 'nip' => SORT_ASC]);

        $skpd = SimasGajiSkpdTbl::find()
            ->select(['KDSKPD', 'NMSKPD', 'CONCAT("KDSKPD", \' - \', "NMSKPD") AS tablok'])
            ->orderBy('KDSKPD')
            ->asArray()
            ->all();
            
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'skpd' => $skpd,
        ]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionSearch()
    {
        $sess = Yii::$app->session;
        $nip = $sess['nip'];
        $opdgj = SimasGajiMstpegawai::find()
            ->select(['KDSKPD'])
            ->where(['NIP' => $nip])
            ->one();

        if($opdgj['KDSKPD'] == '045'){
            $opdgj['KDSKPD'] = ['045', '014', '069', '098'];
        }  
        
        if($opdgj['KDSKPD'] == '070'){
            $opdgj['KDSKPD'] = [
                '070', '064', '047', '048', '049', '050', '051', '052', '053', '054',
                '055', '056', '057', '058', '059', '060', '061', '062', '063'
            ];
        }  

        $skpd = SimasGajiSkpdTbl::find()
            ->select(['KDSKPD', 'NMSKPD', 'CONCAT("KDSKPD", \' - \', "NMSKPD") AS tablok'])
            ->where(['KDSKPD' => $opdgj['KDSKPD']])
            ->orderBy('KDSKPD')
            ->asArray()
            ->all();
            
        $searchModel = new PreskinCoretaxAkhirSearch();

        return $this->render('_search', [
            'model' => $searchModel,
            'skpd' => $skpd,
        ]);
    }
    /**
     * Finds the PreskinCoretaxAkhir model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $tahun_pajak Tahun Pajak
     * @param string $nip Nip
     * @param int $jenis Jenis
     * @return PreskinCoretaxAkhir the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($tahun_pajak, $nip, $jenis)
    {
        if (($model = PreskinCoretaxAkhir::findOne(['tahun_pajak' => $tahun_pajak, 'nip' => $nip, 'jenis' => $jenis])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionExportExcel($tahun, $opd)
    {
        $skpd = SimasGajiSkpdTbl::find()
            ->select(['KDSKPD', 'NMSKPD'])
            ->where(['KDSKPD' => $opd])
            ->asArray()
            ->one();

        if($skpd === null){
            $nama_skpd = "";
            $data = PreskinCoretaxAkhir::find()
            ->where(['tahun_pajak' => $tahun, 'jenis' => 3]);
        } else  {
            $nama_skpd = $skpd['NMSKPD'];    
            $data = PreskinCoretaxAkhir::find()
            ->where(['tahun_pajak' => $tahun, 'tablok' => $opd, 'jenis' => 3]);
        }

        $data = $data->select(['pemberi_kerja', 'masa_awal', 'masa_akhir', 'tahun_pajak', 'npwp', 'nip', 'status', 'posisi', 'pangkat_gol', 'kd_obj_pajak', 'bupot', 'jml_bln', 'gaji', 'tunj_istri', 'tunj_anak', 'tpp', 'tunj_jabatan', 'tunj_beras', 'tunj_khusus', 'tunj_lain', 'iuran_pensiun', 'zakat', 'no_bupot_sebelumnya', 'pph_terbayar', 'id_tku', 'tgl_potong', 'nama', 'tablok', 'satker', 'bruto_total', 'pot_bea_jabatan', 'pot_iuran_pensiun', 'ptkp', 'pkp_total', 'pph_total', 'pph_gaji_akhir_masa', 'pph_ter AS pph_tot_terbayar', 'pph_terhutang', 'pph_diajukan'])
        ->asArray()
        ->orderBy(['pph_diajukan' => SORT_DESC, 'nip' => SORT_ASC])
        ->all();

        $templatePath = Yii::getAlias('@webroot/unggahan/template_coretax_akhir.xlsx');
        $spreadsheet = IOFactory::load($templatePath);
        $sheet = $spreadsheet->getActiveSheet('DATA');

        $id_tku = '';
        $startRow = 4;
        foreach ($data as $i => $row) {
            $col = 'B';            
            foreach ($row as $key => $value) {

                if($col == 'Z') {
                    $id_tku = $value;
                    $value = $value ? $value."000000" : "";
                }

                if($col == 'AB') $col = 'AC';

                $sheet->setCellValue($col . ($startRow + $i), $value);

                // if($key == 'nik' || $key == 'nip') $value = "'$value"; 

                if($col == 'F' || $col == 'G' || $col == 'Z'){
                    $value = (string)($value); 
                    $sheet->getStyle($col)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_TEXT);
                    $sheet->setCellValueExplicit($col.($startRow + $i), "$value", DataType::TYPE_STRING);
                }

                $col++;
            }
        }
        
        $sheet->setCellValue('C1', $id_tku);

        // (4) Output ke browser
        $filename = "coretax akhir $tahun $opd-$nama_skpd.xlsx";
        $response = Yii::$app->response;
        $response->format = Response::FORMAT_RAW;
        $headers = $response->headers;
        $headers->set('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $headers->set('Content-Disposition', 'attachment;filename="' . $filename . '"');
        $headers->set('Cache-Control', 'max-age=0');

        $writer = new Xlsx($spreadsheet);
        ob_start();
        $writer->save('php://output');
        return ob_get_clean();
    }

    public function actionCetak($tahun, $name)
    {
        $opd = $name;
        $skpd = SimasGajiSkpdTbl::find()
            ->select(['KDSKPD', 'NMSKPD'])
            ->where(['KDSKPD' => $opd])
            ->asArray()
            ->one();

        $nama_skpd = $skpd['NMSKPD'];   
           
        $data = PreskinCoretaxAkhir::find()
        ->select([
            'id_tku', 
            'tablok',
            'COUNT(nip) AS jml_asn', 
            'COUNT(nip) FILTER (WHERE pph_diajukan > 0) AS jml_asn_krg', 
            'SUM(bruto_gaji) AS bruto_gaji', 
            'SUM(tpp) AS bruto_tpp',
            'SUM(jkk) AS jkk',
            'SUM(jkm) AS jkm',
            'SUM(bpjs4) AS bpjs4',
            'SUM(bruto_total) AS bruto_total',
            'SUM(pot_bea_jabatan) AS bea_jabatan',
            'SUM(pot_iuran_pensiun) AS iuran_pensiun',
            'SUM(ptkp) AS ptkp',
            'SUM(pph_gaji_akhir_masa) AS pph_gaji_akhir',
            'SUM(pph_total) AS pph_total', 
            'SUM(pph_terbayar) AS pph_terbayar',
            'SUM(pph_terhutang) AS pph_terhutang',
            'SUM(pph_diajukan) AS pph_diajukan',
        ])
        ->where(['tahun_pajak' => $tahun, 'tablok' => $opd, 'jenis' => 3])
        ->groupBy(['id_tku', 'tahun_pajak', 'tablok', 'jenis'])
        ->asArray()
        ->one();

        // return Json::encode($data, $asArray = true);

        $content =  $this->renderPartial('coretax-cetak', [
            'data' => $data, 'opd' => $nama_skpd, 'tahun' => $tahun,
        ]);

        $pdf = new Pdf([
            'mode' => Pdf::MODE_CORE, 
            'format' => Pdf::FORMAT_FOLIO, 
            'orientation' => Pdf::ORIENT_LANDSCAPE, 
            'destination' => Pdf::DEST_BROWSER, 
            'content' => $content,  
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
            'cssInline' => '.kv-heading-1{font-size:12px}', 
            'options' => ['title' => 'Cetak Coretax '.$nama_skpd],
            'methods' => [ 
                //'SetHeader'=>['TPP '.ucfirst(Fungsi::NmBulan($bulan).' '.$tahun)], 
                'SetFooter'=>['
                    <div style="width: 100%;">
                        <div style="float: left; width: 30%; text-align: left;">Tgl Cetak : '.date('d-m-Y H:i:s').'</div>
                        <div style="float: right; width: 70%; text-align: right;">'.$nama_skpd.' : Hal. {PAGENO}</div>
                    </div>
                '],
            ]
        ]);
        return $pdf->render(); 
        
    }
}
