<?php

class JReportController extends Controller {

    public $layout = '//layouts/column1';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'WAuth - rekapitulasiMenu, rekapitulasiPenerimaanMenu, rekapitulasi, rekapitulasiPenerimaan, dynamicKelurahan',
        );
    }

    public function actionRekapitulasiMenu() {
        if (Yii::app()->util->is_authorized('jReport.rekapitulasiHotel') || Yii::app()->util->is_authorized('jReport.rekapitulasiRestoran') || Yii::app()->util->is_authorized('jReport.rekapitulasiHiburan') || Yii::app()->util->is_authorized('jReport.rekapitulasiReklame') || Yii::app()->util->is_authorized('jReport.rekapitulasiElectric') || Yii::app()->util->is_authorized('jReport.rekapitulasiGalian') || Yii::app()->util->is_authorized('jReport.rekapitulasiAir') || Yii::app()->util->is_authorized('jReport.rekapitulasiWalet') || Yii::app()->util->is_authorized('jReport.rekapitulasiRetribusi') || Yii::app()->util->is_authorized('jReport.rekapitulasiBphtb')) {
            $this->render('rekapitulasi_menu');
        } else {
            if (Yii::app()->user->isGuest)
                $this->redirect(Yii::app()->user->loginUrl);
            else
                throw new CHttpException(403, Yii::t('trans', 'You do not have sufficient permissions to access this page.'));
        }
    }

    public function actionRekapitulasiPenerimaanMenu() {
        if (Yii::app()->util->is_authorized('jReport.rekapitulasiPenerimaanHotel') || Yii::app()->util->is_authorized('jReport.rekapitulasiPenerimaanRestoran') || Yii::app()->util->is_authorized('jReport.rekapitulasiPenerimaanHiburan') || Yii::app()->util->is_authorized('jReport.rekapitulasiPenerimaanReklame') || Yii::app()->util->is_authorized('jReport.rekapitulasiPenerimaanElectric') || Yii::app()->util->is_authorized('jReport.rekapitulasiPenerimaanGalian') || Yii::app()->util->is_authorized('jReport.rekapitulasiPenerimaanAir') || Yii::app()->util->is_authorized('jReport.rekapitulasiPenerimaanWalet') || Yii::app()->util->is_authorized('jReport.rekapitulasiPenerimaanRetribusi') || Yii::app()->util->is_authorized('jReport.rekapitulasiPenerimaanBphtb')) {
            $this->render('rekapitulasi_penerimaan_menu');
        } else {
            if (Yii::app()->user->isGuest)
                $this->redirect(Yii::app()->user->loginUrl);
            else
                throw new CHttpException(403, Yii::t('trans', 'You do not have sufficient permissions to access this page.'));
        }
    }

    public function actionRekapitulasi($pajak) {
        if (Yii::app()->util->is_authorized('jReport.rekapitulasiHotel') || Yii::app()->util->is_authorized('jReport.rekapitulasiRestoran') || Yii::app()->util->is_authorized('jReport.rekapitulasiHiburan') || Yii::app()->util->is_authorized('jReport.rekapitulasiReklame') || Yii::app()->util->is_authorized('jReport.rekapitulasiElectric') || Yii::app()->util->is_authorized('jReport.rekapitulasiGalian') || Yii::app()->util->is_authorized('jReport.rekapitulasiAir') || Yii::app()->util->is_authorized('jReport.rekapitulasiWalet') || Yii::app()->util->is_authorized('jReport.rekapitulasiRetribusi') || Yii::app()->util->is_authorized('jReport.rekapitulasiBphtb')) {
            $title = Yii::t('trans', 'Cetak Rekapitulasi');
            $model = new RekapitulasiForm();
            $model->periode = date('Y');
            $model->kode_rekening_id = $pajak;
            $filename = 'rekapitulasi_' . date("d-m-Y_h:i:s-A");
            $html_report = '';
            if (isset($_POST['RekapitulasiForm'])) {
                $model->attributes = $_POST['RekapitulasiForm'];
                if ($model->validate()) {
                    $filter = array();
                    $where = '';
                    $judul_laporan = 'Rekapitulasi';
                    if (isset($model->periode) && trim($model->periode) != "")
                        $filter[] = 'periode=' . $model->periode;
                    if (isset($model->kecamatan_id) && trim($model->kecamatan_id) != "")
                        $filter[] = 'kecamatan_id=' . $model->kecamatan_id;
                    if (isset($model->kode_rekening_id) && trim($model->kode_rekening_id) != "") {
                        $filter[] = 'kode_rekening_id=' . $model->kode_rekening_id;
                        $nama_rekening = KodeRekening::model()->findByPk($model->kode_rekening_id)->nama;
                        $judul_laporan .= ' ' . $nama_rekening;
                        $filename = 'rekapitulasi_' . $model->periode . '_' . strtolower($nama_rekening) . '_' . date("d-m-Y_h:i:s-A");
                    }
                    TmpRekapitulasi::model()->generateData($model->periode, $model->kode_rekening_id, false);
                    if (count($filter)) {
                        $where = ' WHERE ' . implode(' AND ', $filter);
                    }
                    $rep = new WPJasper();
                    $reportId = 'rekapitulasi';
                    $pembuat = Pejabat::model()->findByPk($model->pembuat);
                    $mengetahui = Pejabat::model()->findByPk($model->mengetahui);
                    $params = array(
                        'JudulLaporan' => $judul_laporan,
                        'SubJudulLaporan' => 'Tahun ' . $model->periode,
                        'KetTtd' => 'Mengetahui,',
                        'PangkatTtd' => $mengetahui->pangkat->nama,
                        'NamaTtd' => $mengetahui->nama,
                        'JabatanTtd' => $mengetahui->jabatan->nama,
                        'NipTtd' => $mengetahui->nip,
                        'KetTtd1' => Yii::app()->params['kota_perusahaan'] . ", " . date("d F Y"),
                        'PangkatTtd1' => $pembuat->pangkat->nama,
                        'NamaTtd1' => $pembuat->nama,
                        'JabatanTtd1' => $pembuat->jabatan->nama,
                        'NipTtd1' => $pembuat->nip,
                        'UserName' => Yii::app()->user->nickName,
                        'RoleName' => Yii::app()->user->roleName,
                        'Par_SQL' => 'SELECT * FROM tmp_rekapitulasi' . $where . ' order by nama_kecamatan',
                    );
                    if (isset($_POST['type_report'])) {
                        $rep->generateReport($reportId, $_POST['type_report'], $params, $filename);
                    } else {
                        $html_report = $rep->generateReport($reportId, WPJasper::FORMAT_HTML, $params, $filename);
                    }
                }
            }
            $this->render('rekapitulasi', array(
                'model' => $model,
                'title' => $title,
                'html_report' => $html_report,
            ));
        } else {
            if (Yii::app()->user->isGuest)
                $this->redirect(Yii::app()->user->loginUrl);
            else
                throw new CHttpException(403, Yii::t('trans', 'You do not have sufficient permissions to access this page.'));
        }
    }

    public function actionRekapitulasiDetail() {
        $title = Yii::t('trans', 'Cetak RekapitulasiDetail');
        $model = new RekapitulasiDetailForm();
        $model->periode = date('Y');
        $filename = 'rekapitulasi_detail_' . date("d-m-Y_h:i:s-A");
        $html_report = '';
        if (isset($_POST['RekapitulasiDetailForm'])) {
            $model->attributes = $_POST['RekapitulasiDetailForm'];
            if ($model->validate()) {
                $filter = array();
                $where = '';
                $judul_laporan = 'Rekapitulasi';
                if (isset($model->periode) && trim($model->periode) != "")
                    $filter[] = 'periode=' . $model->periode;
                if (isset($model->kecamatan_id) && trim($model->kecamatan_id) != "")
                    $filter[] = 'kecamatan_id=' . $model->kecamatan_id;
                if (isset($model->kode_rekening_id) && trim($model->kode_rekening_id) != "") {
                    $filter[] = 'kode_rekening_id=' . $model->kode_rekening_id;
                    $nama_rekening = KodeRekening::model()->findByPk($model->kode_rekening_id)->nama;
                    $judul_laporan .= ' ' . $nama_rekening;
                    $filename = 'rekapitulasi_detail_' . $model->periode . '_' . strtolower($nama_rekening) . '_' . date("d-m-Y_h:i:s-A");
                }
                TmpRekapitulasi::model()->generateDataDetail($model->periode, $model->kode_rekening_id, false);
                if (count($filter)) {
                    $where = ' WHERE ' . implode(' AND ', $filter);
                }
                $rep = new WPJasper();
                $reportId = 'rekapitulasi_detail';
                $menyetujui = Pejabat::model()->findByPk($model->menyetujui);
                $mengetahui = Pejabat::model()->findByPk($model->mengetahui);
                $diperiksa = Pejabat::model()->findByPk($model->diperiksa);
                $params = array(
                    'JudulLaporan' => $judul_laporan,
                    'SubJudulLaporan' => 'Tahun ' . $model->periode,
                    'KetTtd' => 'Menyetujui,',
                    'PangkatTtd' => $menyetujui->pangkat->nama,
                    'NamaTtd' => $menyetujui->nama,
                    'JabatanTtd' => $menyetujui->jabatan->nama,
                    'NipTtd' => $menyetujui->nip,
                    'KetTtd1' => 'Mengetahui,',
                    'PangkatTtd1' => $mengetahui->pangkat->nama,
                    'NamaTtd1' => $mengetahui->nama,
                    'JabatanTtd1' => $mengetahui->jabatan->nama,
                    'NipTtd1' => $mengetahui->nip,
                    'KetTtd2' => 'Diperiksa Oleh,',
                    'PangkatTtd2' => $diperiksa->pangkat->nama,
                    'NamaTtd2' => $diperiksa->nama,
                    'JabatanTtd2' => $diperiksa->jabatan->nama,
                    'NipTtd2' => $diperiksa->nip,
                    'UserName' => Yii::app()->user->nickName,
                    'RoleName' => Yii::app()->user->roleName,
                    'Tanggal' => date("d F Y"),
                    'Par_SQL' => 'SELECT * FROM tmp_rekapitulasi' . $where . ' order by nama_kecamatan',
                );
                if (isset($_POST['type_report'])) {
                    $rep->generateReport($reportId, $_POST['type_report'], $params, $filename);
                } else {
                    $html_report = $rep->generateReport($reportId, WPJasper::FORMAT_HTML, $params, $filename);
                }
            }
        }
        $this->render('rekapitulasi_detail', array(
            'model' => $model,
            'title' => $title,
            'html_report' => $html_report,
        ));
    }

    public function actionRekapitulasiPenerimaan($pajak) {
        if (Yii::app()->util->is_authorized('jReport.rekapitulasiPenerimaanHotel') || Yii::app()->util->is_authorized('jReport.rekapitulasiPenerimaanRestoran') || Yii::app()->util->is_authorized('jReport.rekapitulasiPenerimaanHiburan') || Yii::app()->util->is_authorized('jReport.rekapitulasiPenerimaanReklame') || Yii::app()->util->is_authorized('jReport.rekapitulasiPenerimaanElectric') || Yii::app()->util->is_authorized('jReport.rekapitulasiPenerimaanGalian') || Yii::app()->util->is_authorized('jReport.rekapitulasiPenerimaanAir') || Yii::app()->util->is_authorized('jReport.rekapitulasiPenerimaanWalet') || Yii::app()->util->is_authorized('jReport.rekapitulasiPenerimaanRetribusi') || Yii::app()->util->is_authorized('jReport.rekapitulasiPenerimaanBphtb')) {
            $title = Yii::t('trans', 'Cetak Rekapitulasi Penerimaan');
            $filename = 'rekapitulasi_penerimaan_' . date("d-m-Y_h:i:s-A");
            $model = new RekapitulasiPenerimaanForm();
            $model->tahun = date('Y');
            $model->jenis_pajak = $pajak;
            $html_report = '';
            if (isset($_POST['RekapitulasiPenerimaanForm'])) {
                $model->attributes = $_POST['RekapitulasiPenerimaanForm'];
                if ($model->validate()) {
                    $filter = array();
                    $where = '';
                    $judul_laporan = 'Rekapitulasi Penerimaan';
                    if (isset($model->tahun) && trim($model->tahun) != "")
                        $filter[] = 'periode=' . $model->tahun;
                    if (isset($model->kecamatan_id) && trim($model->kecamatan_id) != "")
                        $filter[] = 'kecamatan_id=' . $model->kecamatan_id;
                    if (isset($model->jenis_pajak) && trim($model->jenis_pajak) != "") {
                        $filter[] = 'kode_rekening_id=' . $model->jenis_pajak;
                        $nama_rekening = KodeRekening::model()->findByPk($model->jenis_pajak)->nama;
                        $judul_laporan .= ' ' . $nama_rekening;
                        $filename = 'rekapitulasi_penerimaan_' . $model->tahun . '_' . strtolower($nama_rekening) . '_' . date("d-m-Y_h:i:s-A");
                    }
                    if (count($filter)) {
                        $where = ' WHERE ' . implode(' AND ', $filter);
                    }
                    $rep = new WPJasper();
                    $reportId = 'rekapitulasi_penerimaan';
                    $menyetujui = Pejabat::model()->findByPk($model->menyetujui);
                    $mengetahui = Pejabat::model()->findByPk($model->mengetahui);
                    $diperiksa = Pejabat::model()->findByPk($model->diperiksa);
                    $params = array(
                        'JudulLaporan' => $judul_laporan,
                        'SubJudulLaporan' => '',
                        'KetTtd' => 'Menyetujui,',
                        'PangkatTtd' => $menyetujui->pangkat->nama,
                        'NamaTtd' => $menyetujui->nama,
                        'JabatanTtd' => $menyetujui->jabatan->nama,
                        'NipTtd' => $menyetujui->nip,
                        'KetTtd1' => 'Mengetahui,',
                        'PangkatTtd1' => $mengetahui->pangkat->nama,
                        'NamaTtd1' => $mengetahui->nama,
                        'JabatanTtd1' => $mengetahui->jabatan->nama,
                        'NipTtd1' => $mengetahui->nip,
                        'KetTtd2' => 'Diperiksa Oleh,',
                        'PangkatTtd2' => $diperiksa->pangkat->nama,
                        'NamaTtd2' => $diperiksa->nama,
                        'JabatanTtd2' => $diperiksa->jabatan->nama,
                        'NipTtd2' => $diperiksa->nip,
                        'UserName' => Yii::app()->user->nickName,
                        'RoleName' => Yii::app()->user->roleName,
                        'Tanggal' => date("d F Y"),
                        'Par_SQL' => 'SELECT * FROM v_rekapitulasi_penerimaan' . $where . ' order by nama_kecamatan',
                    );
                    if (isset($_POST['type_report'])) {
                        $rep->generateReport($reportId, $_POST['type_report'], $params, $filename);
                    } else {
                        $html_report = $rep->generateReport($reportId, WPJasper::FORMAT_HTML, $params, $filename);
                    }
                }
            }
            $this->render('rekapitulasi_penerimaan', array(
                'model' => $model,
                'title' => $title,
                'html_report' => $html_report,
            ));
        } else {
            if (Yii::app()->user->isGuest)
                $this->redirect(Yii::app()->user->loginUrl);
            else
                throw new CHttpException(403, Yii::t('trans', 'You do not have sufficient permissions to access this page.'));
        }
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
                $judul_laporan = 'Daftar Induk Wajib Pajak';
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
                    $judul_laporan .= ' Se-Kabupaten Muara Enim';

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
                $judul_laporan = 'Daftar Setoran Pajak';
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
                $pembuat = Pejabat::model()->findByPk($model->pembuat);
                $params = array(
                    'JudulLaporan' => $judul_laporan,
                    'SubJudulLaporan' => Yii::t('trans', 'Dari Nomor {nomor_from} s/d. {nomor_to} Tahun {periode}', array('{nomor_from}' => $model->nomor_from, '{nomor_to}' => $model->nomor_to, '{periode}' => $model->periode)),
                    'KetTtd' => 'Mengetahui,',
                    'PangkatTtd' => $mengetahui->pangkat->nama,
                    'NamaTtd' => $mengetahui->nama,
                    'JabatanTtd' => $mengetahui->jabatan->nama,
                    'NipTtd' => $mengetahui->nip,
                    'KetTtd1' => Yii::app()->params['kota_perusahaan'] . ", " . date_format(date_create_from_format('d/m/Y', $model->tanggal), "d F Y"),
                    'PangkatTtd1' => $pembuat->pangkat->nama,
                    'NamaTtd1' => $pembuat->nama,
                    'JabatanTtd1' => $pembuat->jabatan->nama,
                    'NipTtd1' => $pembuat->nip,
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

    public function actionBpps() {
        $title = Yii::t('trans', 'Laporan Daftar BPPS');
        $filename = 'bpps_' . date("d-m-Y_h:i:s-A");
        $model = new JrBppsForm();
        $model->date_from = date("d/m/Y");
        $model->date_to = date("01/m/Y");
        $html_report = '';
        if (isset($_POST['JrBppsForm'])) {
            $model->attributes = $_POST['JrBppsForm'];
            if ($model->validate()) {
                $filter = array();
                $judul_laporan = 'Buku Pembantu Penerimaan Sejenis';
                $where = '';
                if (isset($model->kode_rekening_id) && trim($model->kode_rekening_id) != "")
                    $filter[] = 'kode_rekening_id=' . $model->kode_rekening_id;
                if (isset($model->kecamatan_id) && trim($model->kecamatan_id) != "")
                    $filter[] = 'kecamatan_id=' . $model->kecamatan_id;
                if (isset($model->via_bayar) && trim($model->via_bayar) != "") {
                    $filter[] = 'via_bayar=' . $model->via_bayar;
                    $judul_laporan .= '<br>Via ' . SetoranPajak::model()->getViaBayarText($model->via_bayar);
                }
                if ((isset($model->date_from) && trim($model->date_from) != "") && (isset($model->date_to) && trim($model->date_to) != "")) {
                    $filter[] = "tanggal_bayar BETWEEN '" . date("Y-m-d", strtotime(date_format(date_create_from_format('d/m/Y', $model->date_from), "Y-m-d"))) . "' AND '" . date("Y-m-d", strtotime(date_format(date_create_from_format('d/m/Y', $model->date_to), "Y-m-d") . ' +1 day')) . "'";
                    $judul_laporan .= '<br>Tahun Anggaran ' . date_format(date_create_from_format('d/m/Y', $model->date_from), "Y");
                }

                if (count($filter)) {
                    $where = ' WHERE ' . implode(' AND ', $filter);
                }
                $rep = new WPJasper();
                $reportId = 'bpps';
                $mengetahui = Pejabat::model()->findByPk($model->mengetahui);
                $pembuat = Pejabat::model()->findByPk($model->pembuat);
                $params = array(
                    'JudulLaporan' => $judul_laporan,
                    'SubJudulLaporan' => Yii::t('trans', 'Dari Tanggal {date_from} s/d. {date_to}', array('{date_from}' => $model->date_from, '{date_to}' => $model->date_to)),
                    'KetTtd' => 'Mengetahui,',
                    'PangkatTtd' => $mengetahui->pangkat->nama,
                    'NamaTtd' => $mengetahui->nama,
                    'JabatanTtd' => $mengetahui->jabatan->nama,
                    'NipTtd' => $mengetahui->nip,
                    'KetTtd1' => Yii::app()->params['kota_perusahaan'] . ", " . date("d F Y"),
                    'PangkatTtd1' => $pembuat->pangkat->nama,
                    'NamaTtd1' => $pembuat->nama,
                    'JabatanTtd1' => $pembuat->jabatan->nama,
                    'NipTtd1' => $pembuat->nip,
                    'Par_SQL' => 'SELECT * FROM v_setoran_pajak' . $where . ' order by kecamatan',
                );
                if (isset($_POST['type_report'])) {
                    $rep->generateReport($reportId, $_POST['type_report'], $params, $filename);
                } else {
                    $html_report = $rep->generateReport($reportId, WPJasper::FORMAT_HTML, $params, $filename);
                }
            }
        }
        $this->render('bpps', array(
            'model' => $model,
            'title' => $title,
            'html_report' => $html_report,
        ));
    }

    public function actionBppsDetail() {
        $title = Yii::t('trans', 'Laporan Daftar BPPS');
        $filename = 'bpps_detail_' . date("d-m-Y_h:i:s-A");
        $model = new JrBppsDetailForm();
        $model->date_from = date("d/m/Y");
        $model->date_to = date("01/m/Y");
        $html_report = '';
        if (isset($_POST['JrBppsDetailForm'])) {
            $model->attributes = $_POST['JrBppsDetailForm'];
            if ($model->validate()) {
                $filter = array();
                $judul_laporan = 'Buku Pembantu Penerimaan Sejenis Per Sub Kode Rekening';
                $where = '';
                if (isset($model->kode_rekening_id) && trim($model->kode_rekening_id) != "")
                    $filter[] = 'kode_rekening_id=' . $model->kode_rekening_id;
                if (isset($model->kecamatan_id) && trim($model->kecamatan_id) != "")
                    $filter[] = 'kecamatan_id=' . $model->kecamatan_id;
                if (isset($model->via_bayar) && trim($model->via_bayar) != "") {
                    $filter[] = 'via_bayar=' . $model->via_bayar;
                    $judul_laporan .= '<br>Via ' . SetoranPajak::model()->getViaBayarText($model->via_bayar);
                }
                if ((isset($model->date_from) && trim($model->date_from) != "") && (isset($model->date_to) && trim($model->date_to) != "")) {
                    $filter[] = "tanggal_bayar BETWEEN '" . date("Y-m-d", strtotime(date_format(date_create_from_format('d/m/Y', $model->date_from), "Y-m-d"))) . "' AND '" . date("Y-m-d", strtotime(date_format(date_create_from_format('d/m/Y', $model->date_to), "Y-m-d") . ' +1 day')) . "'";
                    $judul_laporan .= '<br>Tahun Anggaran ' . date_format(date_create_from_format('d/m/Y', $model->date_from), "Y");
                }

                if (count($filter)) {
                    $where = ' WHERE ' . implode(' AND ', $filter);
                }
                $rep = new WPJasper();
                $reportId = 'bpps_detail';
                $mengetahui = Pejabat::model()->findByPk($model->mengetahui);
                $pembuat = Pejabat::model()->findByPk($model->pembuat);
                $params = array(
                    'JudulLaporan' => $judul_laporan,
                    'SubJudulLaporan' => Yii::t('trans', 'Dari Tanggal {date_from} s/d. {date_to}', array('{date_from}' => $model->date_from, '{date_to}' => $model->date_to)),
                    'KetTtd' => 'Mengetahui,',
                    'PangkatTtd' => $mengetahui->pangkat->nama,
                    'NamaTtd' => $mengetahui->nama,
                    'JabatanTtd' => $mengetahui->jabatan->nama,
                    'NipTtd' => $mengetahui->nip,
                    'KetTtd1' => Yii::app()->params['kota_perusahaan'] . ", " . date("d F Y"),
                    'PangkatTtd1' => $pembuat->pangkat->nama,
                    'NamaTtd1' => $pembuat->nama,
                    'JabatanTtd1' => $pembuat->jabatan->nama,
                    'NipTtd1' => $pembuat->nip,
                    'Par_SQL' => 'SELECT * FROM v_setoran_spt_item' . $where . ' order by nama_kecamatan',
                );
                if (isset($_POST['type_report'])) {
                    $rep->generateReport($reportId, $_POST['type_report'], $params, $filename);
                } else {
                    $html_report = $rep->generateReport($reportId, WPJasper::FORMAT_HTML, $params, $filename);
                }
            }
        }
        $this->render('bpps_detail', array(
            'model' => $model,
            'title' => $title,
            'html_report' => $html_report,
        ));
    }

    public function actionBpsReklame() {
        $title = Yii::t('trans', 'Laporan Daftar BPS Pajak Reklame');
        $filename = 'bps_reklame_' . date("d-m-Y_h:i:s-A");
        $model = new JrBpsReklameForm();
        $model->tanggal = date('d/m/Y');
        $model->periode = date('Y');
        $html_report = '';
        if (isset($_POST['JrBpsReklameForm'])) {
            $model->attributes = $_POST['JrBpsReklameForm'];
            if ($model->validate()) {
                $filter = array();
                $judul_laporan = 'Buku Pembantu Setoran/Penetapan Pajak Reklame';
                $where = '';
                if (isset($model->periode) && trim($model->periode) != "")
                    $filter[] = 'periode=' . $model->periode;
                if (isset($model->bulan) && trim($model->bulan) != "")
                    $filter[] = "date_part('month', tanggal_bayar)=" . $model->bulan;

                if (count($filter)) {
                    $where = ' WHERE ' . implode(' AND ', $filter);
                }
                $rep = new WPJasper();
                $reportId = 'bps_reklame';
                $mengetahui = Pejabat::model()->findByPk($model->mengetahui);
                $pembuat = Pejabat::model()->findByPk($model->pembuat);
                $jumlah_bulan_lalu = 0;
                //
                $sql = "SELECT sum(jumlah_bayar) as total FROM v_setoran_pajak_reklame WHERE tanggal_bayar < '" . $model->periode . "-" . str_pad($model->bulan, 2, "0", STR_PAD_LEFT) . "-01'";
                $result = Yii::app()->db->createCommand($sql)->queryRow();
                if ($result) {
                    $jumlah_bulan_lalu = $result['total'];
                }
                $params = array(
                    'JudulLaporan' => $judul_laporan,
                    'Periode' => $model->periode,
                    'Bulan' => Yii::app()->locale->getMonthName($model->bulan),
                    'KetTtd' => 'Mengetahui,',
                    'PangkatTtd' => $mengetahui->pangkat->nama,
                    'NamaTtd' => $mengetahui->nama,
                    'JabatanTtd' => $mengetahui->jabatan->nama,
                    'NipTtd' => $mengetahui->nip,
                    'KetTtd1' => Yii::app()->params['kota_perusahaan'] . ", " . date_format(date_create_from_format('d/m/Y', $model->tanggal), "d F Y"),
                    'PangkatTtd1' => $pembuat->pangkat->nama,
                    'NamaTtd1' => $pembuat->nama,
                    'JabatanTtd1' => $pembuat->jabatan->nama,
                    'NipTtd1' => $pembuat->nip,
                    'JumlahBulanLalu' => $jumlah_bulan_lalu,
                    'Par_SQL' => 'SELECT * FROM v_setoran_pajak_reklame' . $where . ' order by tanggal_bayar DESC',
                );
                if (isset($_POST['type_report'])) {
                    $rep->generateReport($reportId, $_POST['type_report'], $params, $filename);
                } else {
                    $html_report = $rep->generateReport($reportId, WPJasper::FORMAT_HTML, $params, $filename);
                }
            }
        }
        $this->render('bps_reklame', array(
            'model' => $model,
            'title' => $title,
            'html_report' => $html_report,
        ));
    }

    public function actionPenggunaanGalian() {
        $title = Yii::t('trans', 'Daftar Rekapitulasi Penggunaan Mineral Bukan Logam');
        $filename = 'penggunaan_galian_' . date("d-m-Y_h:i:s-A");
        $model = new JrPenggunaanGalianForm();
        $model->periode = date('Y');
        $html_report = '';
        if (isset($_POST['JrPenggunaanGalianForm'])) {
            $model->attributes = $_POST['JrPenggunaanGalianForm'];
            if ($model->validate()) {
                $filter = array();
                $judul_laporan = 'Rekapitulasi Penggunaan Bahan Mineral Bukan Logam Dan Batuan';
                $where = '';
                if (isset($model->periode) && trim($model->periode) != "") {
                    $filter[] = 'periode=' . $model->periode;
                    TmpRekapitulasiPenggunaanGalian::model()->generateData($model->periode);
                }

                if (count($filter)) {
                    $where = ' WHERE ' . implode(' AND ', $filter);
                }
                $rep = new WPJasper();
                $reportId = 'rekapitulasi_penggunaan_galian';
                $mengetahui = Pejabat::model()->findByPk($model->mengetahui);
                $pembuat = Pejabat::model()->findByPk($model->pembuat);
                $params = array(
                    'JudulRekapitulasi' => $judul_laporan,
                    'SubJudulRekapitulasi' => Yii::t('trans', 'Tahun {periode}', array('{periode}' => $model->periode)),
                    'Periode' => $model->periode,
                    'KetTtd' => 'Mengetahui,',
                    'PangkatTtd' => $mengetahui->pangkat->nama,
                    'NamaTtd' => $mengetahui->nama,
                    'JabatanTtd' => $mengetahui->jabatan->nama,
                    'NipTtd' => $mengetahui->nip,
                    'KetTtd1' => Yii::app()->params['kota_perusahaan'] . ", " . date("d F Y"),
                    'PangkatTtd1' => $pembuat->pangkat->nama,
                    'NamaTtd1' => $pembuat->nama,
                    'JabatanTtd1' => $pembuat->jabatan->nama,
                    'NipTtd1' => $pembuat->nip,
                    'Par_SQL' => 'SELECT * FROM tmp_rekapitulasi_penggunaan_galian' . $where,
                );
                if (isset($_POST['type_report'])) {
                    $rep->generateReport($reportId, $_POST['type_report'], $params, $filename);
                } else {
                    $html_report = $rep->generateReport($reportId, WPJasper::FORMAT_HTML, $params, $filename);
                }
            }
        }
        $this->render('penggunaan_galian', array(
            'model' => $model,
            'title' => $title,
            'html_report' => $html_report,
        ));
    }

    public function actionProduksiGalian() {
        $title = Yii::t('trans', 'Laporan Produksi dan Penerimaan Daerah dari Bahan Mineral Bukan Logam Dan Batuan');
        $filename = 'produksi_galian_' . date("d-m-Y_h:i:s-A");
        $model = new JrProduksiGalianForm();
        $model->periode = date('Y');
        $html_report = '';
        if (isset($_POST['JrProduksiGalianForm'])) {
            $model->attributes = $_POST['JrProduksiGalianForm'];
            if ($model->validate()) {
                $filter = array();
                $judul_laporan = 'Laporan Produksi dan Penerimaan Daerah dari Bahan Mineral Bukan Logam Dan Batuan';
                $where = '';
                $filter[] = "session_id='" . session_id() . "'";
                if (isset($model->periode) && trim($model->periode) != "")
                    $filter[] = 'periode=' . $model->periode;
                if (isset($model->bulan_from) && trim($model->bulan_from) != "")
                    $filter[] = 'bulan_from=' . $model->bulan_from;
                if (isset($model->bulan_to) && trim($model->bulan_to) != "")
                    $filter[] = 'bulan_to=' . $model->bulan_to;
                TmpProduksiPenerimaanGalian::model()->generateData($model->periode, $model->bulan_from, $model->bulan_to);

                if (count($filter)) {
                    $where = ' WHERE ' . implode(' AND ', $filter);
                }
                $rep = new WPJasper();
                $reportId = 'produksi_penerimaan_galian';
                $mengetahui = Pejabat::model()->findByPk($model->mengetahui);
                $pembuat = Pejabat::model()->findByPk($model->pembuat);
                $params = array(
                    'JudulLaporan' => $judul_laporan,
                    'SubJudulLaporan' => Yii::t('trans', 'Kabupaten Muara Enim Bulan {bulan_from} s/d {bulan_to} {periode}', array('{bulan_from}' => Yii::app()->locale->getMonthName($model->bulan_from), '{bulan_to}' => Yii::app()->locale->getMonthName($model->bulan_to), '{periode}' => $model->periode)),
                    'Periode' => $model->periode,
                    'KetTtd' => 'Mengetahui,',
                    'PangkatTtd' => $mengetahui->pangkat->nama,
                    'NamaTtd' => $mengetahui->nama,
                    'JabatanTtd' => $mengetahui->jabatan->nama,
                    'NipTtd' => $mengetahui->nip,
                    'KetTtd1' => Yii::app()->params['kota_perusahaan'] . ", " . date("d F Y"),
                    'PangkatTtd1' => $pembuat->pangkat->nama,
                    'NamaTtd1' => $pembuat->nama,
                    'JabatanTtd1' => $pembuat->jabatan->nama,
                    'NipTtd1' => $pembuat->nip,
                    'Par_SQL' => 'SELECT * FROM tmp_produksi_penerimaan_galian' . $where,
                );
                if (isset($_POST['type_report'])) {
                    $rep->generateReport($reportId, $_POST['type_report'], $params, $filename);
                } else {
                    $html_report = $rep->generateReport($reportId, WPJasper::FORMAT_HTML, $params, $filename);
                }
            }
        }
        $this->render('produksi_galian', array(
            'model' => $model,
            'title' => $title,
            'html_report' => $html_report,
        ));
    }

    public function actionBulananGalian() {
        $title = Yii::t('trans', 'Laporan Bulanan Bahan Mineral Bukan Logam Dan Batuan');
        $filename = 'bulanan_galian_' . date("d-m-Y_h:i:s-A");
        $model = new JrBulananGalianForm();
        $model->periode = date('Y');
        $html_report = '';
        if (isset($_POST['JrBulananGalianForm'])) {
            $model->attributes = $_POST['JrBulananGalianForm'];
            if ($model->validate()) {
                $filter = array();
                $judul_laporan = 'Laporan Bulanan Bahan Mineral Bukan Logam Dan Batuan';
                $where = '';
                if (isset($model->periode) && trim($model->periode) != "")
                    $filter[] = 'periode=' . $model->periode;
                if (isset($model->bulan) && trim($model->bulan) != "")
                    $filter[] = "date_part('month', tanggal_bayar)=" . $model->bulan;

                if (count($filter)) {
                    $where = ' WHERE ' . implode(' AND ', $filter);
                }
                $rep = new WPJasper();
                $reportId = 'bulanan_galian';
                $mengetahui = Pejabat::model()->findByPk($model->mengetahui);
                $pembuat = Pejabat::model()->findByPk($model->pembuat);
                $jumlah_bulan_lalu = 0;
                //
                $bulan = $model->bulan - 1;
                if ($bulan == 0) {
                    $periode = $model->periode - 1;
                    $bulan = 12;
                } else
                    $periode = $model->periode;
                $sql = "SELECT sum(jumlah_bayar) as total FROM v_setoran_pajak_galian WHERE periode=$periode AND date_part('month', tanggal_bayar)=$bulan"; //tanggal_bayar < '" . $model->periode . "-" . str_pad($model->bulan, 2, "0", STR_PAD_LEFT) . "-01'";
                $result = Yii::app()->db->createCommand($sql)->queryRow();
                if ($result) {
                    $jumlah_bulan_lalu = $result['total'];
                }
                $params = array(
                    'JudulLaporan' => $judul_laporan,
                    'SubJudulLaporan' => Yii::t('trans', 'Bulan {bulan} Tahun {periode}', array('{bulan}' => Yii::app()->locale->getMonthName($model->bulan), '{periode}' => $model->periode)),
                    'Periode' => $model->periode,
                    'KetTtd' => 'Mengetahui,',
                    'PangkatTtd' => $mengetahui->pangkat->nama,
                    'NamaTtd' => $mengetahui->nama,
                    'JabatanTtd' => $mengetahui->jabatan->nama,
                    'NipTtd' => $mengetahui->nip,
                    'KetTtd1' => Yii::app()->params['kota_perusahaan'] . ", " . date("d F Y"),
                    'PangkatTtd1' => $pembuat->pangkat->nama,
                    'NamaTtd1' => $pembuat->nama,
                    'JabatanTtd1' => $pembuat->jabatan->nama,
                    'NipTtd1' => $pembuat->nip,
                    'JumlahBulanLalu' => $jumlah_bulan_lalu,
                    'Par_SQL' => 'SELECT * FROM v_setoran_pajak_galian' . $where . ' order by tanggal_bayar DESC',
                );
                if (isset($_POST['type_report'])) {
                    $rep->generateReport($reportId, $_POST['type_report'], $params, $filename);
                } else {
                    $html_report = $rep->generateReport($reportId, WPJasper::FORMAT_HTML, $params, $filename);
                }
            }
        }
        $this->render('bulanan_galian', array(
            'model' => $model,
            'title' => $title,
            'html_report' => $html_report,
        ));
    }

    public function actionBpsWalet() {
        $title = Yii::t('trans', 'Laporan Daftar BPS Pajak Walet');
        $filename = 'bps_walet_' . date("d-m-Y_h:i:s-A");
        $model = new JrBpsWaletForm();
        $model->date_from = date("d/m/Y");
        $model->date_to = date("01/m/Y");
        $html_report = '';
        if (isset($_POST['JrBpsWaletForm'])) {
            $model->attributes = $_POST['JrBpsWaletForm'];
            if ($model->validate()) {
                $filter = array();
                $judul_laporan = 'Buku Pembantu Setoran/Penetapan Pajak Reklame';
                $where = '';
                $filter[] = 'kode_rekening_id=' . Spt::PARENT_Reklame;
                if ((isset($model->date_from) && trim($model->date_from) != "") && (isset($model->date_to) && trim($model->date_to) != ""))
                    $filter[] = "tanggal_bayar BETWEEN '" . date("Y-m-d", strtotime(date_format(date_create_from_format('d/m/Y', $model->date_from), "Y-m-d"))) . "' AND '" . date("Y-m-d", strtotime(date_format(date_create_from_format('d/m/Y', $model->date_to), "Y-m-d") . ' +1 day')) . "'";

                if (count($filter)) {
                    $where = ' WHERE ' . implode(' AND ', $filter);
                }
                $rep = new WPJasper();
                $reportId = 'bps_walet';
                $mengetahui = Pejabat::model()->findByPk($model->mengetahui);
                $pembuat = Pejabat::model()->findByPk($model->pembuat);
                $params = array(
                    'JudulLaporan' => $judul_laporan,
                    'SubJudulLaporan' => Yii::t('trans', 'Dari Tanggal {date_from} s/d. {date_to}', array('{date_from}' => $model->date_from, '{date_to}' => $model->date_to)),
                    'KetTtd' => 'Mengetahui,',
                    'PangkatTtd' => $mengetahui->pangkat->nama,
                    'NamaTtd' => $mengetahui->nama,
                    'JabatanTtd' => $mengetahui->jabatan->nama,
                    'NipTtd' => $mengetahui->nip,
                    'KetTtd1' => Yii::app()->params['kota_perusahaan'] . ", " . date("d F Y"),
                    'PangkatTtd1' => $pembuat->pangkat->nama,
                    'NamaTtd1' => $pembuat->nama,
                    'JabatanTtd1' => $pembuat->jabatan->nama,
                    'NipTtd1' => $pembuat->nip,
                    'Par_SQL' => 'SELECT * FROM v_setoran_pajak' . $where . ' order by tanggal_bayar DESC',
                );
                if (isset($_POST['type_report'])) {
                    $rep->generateReport($reportId, $_POST['type_report'], $params, $filename);
                } else {
                    $html_report = $rep->generateReport($reportId, WPJasper::FORMAT_HTML, $params, $filename);
                }
            }
        }
        $this->render('bps_walet', array(
            'model' => $model,
            'title' => $title,
            'html_report' => $html_report,
        ));
    }

    public function actionSpt() {
        $title = Yii::t('trans', 'Laporan Daftar SPT');
        $filename = 'spt_' . date("d-m-Y_h:i:s-A");
        $model = new JrSptForm();
        $model->periode = date('Y');
        $html_report = '';
        if (isset($_POST['JrSptForm'])) {
            $model->attributes = $_POST['JrSptForm'];
            if ($model->validate()) {
                $filter = array();
                $where = '';
                if (isset($model->periode) && trim($model->periode) != "")
                    $filter[] = 'periode=' . $model->periode;
                if (isset($model->nomor_from) && trim($model->nomor_from) != "" && isset($model->nomor_to) && trim($model->nomor_to) != "")
                    $filter[] = 'nomor BETWEEN \'' . $model->nomor_from . '\' AND \'' . $model->nomor_to . '\'';

                if (count($filter)) {
                    $where = ' WHERE ' . implode(' AND ', $filter);
                }
                $rep = new WPJasper();
                $reportId = 'daftar_spt';
                $mengetahui = Pejabat::model()->findByPk($model->mengetahui);
                $diperiksa = Pejabat::model()->findByPk($model->diperiksa);
                $params = array(
                    'JudulLaporan' => 'DAFTAR FORMULIR PENDAFTARAN YANG DIKIRIM/KEMBALI/BELUM KEMBALI WP/WR *)',
                    'SubJudulLaporan' => Yii::t('trans', 'Dari Nomor {nomor_from} s/d. {nomor_to} Periode {periode}', array('{nomor_from}' => $model->nomor_from, '{nomor_to}' => $model->nomor_to, '{periode}' => $model->periode)),
                    'KetTtd' => 'Mengetahui,',
                    'PangkatTtd' => $mengetahui->pangkat->nama,
                    'NamaTtd' => $mengetahui->nama,
                    'JabatanTtd' => $mengetahui->jabatan->nama,
                    'NipTtd' => $mengetahui->nip,
                    'KetTtd1' => 'Diperiksa Oleh,',
                    'PangkatTtd1' => $diperiksa->pangkat->nama,
                    'NamaTtd1' => $diperiksa->nama,
                    'JabatanTtd1' => $diperiksa->jabatan->nama,
                    'NipTtd1' => $diperiksa->nip,
                    'UserName' => Yii::app()->user->nickName,
                    'RoleName' => Yii::app()->user->roleName,
                    'Par_SQL' => 'SELECT * FROM v_daftar_spt' . $where,
                );
                if (isset($_POST['type_report'])) {
                    $rep->generateReport($reportId, $_POST['type_report'], $params, $filename);
                } else {
                    $html_report = $rep->generateReport($reportId, WPJasper::FORMAT_HTML, $params, $filename);
                }
            }
        }
        $this->render('spt', array(
            'model' => $model,
            'title' => $title,
            'html_report' => $html_report,
        ));
    }

}
