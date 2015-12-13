<?php

class WajibPajakController extends Controller {

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
            'WAuth - dynamicKelurahan, jsonNpwpd, jsonGetData',
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        Yii::app()->util->setLog(AccessLog::TYPE_INFO, Yii::t('trans', 'View Wajib Pajak ID : {id}', array('{id}' => $id)));
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate($type = 1) {
        $model = new WajibPajak;
        $model->kabupaten = 'MUARA ENIM';
        $model->golongan = $type;
        $model->nomor = 'AUTO';

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['WajibPajak'])) {
            $model->attributes = $_POST['WajibPajak'];
            if ($model->validate()) {
                if (!empty($model->tanggal_lahir) && $model->tanggal_lahir != '0000-00-00')
                    $model->tanggal_lahir = date_format(date_create_from_format('d/m/Y', $model->tanggal_lahir), "Y-m-d");
                else
                    $model->tanggal_lahir = new CDbExpression('null');
                if (!empty($model->tanggal_tutup) && $model->tanggal_tutup != '0000-00-00')
                    $model->tanggal_tutup = date_format(date_create_from_format('d/m/Y', $model->tanggal_tutup), "Y-m-d");
                else
                    $model->tanggal_tutup = new CDbExpression('null');
                if (!empty($model->kk_tanggal) && $model->kk_tanggal != '0000-00-00')
                    $model->kk_tanggal = date_format(date_create_from_format('d/m/Y', $model->kk_tanggal), "Y-m-d");
                else
                    $model->kk_tanggal = new CDbExpression('null');
                if ($model->save()) {
                    Yii::app()->util->setLog(AccessLog::TYPE_SUCCESS, Yii::t('trans', 'Create Wajib Pajak ID : ') . $model->primaryKey);
                    $this->redirect(array('view', 'id' => $model->id));
                }
            }
        }

        if ($type == 1) {
            $this->render('create_pribadi', array(
                'model' => $model,
            ));
        } else {
            $this->render('create_badan_usaha', array(
                'model' => $model,
            ));
        }
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        $model->tanggal_lahir = date('d/m/Y', strtotime($model->tanggal_lahir));
        $model->tanggal_tutup = date('d/m/Y', strtotime($model->tanggal_tutup));
        $model->kk_tanggal = date('d/m/Y', strtotime($model->kk_tanggal));

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['WajibPajak'])) {
            $model->attributes = $_POST['WajibPajak'];
            if ($model->validate()) {
                if (!empty($model->tanggal_lahir) && $model->tanggal_lahir != '0000-00-00')
                    $model->tanggal_lahir = date_format(date_create_from_format('d/m/Y', $model->tanggal_lahir), "Y-m-d");
                else
                    $model->tanggal_lahir = new CDbExpression('null');
                if (!empty($model->tanggal_tutup) && $model->tanggal_tutup != '0000-00-00')
                    $model->tanggal_tutup = date_format(date_create_from_format('d/m/Y', $model->tanggal_tutup), "Y-m-d");
                else
                    $model->tanggal_tutup = new CDbExpression('null');
                if (!empty($model->kk_tanggal) && $model->kk_tanggal != '0000-00-00')
                    $model->kk_tanggal = date_format(date_create_from_format('d/m/Y', $model->kk_tanggal), "Y-m-d");
                else
                    $model->kk_tanggal = new CDbExpression('null');
                if ($model->save()) {
                    Yii::app()->util->setLog(AccessLog::TYPE_SUCCESS, Yii::t('trans', 'Update Wajib Pajak ID : ') . $model->id);
                    $this->redirect(array('view', 'id' => $model->id));
                }
            }
        }

        if ($model->golongan == 1) {
            $this->render('update_pribadi', array(
                'model' => $model,
            ));
        } else {
            $this->render('update_badan_usaha', array(
                'model' => $model,
            ));
        }
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
                    Yii::app()->util->setLog(AccessLog::TYPE_SUCCESS, Yii::t('trans', 'Delete Wajib Pajak ID : ') . $id);
            } catch (CDbException $exc) {
                throw new CHttpException(500, Yii::t('trans', 'Delete Wajib Pajak ID : {id}. Item ini sudah dipakai pada transaksi', array('{id}' => $id)));
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
    public function actionIndex($type = NULL) {
        $model = new WajibPajak('search');
        $model->unsetAttributes();  // clear any default values
        if($type !== NULL){
            $model->golongan = $type;
        }
        if (isset($_GET['WajibPajak'])) {
            $model->attributes = $_GET['WajibPajak'];
        }

        if (isset($_GET['pageSize'])) {
            Yii::app()->user->setState('pageSize' . $model->tableName(), (int) $_GET['pageSize']);
            unset($_GET['pageSize']);  // would interfere with pager and repetitive page size change
        }
        Yii::app()->util->setLog(AccessLog::TYPE_INFO, Yii::t('trans', 'Manage Wajib Pajak'));

        $this->render('index', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return WajibPajak the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = WajibPajak::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, Yii::t('trans', 'The requested page does not exist.'));
        }
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param WajibPajak $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'wajib-pajak-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionDynamicKelurahan() {
        $data = CHtml::listData(Kelurahan::model()->findAll('kecamatan_id=:kecamatan_id', array(':kecamatan_id' => (int) $_POST['WajibPajak']['kecamatan_id'])), 'id', 'kodeNama');
        echo CHtml::tag('option', array('value' => ''), Yii::t('trans', '- Pilih Kelurahan -'), true);
        foreach ($data as $value => $name) {
            echo CHtml::tag('option', array('value' => $value), CHtml::encode($name), true);
        }
    }

    public function actionPrintNpwpd($id, $type_report = WPJasper::FORMAT_PDF) {
        $model = $this->loadModel($id);
        $pejabat = Pejabat::model()->findByPk(Yii::app()->params['ttd_kartu_npwpd_pejabat']);
        $filename = 'KartuNPWPD_' . $model->nomor . '_' . date("d-m-Y_h:i:s-A");
        $title = Yii::t('trans', 'Kartu NPWPD');
        Yii::app()->util->setLog(AccessLog::TYPE_SUCCESS, Yii::t('trans', 'Print {title} To {ext} > \'filename\' : {filename}', array('{title}' => $title, '{ext}' => strtoupper($type_report), '{filename}' => $filename)));

        $rep = new WPJasper();
        $reportId = 'kartu_npwpd';
        $params = array(
            'JudulLaporan' => 'KARTU PENGENAL NPWPD',
            'SubJudulLaporan' => 'No Reg. : ADM/' . $model->nomor . date('/m/Y'),
            'ParSQL' => 'select * from v_wajib_pajak where id = ' . $model->id,
            'JudulTtd' => 'a.n Bupati Muara Enim Kepala DISPENDA',
            'KetTtd' => Yii::app()->params['kota_perusahaan'] . ", " . date('d F Y'),
            'NamaTtd' => $pejabat->nama,
            'JabatanTtd' => $pejabat->jabatan->nama,
            'NipTtd' => $pejabat->nip,
        );
        $rep->generateReport($reportId, $type_report, $params, $filename);
    }

    public function actionTutup() {
        $model = new TutupWajibPajakForm();
        $model->tanggal_tutup = date('d/m/Y');

        if (isset($_POST['TutupWajibPajakForm'])) {
            $model->attributes = $_POST['TutupWajibPajakForm'];
            if ($model->validate()) {
                if (!empty($model->tanggal_tutup) && $model->tanggal_tutup != '0000-00-00')
                    $model->tanggal_tutup = date_format(date_create_from_format('d/m/Y', $model->tanggal_tutup), "Y-m-d");
                else
                    $model->tanggal_tutup = new CDbExpression('null');
                $wp = $this->loadModel($model->wajib_pajak_id);
                $wp->nomer_berita_acara = $model->no_ba;
                $wp->isi_berita_acara = $model->isi_ba;
                $wp->tanggal_tutup = $model->tanggal_tutup;
                $wp->status = WajibPajak::STATUS_NOACTIVE;
                if ($wp->save(false)) {
                    Yii::app()->util->setLog(AccessLog::TYPE_SUCCESS, Yii::t('trans', 'Tutup Wajib Pajak ID : ') . $model->wajib_pajak_id);
                    $this->redirect(array('view', 'id' => $model->wajib_pajak_id));
                }
            }
        }
        $this->render('tutup', array(
            'model' => $model,
        ));
    }

    public function actionJsonNpwpd($jenis = 'p') {
        $q = isset($_REQUEST['q']) ? $_REQUEST['q'] : '';
        //query not in akan memakan waktu lama jika data banyak
        $where = '';
        if ($q !== '') {
            $where .= "AND (npwpd ILIKE '%$q%' OR nama ILIKE '%$q%')";
        }
        $sql = "SELECT id, npwpd, nama FROM v_wajib_pajak WHERE jenis='$jenis' AND status=TRUE $where LIMIT 20";
        $result = Yii::app()->db->createCommand($sql)->queryAll();
        $data = array();
        foreach ($result as $item) {
            $data[] = array(
                'id' => $item['id'],
                'text' => $item['npwpd'] . ' ' . $item['nama']
            );
        }
        echo CJSON::encode($data);
    }

    public function actionJsonGetData($id = null) {
        if ($id != null) {
            $sql = "SELECT id, nama, alamat, kabupaten, kecamatan, kelurahan FROM v_wajib_pajak WHERE id=$id";
            $result = Yii::app()->db->createCommand($sql)->queryRow();
            echo CJSON::encode($result);
        } else
            echo CJSON::encode(array());
    }

}
