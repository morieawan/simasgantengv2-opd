<?php

namespace app\modules\sitampan\controllers;

use app\modules\sitampan\models\PreskinCoretaxTpp;
use app\modules\sitampan\models\PreskinCoretaxTppSearch;
use app\modules\gaji\models\SimasGajiSkpdTbl;
use app\modules\gaji\models\SimasGajiMstpegawai;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Cell\DataType;

use Yii;
use yii\web\Response;
use kartik\mpdf\Pdf;
/**
 * PreskinCoretaxTppController implements the CRUD actions for PreskinCoretaxTpp model.
 */
class PreskinCoretaxTppController extends Controller
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
     * Lists all PreskinCoretaxTpp models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PreskinCoretaxTppSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->query->andWhere(['>', 'bruto', 0]);
        $dataProvider->query->andWhere(['jenis' => 3]);
        $dataProvider->query->orderBy(['tablok' => SORT_ASC, 'nip' => SORT_ASC]);

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

        $searchModel = new PreskinCoretaxTppSearch();

        return $this->render('_search', [
            'model' => $searchModel,
            'skpd' => $skpd,
        ]);
    }

    public function actionExportExcel($bulan, $tahun, $id)
    {
        $skpd = SimasGajiSkpdTbl::find()
            ->select(['KDSKPD', 'NMSKPD'])
            ->where(['KDSKPD' => $id])
            ->asArray()
            ->one();

        $nama_skpd = $skpd['NMSKPD'];    

        $templatePath = Yii::getAlias('@webroot/unggahan/template_coretax.xlsx');
        $spreadsheet = IOFactory::load($templatePath);
        $sheet = $spreadsheet->getActiveSheet();

        $data = PreskinCoretaxTpp::find()
        ->where(['masa_pajak' => $bulan, 'tahun_pajak' => $tahun, 'tablok' => $id])
        ->andWhere(['jenis' => 3])
        ->orderBy(['nip' => SORT_ASC])
        ->asArray()
        ->all();

        // $tku = $data[0]['id_tku'];
        // $sheet->setCellValue('B1', $tku);

        // (3) Tulis data mulai baris 5
        $startRow = 2;
        foreach ($data as $i => $row) {
            $col = 'A';
            foreach ($row as $key => $value) {

                if($col == 'L') {
                    $value = $value ? $value."000000" : "";
                }

                $sheet->setCellValue($col . ($startRow + $i), $value);

                // if($key == 'nik' || $key == 'nip') $value = "'$value"; 

                if($col == 'D' || $col == 'N'){
                    $value = (string)($value); 
                    $sheet->getStyle($col)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_TEXT);
                    $sheet->setCellValueExplicit($col.($startRow + $i), "$value", DataType::TYPE_STRING);
                }

                $col++;
            }
        }

        // (4) Output ke browser
        $filename = "coretax $tahun $bulan $id-$nama_skpd.xlsx";
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

    public function actionCetak($bulan, $tahun, $name)
    {
        $opd = $name;
        $skpd = SimasGajiSkpdTbl::find()
            ->select(['KDSKPD', 'NMSKPD'])
            ->where(['KDSKPD' => $opd])
            ->asArray()
            ->one();

        $nama_skpd = $skpd['NMSKPD'];    
        $data = PreskinCoretaxTpp::find()
        ->select([
            'id_tku', 
            'tablok',
            'COUNT(nip) AS jml_asn', 
            'SUM(bruto_gaji) AS bruto_gaji', 
            'SUM(bruto_tpp) AS bruto_tpp',
            'SUM(pph_gaji) AS pph_gaji', 
            'SUM(pph_tpp) AS pph_tpp',
            'SUM(pph_total) AS pph_total'
        ])
        ->where(['masa_pajak' => $bulan, 'tahun_pajak' => $tahun, 'tablok' => $opd, 'jenis' => 3])
        ->groupBy(['id_tku', 'masa_pajak', 'tahun_pajak', 'tablok', 'jenis'])
        ->asArray()
        ->one();

        // return Json::encode($data, $asArray = true);

        $content =  $this->renderPartial('coretax-cetak', [
            'data' => $data, 'opd' => $nama_skpd, 'tahun' => $tahun, 'bulan' => $bulan,
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
