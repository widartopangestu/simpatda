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
        $title = Yii::t('trans', 'Cetak Buku Kendali');
        $filename = 'buku_kendali_' . date("d-m-Y_h:i:s-A");
        $model = new BukuKendaliForm();
        $model->tanggal = date('d/m/Y');
        $html_report = '';
        if (isset($_POST['BukuKendaliForm'])) {
            $model->attributes = $_POST['BukuKendaliForm'];
            if ($model->validate()) {
                $filter = array();
                $where = '';
                $judul_laporan = 'BUKU KENDALI';
                if (isset($model->kecamatan_id) && trim($model->kecamatan_id) != "")
                    $filter[] = 'kecamatan_id=' . $model->kecamatan_id;
                if (isset($model->jenis_pajak) && trim($model->jenis_pajak) != "") {
                    $filter[] = 'kode_rekening_id=' . $model->jenis_pajak;
                    $judul_laporan .= ' ' . KodeRekening::model()->findByPk($model->jenis_pajak)->nama;
                }
                if (isset($model->jenis_surat_id) && trim($model->jenis_surat_id) != "")
                    $filter[] = 'jenis_surat_id=' . $model->jenis_surat_id;
                if ((isset($model->date_from) && trim($model->date_from) != "") && (isset($model->date_to) && trim($model->date_to) != ""))
                    $filter[] = "tanggal_penetapan BETWEEN '" . date("Y-m-d", strtotime(date_format(date_create_from_format('d/m/Y', $model->date_from), "Y-m-d"))) . "' AND '" . date("Y-m-d", strtotime(date_format(date_create_from_format('d/m/Y', $model->date_to), "Y-m-d") . ' +1 day')) . "'";

                if (count($filter)) {
                    $where = ' WHERE ' . implode(' AND ', $filter);
                }
                $rep = new WPJasper();
                $reportId = 'buku_kendali';
                $menyetujui = Pejabat::model()->findByPk($model->menyetujui);
                $mengetahui = Pejabat::model()->findByPk($model->mengetahui);
                $diperiksa = Pejabat::model()->findByPk($model->diperiksa);
                $params = array(
                    'JudulLaporan' => $judul_laporan,
                    'SubJudulLaporan' => Yii::t('trans', 'Periode {date_from} s/d. {date_to}', array('{date_from}' => $model->date_from, '{date_to}' => $model->date_to)),
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
                    'Tanggal' => date_format(date_create_from_format('d/m/Y', $model->tanggal), "d F Y"),
                    'Par_SQL' => 'SELECT * FROM v_buku_kendali' . $where,
                );
                if (isset($_POST['type_report'])) {
                    $rep->generateReport($reportId, $_POST['type_report'], $params, $filename);
                } else {
                    $html_report = $rep->generateReport($reportId, WPJasper::FORMAT_HTML, $params, $filename);
                }
            }
        }
        $this->render('buku_kendali', array(
            'model' => $model,
            'title' => $title,
            'html_report' => $html_report,
        ));
    }

    public function actionDaftarTunggakan() {
        $title = Yii::t('trans', 'Cetak Daftar Tunggakan');
        $filename = 'daftar_tunggakan_' . date("d-m-Y_h:i:s-A");
        $model = new BukuKendaliForm();
        $model->tanggal = date('d/m/Y');
        $html_report = '';
        if (isset($_POST['BukuKendaliForm'])) {
            $model->attributes = $_POST['BukuKendaliForm'];
            if ($model->validate()) {
                $filter = array();
                $where = '';
                $judul_laporan = 'BUKU TUNGGAKAN';
                $filter[] = 'jumlah_bayar=0';
                if (isset($model->kecamatan_id) && trim($model->kecamatan_id) != "")
                    $filter[] = 'kecamatan_id=' . $model->kecamatan_id;
                if (isset($model->jenis_pajak) && trim($model->jenis_pajak) != "") {
                    $filter[] = 'kode_rekening_id=' . $model->jenis_pajak;
                    $judul_laporan .= ' ' . KodeRekening::model()->findByPk($model->jenis_pajak)->nama;
                }
                if (isset($model->jenis_surat_id) && trim($model->jenis_surat_id) != "")
                    $filter[] = 'jenis_surat_id=' . $model->jenis_surat_id;
                if ((isset($model->date_from) && trim($model->date_from) != "") && (isset($model->date_to) && trim($model->date_to) != ""))
                    $filter[] = "tanggal_penetapan BETWEEN '" . date("Y-m-d", strtotime(date_format(date_create_from_format('d/m/Y', $model->date_from), "Y-m-d"))) . "' AND '" . date("Y-m-d", strtotime(date_format(date_create_from_format('d/m/Y', $model->date_to), "Y-m-d") . ' +1 day')) . "'";

                if (count($filter)) {
                    $where = ' WHERE ' . implode(' AND ', $filter);
                }
                $rep = new WPJasper();
                $reportId = 'buku_kendali';
                $menyetujui = Pejabat::model()->findByPk($model->menyetujui);
                $mengetahui = Pejabat::model()->findByPk($model->mengetahui);
                $diperiksa = Pejabat::model()->findByPk($model->diperiksa);
                $params = array(
                    'JudulLaporan' => $judul_laporan,
                    'SubJudulLaporan' => Yii::t('trans', 'Periode {date_from} s/d. {date_to}', array('{date_from}' => $model->date_from, '{date_to}' => $model->date_to)),
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
                    'Tanggal' => date_format(date_create_from_format('d/m/Y', $model->tanggal), "d F Y"),
                    'Par_SQL' => 'SELECT * FROM v_buku_kendali' . $where,
                );
                if (isset($_POST['type_report'])) {
                    $rep->generateReport($reportId, $_POST['type_report'], $params, $filename);
                } else {
                    $html_report = $rep->generateReport($reportId, WPJasper::FORMAT_HTML, $params, $filename);
                }
            }
        }
        $this->render('buku_tunggakan', array(
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

}
