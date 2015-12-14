<?php

class PenagihanController extends Controller {

    public $layout = '//layouts/column1';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'WAuth',
        );
    }

    public function actionSuratTeguran() {
        $title = Yii::t('trans', 'Cetak Surat Teguran');
        $filename = 'surat_teguran_' . date("d-m-Y_h:i:s-A");
        $model = new SuratTeguranForm();
        $model->periode = date('Y');
        $model->tanggal = date('d/m/Y');
        $model->tanggal_proses = date('d/m/Y');
        $html_report = '';
        if (isset($_POST['SuratTeguranForm'])) {
            $model->attributes = $_POST['SuratTeguranForm'];
            if ($model->validate()) {
                $filter = array();
                $where = '';
                if (isset($model->periode) && trim($model->periode) != "")
                    $filter[] = 'periode=' . $model->periode;
                if (isset($model->wajib_pajak_id) && trim($model->wajib_pajak_id) != "")
                    $filter[] = 'wajib_pajak_id=' . $model->wajib_pajak_id;

                if (count($filter)) {
                    $where = ' WHERE ' . implode(' AND ', $filter);
                }
                $rep = new WPJasper();
                $reportId = 'surat_teguran';
                $wajib_pajak = WajibPajak::model()->findByPk($model->wajib_pajak_id);
                $alamat = $wajib_pajak->alamat . ' Kel. ' . $wajib_pajak->kelurahan . ' Kec. ' . $wajib_pajak->kecamatan . ' ' . $wajib_pajak->kabupaten;
                $mengetahui = Pejabat::model()->findByPk($model->mengetahui);
                $params = array(
                    'JudulLaporan' => 'SURAT TEGURAN',
                    'SubJudulLaporan' => 'Nomor :..............',
                    'KetTtd' => Yii::app()->params['kota_perusahaan'] . ", " . date_format(date_create_from_format('d/m/Y', $model->tanggal), "d F Y"),
                    'PangkatTtd' => $mengetahui->pangkat->nama,
                    'NamaTtd' => $mengetahui->nama,
                    'JabatanTtd' => $mengetahui->jabatan->nama,
                    'NipTtd' => $mengetahui->nip,
                    'Npwpd' => 'NPWPD/NPWPRD *) : ' . $wajib_pajak->npwpd,
                    'Kepada' => 'Kepada Yth.<br>' . $wajib_pajak->nama . '<br>' . $alamat,
                    'Par_SQL' => 'SELECT * FROM v_surat_teguran' . $where,
                );
                if (isset($_POST['type_report'])) {
                    $rep->generateReport($reportId, $_POST['type_report'], $params, $filename);
                } else {
                    $html_report = $rep->generateReport($reportId, WPJasper::FORMAT_HTML, $params, $filename);
                }
            }
        }
        $this->render('surat_teguran', array(
            'model' => $model,
            'title' => $title,
            'html_report' => $html_report,
        ));
    }

    public function actionBukuKendali() {
        
    }

    public function actionDaftarTunggakan() {
        
    }

    public function actionDynamicKelurahan() {
        $data = CHtml::listData(Kelurahan::model()->findAll('kecamatan_id=:kecamatan_id', array(':kecamatan_id' => (int) $_POST['JrWajibPajakForm']['kecamatan'])), 'id', 'nama');
        echo CHtml::tag('option', array('value' => ''), Yii::t('trans', '- Pilih Kelurahan -'), true);
        foreach ($data as $value => $name) {
            echo CHtml::tag('option', array('value' => $value), CHtml::encode($name), true);
        }
    }

}
