<?php

class PemeriksaanController extends Controller {

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
            'WAuth - jsonGetSetoran, ajaxGetValue, grid',
        );
    }

    public function actionJsonGetSetoran($id) {
        $sql = "SELECT a.spt_id, b.kode_rekening_id, b.periode_awal, b.periode_akhir, e.jumlah_bayar AS setoran, a.tanggal_jatuh_tempo FROM setoran_pajak e
	JOIN penetapan a ON e.penetapan_id = a.id
	JOIN spt b ON a.spt_id = b.id WHERE e.id=" . $id;
        $result = Yii::app()->db->createCommand($sql)->queryRow();

        echo CJSON::encode(array(
            'spt_id' => $result['spt_id'],
            'kode_rekening_id' => $result['kode_rekening_id'],
            'tanggal_jatuh_tempo' => $result['tanggal_jatuh_tempo'],
            'periode_awal' => date('d/m/Y', strtotime($result['periode_awal'])),
            'periode_akhir' => date('d/m/Y', strtotime($result['periode_awal'])),
            'setoran' => number_format($result['setoran'], Yii::app()->params['currency_precision']),
        ));
    }

    public function actionAjaxGetValue() {
        $model = new Pemeriksaan;
        if (isset($_POST['Pemeriksaan']) && isset($_POST['items'])) {
            $model->attributes = $_POST['Pemeriksaan'];
            $model->nilai_pajak = ($model->nilai_pajak != '') ? doubleval(str_replace(',', '', $model->nilai_pajak)) : 0;
            $items = $_POST['items'];
            $data = array();
            $sum_pajak = 0;
            foreach ($items as $key => $item) {
                if ($key !== 'x') {
                    $terhutang = (int) $item['terhutang'];
                    $kompensasi = (int) $item['kompensasi'];
                    $kredit_lain = (int) $item['kredit_lain'];
                    $kenaikan = (int) $item['kenaikan'];
                    $setoran = (int) str_replace(',', '', $item['setoran']);
                    $total_kredit = $setoran + $kompensasi + $kredit_lain;
                    $pajak = $terhutang - $total_kredit;
                    $date1 = date_create_from_format('Y-m-d', $item['tanggal_jatuh_tempo']);
                    $date2 = date_create_from_format('d/m/Y', $model->tanggal);
                    $interval = date_diff($date1, $date2);
                    $bulan = 0;
                    if (version_compare(strtotime(date_format(date_create_from_format('d/m/Y', $model->tanggal), "Y-m-d")), strtotime($item['tanggal_jatuh_tempo']), ">"))
                        $bulan = $interval->m + ($interval->y * 12) + ($interval->d > 0 ? 1 : 0);
                    $persen_denda = 2 / 100;
                    $bunga = $bulan * $persen_denda * $pajak;
                    $total_sanksi = $bunga + $kenaikan;
                    $total = $pajak + $total_sanksi;
                    $data['items_' . $key . 'xsetoran'] = number_format($setoran, Yii::app()->params['currency_precision']);
                    $data['items_' . $key . 'xtotal_kredit'] = number_format($total_kredit, Yii::app()->params['currency_precision']);
                    $data['items_' . $key . 'xpajak'] = number_format($pajak, Yii::app()->params['currency_precision']);
                    $data['items_' . $key . 'xbunga'] = number_format($bunga, Yii::app()->params['currency_precision']);
                    $data['items_' . $key . 'xtotal_sanksi'] = number_format($total_sanksi, Yii::app()->params['currency_precision']);
                    $data['items_' . $key . 'xtotal'] = number_format($total, Yii::app()->params['currency_precision']);
                    $sum_pajak += $total;
                }
            }
            $model->nilai_pajak = $sum_pajak;
        }
        $rest = CMap::mergeArray(
                        $data, array(
                    'nilai_pajak' => number_format($model->nilai_pajak, Yii::app()->params['currency_precision'])
        ));
        echo CJSON::encode($rest);
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Pemeriksaan;
        $model->nomor = 'AUTO';
        $model->periode = date('Y');
        $model->tanggal = date('d/m/Y');

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Pemeriksaan']) && isset($_POST['items'])) {
            $transaction = Yii::app()->db->beginTransaction();
            $flag = true;
            $model->attributes = $_POST['Pemeriksaan'];
            $model->nilai_pajak = str_replace(',', '', $model->nilai_pajak);
            if ($model->validate()) {
                if (!empty($model->tanggal) && $model->tanggal != '0000-00-00')
                    $model->tanggal = date_format(date_create_from_format('d/m/Y', $model->tanggal), "Y-m-d");
                else
                    $model->tanggal = new CDbExpression('null');
                $flag = $model->save() && $flag;
                foreach ($_POST['items'] as $item) {
                    $model_item = new PemeriksaanItem;
                    $model_item->periode_awal = date_format(date_create_from_format('d/m/Y', $item['periode_awal']), "Y-m-d");
                    $model_item->periode_akhir = date_format(date_create_from_format('d/m/Y', $item['periode_akhir']), "Y-m-d");
                    $model_item->kompensasi = str_replace(',', '', $item['kompensasi']);
                    $model_item->setoran = str_replace(',', '', $item['setoran']);
                    $model_item->kredit_lain = str_replace(',', '', $item['kredit_lain']);
                    $model_item->bunga = str_replace(',', '', $item['bunga']);
                    $model_item->kenaikan = str_replace(',', '', $item['kenaikan']);
                    $model_item->terhutang = str_replace(',', '', $item['terhutang']);
                    $model_item->total = str_replace(',', '', $item['total']);
                    $model_item->spt_id = $item['spt_id'];
                    $model_item->kode_rekening_id = $item['kode_rekening_id'];
                    $model_item->pemeriksaan_id = $model->primaryKey;
                    $flag = $model_item->save() && $flag;
                }
            } else {
                $flag = false;
            }
            if ($flag) {
                $transaction->commit();
                Yii::app()->util->setLog(AccessLog::TYPE_SUCCESS, Yii::t('trans', 'Create Laporan Hasil Pemeriksaan (LHP) ID : ') . $model->primaryKey);
                $this->redirect(array('create'));
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        $model->tanggal = date('d/m/Y', strtotime($model->tanggal));

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Pemeriksaan']) && isset($_POST['items'])) {
            $transaction = Yii::app()->db->beginTransaction();
            $flag = true;
            $model->attributes = $_POST['Pemeriksaan'];
            $model->nilai_pajak = str_replace(',', '', $model->nilai_pajak);
            if ($model->validate()) {
                if (!empty($model->tanggal) && $model->tanggal != '0000-00-00')
                    $model->tanggal = date_format(date_create_from_format('d/m/Y', $model->tanggal), "Y-m-d");
                else
                    $model->tanggal = new CDbExpression('null');
                $flag = $model->save() && $flag;
                foreach ($_POST['items'] as $item) {
                    if (!empty($item['items_id']))
                        $model_item = PemeriksaanItem::model()->findByPk($item['items_id']);
                    else {
                        $model_item = new PemeriksaanItem;
                        $model_item->pemeriksaan_id = $model->id;
                    }
                    $model_item->periode_awal = date_format(date_create_from_format('d/m/Y', $item['periode_awal']), "Y-m-d");
                    $model_item->periode_akhir = date_format(date_create_from_format('d/m/Y', $item['periode_akhir']), "Y-m-d");
                    $model_item->kompensasi = str_replace(',', '', $item['kompensasi']);
                    $model_item->setoran = str_replace(',', '', $item['setoran']);
                    $model_item->kredit_lain = str_replace(',', '', $item['kredit_lain']);
                    $model_item->bunga = str_replace(',', '', $item['bunga']);
                    $model_item->kenaikan = str_replace(',', '', $item['kenaikan']);
                    $model_item->terhutang = str_replace(',', '', $item['terhutang']);
                    $model_item->total = str_replace(',', '', $item['total']);
                    $model_item->spt_id = $item['spt_id'];
                    $model_item->kode_rekening_id = $item['kode_rekening_id'];
                    $flag = $model_item->save() && $flag;
                }
            } else {
                $flag = false;
            }
            if ($flag) {
                $transaction->commit();
                Yii::app()->util->setLog(AccessLog::TYPE_SUCCESS, Yii::t('trans', 'Update Laporan Hasil Pemeriksaan (LHP) ID : ') . $model->id);
                $this->redirect(array('index'));
            }
        }

        $this->render('update', array(
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
                    Yii::app()->util->setLog(AccessLog::TYPE_SUCCESS, Yii::t('trans', 'Delete Laporan Hasil Pemeriksaan (LHP) ID : ') . $id);
            } catch (CDbException $exc) {
                throw new CHttpException(500, Yii::t('trans', 'Delete Laporan Hasil Pemeriksaan (LHP) ID : {id}. Item ini sudah dipakai pada transaksi', array('{id}' => $id)));
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
        $model = new Pemeriksaan('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Pemeriksaan'])) {
            $model->attributes = $_GET['Pemeriksaan'];
        }

        if (isset($_GET['pageSize'])) {
            Yii::app()->user->setState('pageSize' . $model->tableName(), (int) $_GET['pageSize']);
            unset($_GET['pageSize']);  // would interfere with pager and repetitive page size change
        }
        Yii::app()->util->setLog(AccessLog::TYPE_INFO, Yii::t('trans', 'Manage Laporan Hasil Pemeriksaan (LHP)'));

        $this->render('index', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Pemeriksaan the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Pemeriksaan::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, Yii::t('trans', 'The requested page does not exist.'));
        }
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Pemeriksaan $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'pemeriksaan-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionGrid($id, $idx) {
        $this->layout = '//layouts/modal';
        $model = new SetoranPajak('search');
        $model->unsetAttributes();  // clear any default values
        $criteria = new CDbCriteria();
        $criteria->join = "JOIN penetapan a ON t.penetapan_id = a.id
                        JOIN spt b ON a.spt_id = b.id
                        JOIN v_wajib_pajak c ON b.wajib_pajak_id = c.id
                        JOIN jenis_surat d ON a.jenis_surat_id = d.id";
        $criteria->condition = "t.penetapan_id NOT IN (SELECT penetapan_id FROM pemeriksaan_item) AND a.jenis_surat_id = 8 AND b.wajib_pajak_id=$id";
        $model->setDbCriteria($criteria);
        if (isset($_GET['SetoranPajak'])) {
            $model->attributes = $_GET['SetoranPajak'];
        }
        $this->render('grid', array(
            'model' => $model,
            'id_selector' => $idx,
        ));
    }

}
