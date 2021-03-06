<?php

class PenetapanController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column1';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'WAuth - jsonKohir',
        );
    }

    public function actionPajak() {
        $model = new PenetapanForm;
        $model->periode = date('Y');
        $model->tanggal_penetapan = date('d/m/Y');

        if (isset($_POST['PenetapanForm'])) {
            $transaction = Yii::app()->db->beginTransaction();
            $flag = true;
            $model->attributes = $_POST['PenetapanForm'];
            $sum_penetapan = 0;
            if ($model->validate()) {
                if (!empty($model->tanggal_penetapan) && $model->tanggal_penetapan != '0000-00-00')
                    $model->tanggal_penetapan = date_format(date_create_from_format('d/m/Y', $model->tanggal_penetapan), "Y-m-d");
                else
                    $model->tanggal_penetapan = new CDbExpression('null');

                $spts = Spt::model()->findAll("periode=$model->periode AND nomor BETWEEN $model->spt_from AND $model->spt_to");
                foreach ($spts as $spt) {
                    $check = Penetapan::model()->find("spt_id=$spt->id");
                    if ($check == null) {
                        $penetapan = new Penetapan;
                        $penetapan->tanggal_penetapan = $model->tanggal_penetapan;
                        $penetapan->tanggal_jatuh_tempo = date('Y-m-d', strtotime("+" . Yii::app()->params['hari_jatuh_tempo'] . " day", strtotime($model->tanggal_penetapan)));
                        $penetapan->spt_id = $spt->id;
                        $penetapan->jenis_surat_id = $spt->jenis_surat_id;
                        $flag = $penetapan->save() && $flag;
                        $sum_penetapan++;
                    }
                }
            } else {
                $flag = false;
            }
            if ($flag) {
                $transaction->commit();
                Yii::app()->util->setLog(AccessLog::TYPE_SUCCESS, Yii::t('trans', 'Create Penetapan dari nomor {spt_from} s/d. {spt_to}. ({sum_penetapan}) Penetapan terbuat.', array('{sum_penetapan}' => $sum_penetapan, '{spt_from}' => $_POST['PenetapanForm']['spt_from'], '{spt_to}' => $_POST['PenetapanForm']['spt_to'])));
                $this->redirect(array('pajak'));
            }
        }

        $this->render('pajak', array(
            'model' => $model,
        ));
    }

    public function actionLhp() {
        $model = new PenetapanLhpForm;
        $model->periode = date('Y');
        $model->tanggal_penetapan = date('d/m/Y');

        if (isset($_POST['PenetapanLhpForm'])) {
            $transaction = Yii::app()->db->beginTransaction();
            $flag = true;
            $model->attributes = $_POST['PenetapanLhpForm'];
            $sum_penetapan = 0;
            if ($model->validate()) {
                if (!empty($model->tanggal_penetapan) && $model->tanggal_penetapan != '0000-00-00')
                    $model->tanggal_penetapan = date_format(date_create_from_format('d/m/Y', $model->tanggal_penetapan), "Y-m-d");
                else
                    $model->tanggal_penetapan = new CDbExpression('null');

                $pemeriksaans = Pemeriksaan::model()->findAll("periode=$model->periode AND nomor BETWEEN $model->pemeriksaan_from AND $model->pemeriksaan_to");
                foreach ($pemeriksaans as $pemeriksaan) {
                    $check = Penetapan::model()->find("pemeriksaan_id=$pemeriksaan->id");
                    if ($check == null) {
                        $penetapan = new Penetapan;
                        $penetapan->tanggal_penetapan = $model->tanggal_penetapan;
                        $penetapan->tanggal_jatuh_tempo = date('Y-m-d', strtotime("+" . Yii::app()->params['hari_jatuh_tempo'] . " day", strtotime($model->tanggal_penetapan)));
                        $penetapan->pemeriksaan_id = $pemeriksaan->id;
                        $penetapan->jenis_surat_id = 11; //SKPDKB
                        $flag = $penetapan->save() && $flag;
                        $sum_penetapan++;
                    }
                }
            } else {
                $flag = false;
            }
            if ($flag) {
                $transaction->commit();
                Yii::app()->util->setLog(AccessLog::TYPE_SUCCESS, Yii::t('trans', 'Create Penetapan LHP dari nomor {pemeriksaan_from} s/d. {pemeriksaan_to}. ({sum_penetapan}) Penetapan terbuat.', array('{sum_penetapan}' => $sum_penetapan, '{pemeriksaan_from}' => $_POST['PenetapanLhpForm']['pemeriksaan_from'], '{pemeriksaan_to}' => $_POST['PenetapanLhpForm']['pemeriksaan_to'])));
                $this->redirect(array('lhp'));
            }
        }

        $this->render('lhp', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            try {
                if ($this->loadModel($id)->delete())
                    Yii::app()->util->setLog(AccessLog::TYPE_SUCCESS, Yii::t('trans', 'Delete Penetapan ID : ') . $id);
            } catch (CDbException $exc) {
                throw new CHttpException(500, Yii::t('trans', 'Delete Penetapan ID : {id}. Item ini sudah dipakai pada transaksi', array('{id}' => $id)));
            }
            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax'])) {
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
            }
        } else {
            throw new CHttpException(400, Yii::t('trans', 'Invalid request. Please do not repeat this request again.'));
        }
    }

    /**
     * Manages all models.
     */
    public function actionIndex() {
        $model = new Penetapan('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Penetapan'])) {
            $model->attributes = $_GET['Penetapan'];
        }

        if (isset($_GET['pageSize'])) {
            Yii::app()->user->setState('pageSize' . $model->tableName(), (int) $_GET['pageSize']);
            unset($_GET['pageSize']);  // would interfere with pager and repetitive page size change
        }
        Yii::app()->util->setLog(AccessLog::TYPE_INFO, Yii::t('trans', 'Manage Penetapan'));

        $this->render('index', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Penetapan the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Penetapan::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, Yii::t('trans', 'The requested page does not exist.'));
        }
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Penetapan $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'penetapan-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionJsonKohir() {
        $q = isset($_REQUEST['q']) ? $_REQUEST['q'] : '';
        $periode = '';
        $surat = '';
        if (strpos($q, ' ')) {
            $tmp = explode(' ', $q);
            $q = $tmp[0];
            $periode = isset($tmp[1]) ? $tmp[1] : $periode;
            $surat = isset($tmp[2]) ? $tmp[2] : $surat;
        }
        $where = '';
        if ($q !== '') {
            $where .= "WHERE a.kohir::text ILIKE '%$q%'";
            if ($periode !== '') {
                $where .= " AND date_part('year', a.tanggal_penetapan)=$periode";
                if ($surat !== '') {
                    $where .= " AND b.singkatan::text ILIKE '%$surat%'";
                }
            }
        }
        $sql = "SELECT a.id, a.kohir, date_part('year', a.tanggal_penetapan) AS periode, b.nama AS nama_jenis_surat, b.kode AS kode_jenis_surat, b.singkatan AS singkatan_jenis_surat FROM penetapan a JOIN jenis_surat b ON a.jenis_surat_id = b.id $where AND jenis_surat_id NOT IN (3) ORDER BY kohir LIMIT 10";
        $result = Yii::app()->db->createCommand($sql)->queryAll();
        $data = array();
        foreach ($result as $item) {
            $data[] = array(
                'id' => $item['id'],
                'text' => $item['kohir'] . ' ' . $item['periode'] . ' ' . $item['singkatan_jenis_surat']
            );
        }
        echo CJSON::encode($data);
    }

    public function actionCetakNotaPerhitungan() {
        $title = Yii::t('trans', 'Cetak Nota Perhitungan');
        $filename = 'nota_perhitungan_' . date("d-m-Y_h:i:s-A");
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
                $reportId = 'nota_perhitungan';
                $mengetahui = Pejabat::model()->findByPk($model->mengetahui);
                $diperiksa = Pejabat::model()->findByPk($model->diperiksa);
                $params = array(
                    'JudulLaporan' => 'NOTA PERHITUNGAN PAJAK DAERAH',
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
                    'Par_SQL' => 'SELECT id FROM spt' . $where,
                );
                if (isset($_POST['type_report'])) {
                    $rep->generateReport($reportId, $_POST['type_report'], $params, $filename);
                } else {
                    $html_report = $rep->generateReport($reportId, WPJasper::FORMAT_HTML, $params, $filename);
                }
            }
        }
        $this->render('nota_perhitungan', array(
            'model' => $model,
            'title' => $title,
            'html_report' => $html_report,
        ));
    }

    public function actionCetakDaftarPenetapan() {
        $title = Yii::t('trans', 'Cetak Daftar Surat Ketetapan');
        $filename = 'surat_ketetapan_' . date("d-m-Y_h:i:s-A");
        $model = new SuratKetetapanForm();
        $model->tanggal = date('d/m/Y');
        $html_report = '';
        if (isset($_POST['SuratKetetapanForm'])) {
            $model->attributes = $_POST['SuratKetetapanForm'];
            if ($model->validate()) {
                $filter = array();
                $order = array('nama_kecamatan');
                $where = '';
                $sort = '';
                $judul_laporan = 'Daftar';
                if (isset($model->sort_by) && trim($model->sort_by) != "")
                    $order[] = $model->sort_by;
                if (isset($model->kecamatan_id) && trim($model->kecamatan_id) != "")
                    $filter[] = 'kecamatan_id=' . $model->kecamatan_id;
                if (isset($model->jenis_pajak) && trim($model->jenis_pajak) != "")
                    $filter[] = 'kode_rekening_id=' . $model->jenis_pajak;
                if (isset($model->jenis_surat_id) && trim($model->jenis_surat_id) != "") {
                    $filter[] = 'jenis_surat_id=' . $model->jenis_surat_id;
                    $judul_laporan .= ' ' . $model->jenisSuratText;
                }
                if ((isset($model->date_from) && trim($model->date_from) != "") && (isset($model->date_to) && trim($model->date_to) != ""))
                    $filter[] = "tanggal_penetapan BETWEEN '" . date("Y-m-d", strtotime(date_format(date_create_from_format('d/m/Y', $model->date_from), "Y-m-d"))) . "' AND '" . date("Y-m-d", strtotime(date_format(date_create_from_format('d/m/Y', $model->date_to), "Y-m-d") . ' +1 day')) . "'";

                if (count($filter)) {
                    $where = ' WHERE ' . implode(' AND ', $filter);
                }
                if (count($order)) {
                    $sort = ' ORDER BY ' . implode(', ', $order);
                }
                $rep = new WPJasper();
                $reportId = 'daftar_surat_ketetapan';
                $menyetujui = Pejabat::model()->findByPk($model->menyetujui);
                $mengetahui = Pejabat::model()->findByPk($model->mengetahui);
                $diperiksa = Pejabat::model()->findByPk($model->diperiksa);
                $params = array(
                    'JudulLaporan' => $judul_laporan,
                    'SubJudulLaporan' => Yii::t('trans', '{date_from} s/d. {date_to}', array('{date_from}' => $model->date_from, '{date_to}' => $model->date_to)),
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
                    'NamaRekening' => $model->kodeRekeningText,
                    'Tanggal' => date_format(date_create_from_format('d/m/Y', $model->tanggal), "d F Y"),
                    'Par_SQL' => 'SELECT * FROM v_buku_kendali' . $where . $sort,
                );
                if (isset($_POST['type_report'])) {
                    $rep->generateReport($reportId, $_POST['type_report'], $params, $filename);
                } else {
                    $html_report = $rep->generateReport($reportId, WPJasper::FORMAT_HTML, $params, $filename);
                }
            }
        }
        $this->render('surat_ketetapan', array(
            'model' => $model,
            'title' => $title,
            'html_report' => $html_report,
        ));
    }

    public function actionCetakPenetapan() {
        
    }

}
