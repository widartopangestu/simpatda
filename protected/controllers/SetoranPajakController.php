<?php

class SetoranPajakController extends Controller {

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
            'WAuth - jsonGetData, ajaxGetValue',
        );
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new SetoranPajak;
        $model->tanggal_bayar = date('d/m/Y');

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['SetoranPajak'])) {
            $transaction = Yii::app()->db->beginTransaction();
            $flag = true;
            $model->attributes = $_POST['SetoranPajak'];
            $model->jumlah_potongan = str_replace(',', '', $model->jumlah_potongan);
            $model->jumlah_bayar = str_replace(',', '', $model->jumlah_bayar);
            if ($model->validate()) {
                if (!empty($model->tanggal_bayar) && $model->tanggal_bayar != '0000-00-00')
                    $model->tanggal_bayar = date_format(date_create_from_format('d/m/Y', $model->tanggal_bayar), "Y-m-d");
                else
                    $model->tanggal_bayar = new CDbExpression('null');

                $flag = $model->save() && $flag;
                if (isset($_POST['SetoranPajakDenda'])) {
                    $penetapan = new Penetapan;
                    $penetapan->tanggal_penetapan = $model->tanggal_bayar;
                    $penetapan->tanggal_jatuh_tempo = date('Y-m-d', strtotime("+" . Yii::app()->params['hari_jatuh_tempo'] . " day", strtotime($model->tanggal_bayar)));
                    $penetapan->spt_id = $model->penetapan->spt_id;
                    $penetapan->jenis_surat_id = 3; //Surat Tagihan Pajak Daerah
                    $flag = $penetapan->save() && $flag;

                    $penetapan_denda = new PenetapanDenda;
                    $penetapan_denda->attributes = $_POST['SetoranPajakDenda'];
                    $penetapan_denda->penetapan_id = $penetapan->primaryKey;
                    $penetapan_denda->setoran_pajak_id = $model->primaryKey;
                    $flag = $penetapan_denda->save() && $flag;

                    $setoran = new SetoranPajak;
                    $setoran->nomor = $model->nomor;
                    $setoran->kohir = $model->penetapan->kohir;
                    $setoran->tanggal_bayar = $model->tanggal_bayar;
                    $setoran->jumlah_bayar = $penetapan_denda->nilai_denda;
                    $setoran->via_bayar = $model->via_bayar;
                    $setoran->nama_penyetor = $model->nama_penyetor;
                    $setoran->penetapan_id = $penetapan->primaryKey;
                    $flag = $setoran->save() && $flag;
                }
            } else {
                $flag = false;
            }
            if ($flag) {
                $transaction->commit();
                Yii::app()->util->setLog(AccessLog::TYPE_SUCCESS, Yii::t('trans', 'Create Setoran Pajak ID : ') . $model->primaryKey);
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
        $model->tanggal_bayar = date('d/m/Y', strtotime($model->tanggal_bayar));

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['SetoranPajak'])) {
            $transaction = Yii::app()->db->beginTransaction();
            $flag = true;
            $model->attributes = $_POST['SetoranPajak'];
            $model->jumlah_potongan = str_replace(',', '', $model->jumlah_potongan);
            $model->jumlah_bayar = str_replace(',', '', $model->jumlah_bayar);
            if ($model->validate()) {
                if (!empty($model->tanggal_bayar) && $model->tanggal_bayar != '0000-00-00')
                    $model->tanggal_bayar = date_format(date_create_from_format('d/m/Y', $model->tanggal_bayar), "Y-m-d");
                else
                    $model->tanggal_bayar = new CDbExpression('null');

                $flag = $model->save() && $flag;
                if (isset($_POST['SetoranPajakDenda'])) {
                    $penetapan = Penetapan::model()->findByAttributes(array('spt_id' => $model->penetapan->spt_id, 'jenis_surat_id' => 3));
                    $penetapan->tanggal_penetapan = $model->tanggal_bayar;
                    $penetapan->tanggal_jatuh_tempo = date('Y-m-d', strtotime("+" . Yii::app()->params['hari_jatuh_tempo'] . " day", strtotime($model->tanggal_bayar)));
                    $flag = $penetapan->save() && $flag;

                    $penetapan_denda = PenetapanDenda::model()->findByAttributes(array('setoran_pajak_id' => $model->id));
                    $penetapan_denda->attributes = $_POST['SetoranPajakDenda'];
                    $flag = $penetapan_denda->save() && $flag;

                    $setoran = SetoranPajak::model()->findByAttributes(array('nomor' => $model->nomor, 'penetapan_id' => $penetapan->id));
                    $setoran->kohir = $model->penetapan->kohir;
                    $setoran->tanggal_bayar = $model->tanggal_bayar;
                    $setoran->jumlah_bayar = $penetapan_denda->nilai_denda;
                    $setoran->via_bayar = $model->via_bayar;
                    $setoran->nama_penyetor = $model->nama_penyetor;
                    $flag = $setoran->save() && $flag;
                }
            } else {
                $flag = false;
            }
            if ($flag) {
                $transaction->commit();
                Yii::app()->util->setLog(AccessLog::TYPE_SUCCESS, Yii::t('trans', 'Update Setoran Pajak ID : ') . $model->id);
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
                    Yii::app()->util->setLog(AccessLog::TYPE_SUCCESS, Yii::t('trans', 'Delete Setoran Pajak ID : ') . $id);
            } catch (CDbException $exc) {
                throw new CHttpException(500, Yii::t('trans', 'Delete Setoran Pajak ID : {id}. Item ini sudah dipakai pada transaksi', array('{id}' => $id)));
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
        $model = new SetoranPajak('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['SetoranPajak'])) {
            $model->attributes = $_GET['SetoranPajak'];
        }

        if (isset($_GET['pageSize'])) {
            Yii::app()->user->setState('pageSize' . $model->tableName(), (int) $_GET['pageSize']);
            unset($_GET['pageSize']);  // would interfere with pager and repetitive page size change
        }
        Yii::app()->util->setLog(AccessLog::TYPE_INFO, Yii::t('trans', 'Manage Setoran Pajak'));

        $this->render('index', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return SetoranPajak the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = SetoranPajak::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, Yii::t('trans', 'The requested page does not exist.'));
        }
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param SetoranPajak $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'setoran-pajak-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionJsonGetData($id = null) {
        if ($id != null) {
            $model = Penetapan::model()->findByPk($id);
            $data = array(
                'penetapan_id' => $model->id,
            );
            $sql = "SELECT id, nama, alamat, kabupaten, kecamatan, kelurahan FROM v_wajib_pajak WHERE id=" . $model->spt->wajib_pajak_id;
            $result = Yii::app()->db->createCommand($sql)->queryRow();

            echo CJSON::encode(array_merge($data, $result));
        } else
            echo CJSON::encode(array());
    }

    public function actionAjaxGetValue() {
        $model = new SetoranPajak;
        if (isset($_POST['SetoranPajak'])) {
            $model->attributes = $_POST['SetoranPajak'];
            if ($model->penetapan_id) {
                $penetapan = Penetapan::model()->findByPk($model->penetapan_id);
                $kode_rekening_denda = SetoranPajak::model()->getKodeRekeningDenda($penetapan->spt->kode_rekening_id);
                $date1 = date_create_from_format('Y-m-d', $penetapan->tanggal_jatuh_tempo);
                $date2 = date_create_from_format('d/m/Y', $model->tanggal_bayar);
                $interval = date_diff($date1, $date2);
                $bulan = 0;
                if (version_compare(strtotime(date_format(date_create_from_format('d/m/Y', $model->tanggal_bayar), "Y-m-d")), strtotime($penetapan->tanggal_jatuh_tempo), ">"))
                    $bulan = $interval->m + ($interval->y * 12) + ($interval->d > 0 ? 1 : 0);
                $persen_denda = 2 / 100;
                $denda = $bulan * $persen_denda * $penetapan->spt->pajak;
                $keterangan = $kode_rekening_denda->nama . '<br/>' . $bulan . ' ' . Yii::t('trans', 'bulan') . ' x 2% x Rp. ' . number_format($penetapan->spt->pajak, Yii::app()->params['currency_precision']);

                $model->jumlah_pajak = $penetapan->spt->pajak;
                $model->jumlah_potongan = ($model->jumlah_potongan != '') ? doubleval(str_replace(',', '', $model->jumlah_potongan)) : 0;
                $model->jumlah_bayar = $model->jumlah_pajak - $model->jumlah_potongan;
                $model->jumlah_pajak_denda = $model->jumlah_pajak + $denda;
                $model->jumlah_bayar_denda = $model->jumlah_bayar + $denda;

                $denda_item = array(
                    'jumlah_bulan' => $bulan, 'keterangan' => $keterangan, 'nilai_denda' => $denda, 'kode_rekening' => $kode_rekening_denda->kode, 'kode_rekening_id' => $kode_rekening_denda->id
                );
                echo CJSON::encode(array_merge($denda_item, array(
                    'tanggal_jatuh_tempo' => date('d/m/Y', strtotime($penetapan->tanggal_jatuh_tempo)),
                    'html' => $this->renderPartial('_ajax_data_spt', array('model' => $model, 'penetapan' => $penetapan, 'denda_item' => $denda_item), true, true),
                    'jumlah_bayar_denda' => number_format($model->jumlah_bayar_denda, Yii::app()->params['currency_precision']),
                    'jumlah_bayar' => number_format($model->jumlah_bayar, Yii::app()->params['currency_precision']),
                    'jumlah_pajak' => number_format($model->jumlah_pajak, Yii::app()->params['currency_precision']),
                    'jumlah_pajak_denda' => number_format($model->jumlah_pajak_denda, Yii::app()->params['currency_precision']),
                )));
            }
        }
    }

}
