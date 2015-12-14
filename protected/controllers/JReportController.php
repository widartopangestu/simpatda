<?php

class JReportController extends Controller {

    public $layout = '//layouts/column1';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'WAuth - dynamicKelurahan',
        );
    }

    public function actionUserList() {
        $title = Yii::t('trans', 'Laporan Data Pengguna');
        $filename = 'masteruser_list_' . date("d-m-Y_h:i:s-A");
        $model = new JrUserForm();
        $html_report = '';
        if (isset($_POST['JrUserForm'])) {
            $model->attributes = $_POST['JrUserForm'];
            if ($model->validate()) {
                $filter = array();
                $where = '';
                if (isset($model->status) && trim($model->status) != "")
                    $filter[] = 'status=' . $model->status;
                if (isset($model->role_id) && trim($model->role_id) != "")
                    $filter[] = 'role_id=' . $model->role_id;

                if (count($filter)) {
                    $where = ' WHERE ' . implode(' AND ', $filter);
                }
                $rep = new WPJasper();
                $reportId = 'user_list';
                $params = array(
                    'Par_JudulLaporan' => Yii::t('trans', 'MASTER USER REPORT'),
                    'Par_SubJudulLaporan' => Yii::t('trans', 'By User Name'),
                    'Par_SQL' => 'SELECT * FROM v_userlist' . $where,
                );
                if (isset($_POST['type_report'])) {
                    $rep->generateReport($reportId, $_POST['type_report'], $params, $filename);
                } else {
                    $html_report = $rep->generateReport($reportId, WPJasper::FORMAT_HTML, $params, $filename);
                }
            }
        }
        $this->render('masteruser_list', array(
            'model' => $model,
            'title' => $title,
            'html_report' => $html_report,
        ));
    }

    public function actionUserActivityList() {
        $title = Yii::t('trans', 'Laporan Aktifitas Pengguna');
        $filename = 'log_activity_list_' . date("d-m-Y_h:i:s-A");
        $model = new JrUserActivityForm();
        $model->date_from = date("01/m/Y");
        $model->date_to = date("d/m/Y");
        $model->user_id = Yii::app()->user->id;
        $html_report = '';
        if (isset($_POST['JrUserActivityForm'])) {
            $model->attributes = $_POST['JrUserActivityForm'];
            if ($model->validate()) {
                $filter = array();
                $where = '';
                if ((isset($model->date_from) && trim($model->date_from) != "") && (isset($model->date_to) && trim($model->date_to) != ""))
                    $filter[] = "tanggal BETWEEN '" . date("Y-m-d", strtotime(date_format(date_create_from_format('d/m/Y', $model->date_from), "Y-m-d"))) . "' AND '" . date("Y-m-d", strtotime(date_format(date_create_from_format('d/m/Y', $model->date_to), "Y-m-d") . ' +1 day')) . "'";
                if (isset($model->user_id) && trim($model->user_id) != "")
                    $filter[] = 'user_id=' . $model->user_id;

                if (count($filter)) {
                    $where = ' WHERE ' . implode(' AND ', $filter);
                }
                $rep = new WPJasper();
                $reportId = 'user_log';
                $params = array(
                    'Par_JudulLaporan' => Yii::t('trans', 'USER ACTIVITIES LOG REPORT'),
                    'Par_SubJudulLaporan' => Yii::t('trans', 'By User Name'),
                    'Par_SQL' => 'SELECT * FROM v_userlog' . $where,
                );
                if (isset($_POST['type_report'])) {
                    $rep->generateReport($reportId, $_POST['type_report'], $params, $filename);
                } else {
                    $html_report = $rep->generateReport($reportId, WPJasper::FORMAT_HTML, $params, $filename);
                }
            }
        }
        $this->render('log_activity_list', array(
            'model' => $model,
            'title' => $title,
            'html_report' => $html_report,
        ));
    }

    public function actionWajibPajak() {
        $title = Yii::t('trans', 'Laporan Daftar Wajib Pajak');
        $filename = 'wajib_pajak_' . date("d-m-Y_h:i:s-A");
        $model = new JrWajibPajakForm();
        $model->tanggal = date('d/m/Y');
        $html_report = '';
        if (isset($_POST['JrWajibPajakForm'])) {
            $model->attributes = $_POST['JrWajibPajakForm'];
            if ($model->validate()) {
                $filter = array();
                $judul_laporan = 'DAFTAR INDUK WAJIB PAJAK';
                $kecamatan = '';
                $kelurahan = '';
                $where = '';
                if (isset($model->status) && trim($model->status) != "")
                    $filter[] = 'status=' . $model->status;
                if (isset($model->jenis) && trim($model->jenis) != "")
                    $filter[] = 'jenis=\'' . $model->jenis . '\'';
                if (isset($model->golongan) && trim($model->golongan) != "")
                    $filter[] = 'golongan=' . $model->golongan;
                if (isset($model->kecamatan) && trim($model->kecamatan) != "") {
                    $filter[] = 'kecamatan_id=' . $model->kecamatan;
                    $kecamatan = 'Kecamatan : ' . Kecamatan::model()->findByPk($model->kecamatan)->nama;
                }
                if (isset($model->kelurahan) && trim($model->kelurahan) != "") {
                    $filter[] = 'kelurahan_id=' . $model->kelurahan;
                    $kelurahan = 'Kelurahan : ' . Kelurahan::model()->findByPk($model->kelurahan)->nama;
                }
                if (isset($model->kode_rekening) && trim($model->kode_rekening) != "") {
                    $filter[] = 'kode_rekening_id=' . $model->kode_rekening;
                    $judul_laporan .= '<br>' . KodeRekening::model()->findByPk($model->kode_rekening)->nama;
                } else
                    $judul_laporan .= ' SE-KABUPATEN MUARA ENIM';

                if (count($filter)) {
                    $where = ' WHERE ' . implode(' AND ', $filter);
                }
                $rep = new WPJasper();
                $reportId = 'wajib_pajak';
                $mengetahui = Pejabat::model()->findByPk($model->mengetahui);
                $diperiksa = Pejabat::model()->findByPk($model->diperiksa);
                $params = array(
                    'JudulLaporan' => $judul_laporan,
                    'SubJudulLaporan' => Yii::t('trans', 'Keadaan s/d tanggal') . ' ' . date('d F Y'),
                    'KetTtd' => 'Mengetahui,',
                    'PangkatTtd' => $mengetahui->pangkat->nama,
                    'NamaTtd' => $mengetahui->nama,
                    'JabatanTtd' => $mengetahui->jabatan->nama,
                    'NipTtd' => $mengetahui->nip,
                    'KetTtd1' => Yii::app()->params['kota_perusahaan'] . ", " . date_format(date_create_from_format('d/m/Y', $model->tanggal), "d F Y"),
                    'PangkatTtd1' => $diperiksa->pangkat->nama,
                    'NamaTtd1' => $diperiksa->nama,
                    'JabatanTtd1' => $diperiksa->jabatan->nama,
                    'NipTtd1' => $diperiksa->nip,
                    'Kecamatan' => $kecamatan,
                    'Kelurahan' => $kelurahan,
                    'Par_SQL' => 'SELECT * FROM v_spt_wajib_pajak' . $where,
                );
                if (isset($_POST['type_report'])) {
                    $rep->generateReport($reportId, $_POST['type_report'], $params, $filename);
                } else {
                    $html_report = $rep->generateReport($reportId, WPJasper::FORMAT_HTML, $params, $filename);
                }
            }
        }
        $this->render('wajib_pajak', array(
            'model' => $model,
            'title' => $title,
            'html_report' => $html_report,
        ));
    }
    public function actionSpt() {
        
    }

    public function actionDynamicKelurahan() {
        $data = CHtml::listData(Kelurahan::model()->findAll('kecamatan_id=:kecamatan_id', array(':kecamatan_id' => (int) $_POST['JrWajibPajakForm']['kecamatan'])), 'id', 'nama');
        echo CHtml::tag('option', array('value' => ''), Yii::t('trans', '- Pilih Kelurahan -'), true);
        foreach ($data as $value => $name) {
            echo CHtml::tag('option', array('value' => $value), CHtml::encode($name), true);
        }
    }

    public function actionSetoranPajak() {
        $title = Yii::t('trans', 'Laporan Daftar Setoran Pajak');
        $filename = 'setoran_pajak_' . date("d-m-Y_h:i:s-A");
        $model = new JrSetoranPajakForm();
        $model->tanggal = date('d/m/Y');
        $model->periode = date('Y');
        $html_report = '';
        if (isset($_POST['JrSetoranPajakForm'])) {
            $model->attributes = $_POST['JrSetoranPajakForm'];
            if ($model->validate()) {
                $filter = array();
                $judul_laporan = 'DAFTAR SETORAN PAJAK';
                $where = '';
                if (isset($model->periode) && trim($model->periode) != "")
                    $filter[] = 'periode=' . $model->periode;
                if (isset($model->nomor_from) && trim($model->nomor_from) != "" && isset($model->nomor_to) && trim($model->nomor_to) != "")
                    $filter[] = 'nomor BETWEEN \'' . $model->nomor_from . '\' AND \'' . $model->nomor_to . '\'';

                if (count($filter)) {
                    $where = ' WHERE ' . implode(' AND ', $filter);
                }
                $rep = new WPJasper();
                $reportId = 'setoran_pajak';
                $mengetahui = Pejabat::model()->findByPk($model->mengetahui);
                $bendahara = Pejabat::model()->findByPk($model->bendahara);
                $params = array(
                    'JudulLaporan' => $judul_laporan,
                    'SubJudulLaporan' => Yii::t('trans', 'Dari Nomor {nomor_from} s/d. {nomor_to} Tahun {periode}', array('{nomor_from}' => $model->nomor_from, '{nomor_to}' => $model->nomor_to, '{periode}' => $model->periode)),
                    'KetTtd' => 'Mengetahui,',
                    'PangkatTtd' => $mengetahui->pangkat->nama,
                    'NamaTtd' => $mengetahui->nama,
                    'JabatanTtd' => $mengetahui->jabatan->nama,
                    'NipTtd' => $mengetahui->nip,
                    'KetTtd1' => Yii::app()->params['kota_perusahaan'] . ", " . date_format(date_create_from_format('d/m/Y', $model->tanggal), "d F Y"),
                    'PangkatTtd1' => $bendahara->pangkat->nama,
                    'NamaTtd1' => $bendahara->nama,
                    'JabatanTtd1' => $bendahara->jabatan->nama,
                    'NipTtd1' => $bendahara->nip,
                    'Par_SQL' => 'SELECT * FROM v_setoran_pajak' . $where,
                );
                if (isset($_POST['type_report'])) {
                    $rep->generateReport($reportId, $_POST['type_report'], $params, $filename);
                } else {
                    $html_report = $rep->generateReport($reportId, WPJasper::FORMAT_HTML, $params, $filename);
                }
            }
        }
        $this->render('setoran_pajak', array(
            'model' => $model,
            'title' => $title,
            'html_report' => $html_report,
        ));
    }

}
