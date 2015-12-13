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
        $sql = "SELECT e.id, a.spt_id, b.kode_rekening_id, b.periode_awal, b.periode_akhir, e.jumlah_bayar AS setoran, a.tanggal_jatuh_tempo FROM setoran_pajak e
	JOIN penetapan a ON e.penetapan_id = a.id
	JOIN spt b ON a.spt_id = b.id WHERE e.id=" . $id;
        $result = Yii::app()->db->createCommand($sql)->queryRow();

        echo CJSON::encode(array(
            'spt_id' => $result['spt_id'],
            'setoran_pajak_id' => $result['id'],
            'kode_rekening_id' => $result['kode_rekening_id'],
            'tanggal_jatuh_tempo' => $result['tanggal_jatuh_tempo'],
            'periode_awal' => date('d/m/Y', strtotime($result['periode_awal'])),
            'periode_akhir' => date('d/m/Y', strtotime($result['periode_awal'])),
            'setoran' => number_format($result['setoran'], Yii::app()->params['currency_precision']),
        ));
    }

    public function actionAjaxGetValue() {
        $model = new Pemeriksaan;
        if (isset($_POST['Pemeriksaan'])) {
            $model->attributes = $_POST['Pemeriksaan'];
            $model->nilai_pajak = ($model->nilai_pajak != '') ? doubleval(str_replace(',', '', $model->nilai_pajak)) : 0;
            $data = array();
            $terhutang = (float) $model->terhutang;
            $kompensasi = (float) $model->kompensasi;
            $kredit_lain = (float) $model->kredit_lain;
            $kenaikan = (float) $model->kenaikan;
            $setoran = (float) str_replace(',', '', $model->setoran);
            $total_kredit = $setoran + $kompensasi + $kredit_lain;
            $pajak = $terhutang - $total_kredit;
            $date1 = date_create_from_format('Y-m-d', $model->tanggal_jatuh_tempo);
            $date2 = date_create_from_format('d/m/Y', $model->tanggal);
            $interval = date_diff($date1, $date2);
            $bulan = 0;
            if (version_compare(strtotime(date_format(date_create_from_format('d/m/Y', $model->tanggal), "Y-m-d")), strtotime($model->tanggal_jatuh_tempo), ">"))
                $bulan = $interval->m + ($interval->y * 12) + ($interval->d > 0 ? 1 : 0);
            $persen_denda = 2 / 100;
            $bunga = $bulan * $persen_denda * $pajak;
            $total_sanksi = $bunga + $kenaikan;
            $total = $pajak + $total_sanksi;
            $data['Pemeriksaan_setoran'] = number_format($setoran, Yii::app()->params['currency_precision']);
            $data['Pemeriksaan_total_kredit'] = number_format($total_kredit, Yii::app()->params['currency_precision']);
            $data['Pemeriksaan_pajak'] = number_format($pajak, Yii::app()->params['currency_precision']);
            $data['Pemeriksaan_bunga'] = number_format($bunga, Yii::app()->params['currency_precision']);
            $data['Pemeriksaan_total_sanksi'] = number_format($total_sanksi, Yii::app()->params['currency_precision']);
            $data['Pemeriksaan_total'] = number_format($total, Yii::app()->params['currency_precision']);
            $data['Pemeriksaan_nilai_pajak'] = number_format($total, Yii::app()->params['currency_precision']);
        }
        echo CJSON::encode($data);
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

        if (isset($_POST['Pemeriksaan'])) {
            $transaction = Yii::app()->db->beginTransaction();
            $flag = true;
            $model->attributes = $_POST['Pemeriksaan'];
            $model->nilai_pajak = str_replace(',', '', $model->nilai_pajak);
            $model->kompensasi = str_replace(',', '', $model->kompensasi);
            $model->setoran = str_replace(',', '', $model->setoran);
            $model->kredit_lain = str_replace(',', '', $model->kredit_lain);
            $model->bunga = str_replace(',', '', $model->bunga);
            $model->kenaikan = str_replace(',', '', $model->kenaikan);
            $model->terhutang = str_replace(',', '', $model->terhutang);
            $model->total = str_replace(',', '', $model->total);
            if ($model->validate()) {
                if (!empty($model->tanggal) && $model->tanggal != '0000-00-00')
                    $model->tanggal = date_format(date_create_from_format('d/m/Y', $model->tanggal), "Y-m-d");
                else
                    $model->tanggal = new CDbExpression('null');
                if (!empty($model->periode_awal) && $model->periode_awal != '0000-00-00')
                    $model->periode_awal = date_format(date_create_from_format('d/m/Y', $model->periode_awal), "Y-m-d");
                else
                    $model->periode_awal = new CDbExpression('null');
                if (!empty($model->periode_akhir) && $model->periode_akhir != '0000-00-00')
                    $model->periode_akhir = date_format(date_create_from_format('d/m/Y', $model->periode_akhir), "Y-m-d");
                else
                    $model->periode_akhir = new CDbExpression('null');
                $flag = $model->save() && $flag;
                $setoran = SetoranPajak::model()->findByPk($model->setoran_pajak_id);
                $setoran->pemeriksaan_id = $model->primaryKey;
                $flag = $setoran->update() && $flag;
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
        $check = Penetapan::model()->findByAttributes(array('pemeriksaan_id' => $id));
        if ($check !== null) {
            Yii::app()->util->setLog(AccessLog::TYPE_ERROR, Yii::t('trans', 'Tidak bisa Update Laporan Hasil Pemeriksaan (LHP) ID : {id}. LHP sudah ditetapkan. ', array('{id}' => $id)));
            $this->redirect(array('index'));
        }
        $model = $this->loadModel($id);
        $model->tanggal = date('d/m/Y', strtotime($model->tanggal));
        $model->periode_awal = date('d/m/Y', strtotime($model->periode_awal));
        $model->periode_akhir = date('d/m/Y', strtotime($model->periode_akhir));
        $old_setoran_pajak_id = SetoranPajak::model()->findByAttributes(array('pemeriksaan_id' => $model->id))->id;
        $model->setoran_pajak_id = $old_setoran_pajak_id;
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Pemeriksaan'])) {
            $transaction = Yii::app()->db->beginTransaction();
            $flag = true;
            $model->attributes = $_POST['Pemeriksaan'];
            $model->nilai_pajak = str_replace(',', '', $model->nilai_pajak);
            $model->kompensasi = str_replace(',', '', $model->kompensasi);
            $model->setoran = str_replace(',', '', $model->setoran);
            $model->kredit_lain = str_replace(',', '', $model->kredit_lain);
            $model->bunga = str_replace(',', '', $model->bunga);
            $model->kenaikan = str_replace(',', '', $model->kenaikan);
            $model->terhutang = str_replace(',', '', $model->terhutang);
            $model->total = str_replace(',', '', $model->total);
            if ($model->validate()) {
                if (!empty($model->tanggal) && $model->tanggal != '0000-00-00')
                    $model->tanggal = date_format(date_create_from_format('d/m/Y', $model->tanggal), "Y-m-d");
                else
                    $model->tanggal = new CDbExpression('null');
                if (!empty($model->periode_awal) && $model->periode_awal != '0000-00-00')
                    $model->periode_awal = date_format(date_create_from_format('d/m/Y', $model->periode_awal), "Y-m-d");
                else
                    $model->periode_awal = new CDbExpression('null');
                if (!empty($model->periode_akhir) && $model->periode_akhir != '0000-00-00')
                    $model->periode_akhir = date_format(date_create_from_format('d/m/Y', $model->periode_akhir), "Y-m-d");
                else
                    $model->periode_akhir = new CDbExpression('null');
                $flag = $model->save() && $flag;
                if ($model->setoran_pajak_id !== $old_setoran_pajak_id) {
                    $old_setoran = SetoranPajak::model()->findByPk($old_setoran_pajak_id);
                    $old_setoran->pemeriksaan_id = new CDbExpression('null');
                    $flag = $old_setoran->update() && $flag;
                } else {
                    $setoran = SetoranPajak::model()->findByPk($model->setoran_pajak_id);
                    $setoran->pemeriksaan_id = $model->id;
                    $flag = $setoran->update() && $flag;
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
            $check = Penetapan::model()->findByAttributes(array('pemeriksaan_id' => $id));
            if ($check !== null) {
                Yii::app()->util->setLog(AccessLog::TYPE_ERROR, Yii::t('trans', 'Tidak bisa Update Laporan Hasil Pemeriksaan (LHP) ID : {id}. LHP sudah ditetapkan. ', array('{id}' => $id)));
                throw new CHttpException(500, Yii::t('trans', 'Tidak bisa Update Laporan Hasil Pemeriksaan (LHP) ID : {id}. LHP sudah ditetapkan. ', array('{id}' => $id)));
            } else {
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
        $set_idx = ($idx != null) ? " OR t.id=$idx" : "";
        $model = new SetoranPajak('search');
        $model->unsetAttributes();  // clear any default values
        $criteria = new CDbCriteria();
        $criteria->join = "JOIN penetapan a ON t.penetapan_id = a.id
                        JOIN spt b ON a.spt_id = b.id
                        JOIN v_wajib_pajak c ON b.wajib_pajak_id = c.id
                        JOIN jenis_surat d ON a.jenis_surat_id = d.id";
        $criteria->condition = "(t.pemeriksaan_id IS NULL $set_idx) AND a.jenis_surat_id = 8 AND b.wajib_pajak_id=$id";
        $model->setDbCriteria($criteria);
        if (isset($_GET['SetoranPajak'])) {
            $model->attributes = $_GET['SetoranPajak'];
        }
        $this->render('grid', array(
            'model' => $model,
        ));
    }

}
