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
            'WAuth - dynamicDataSpt, jsonGetData, ajaxGetValue',
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
            $model->attributes = $_POST['SetoranPajak'];
            $model->jumlah_potongan = str_replace(',', '', $model->jumlah_potongan);
            $model->jumlah_bayar = str_replace(',', '', $model->jumlah_bayar);
            if ($model->validate()) {
                if (!empty($model->tanggal_bayar) && $model->tanggal_bayar != '0000-00-00')
                    $model->tanggal_bayar = date_format(date_create_from_format('d/m/Y', $model->tanggal_bayar), "Y-m-d");
                else
                    $model->tanggal_bayar = new CDbExpression('null');
                if ($model->save()) {
                    Yii::app()->util->setLog(AccessLog::TYPE_SUCCESS, Yii::t('trans', 'Create Setoran Pajak ID : ') . $model->primaryKey);
                    $this->redirect(array('create'));
                }
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
            $model->attributes = $_POST['SetoranPajak'];
            $model->jumlah_potongan = str_replace(',', '', $model->jumlah_potongan);
            $model->jumlah_bayar = str_replace(',', '', $model->jumlah_bayar);
            if ($model->validate()) {
                if (!empty($model->tanggal_bayar) && $model->tanggal_bayar != '0000-00-00')
                    $model->tanggal_bayar = date_format(date_create_from_format('d/m/Y', $model->tanggal_bayar), "Y-m-d");
                else
                    $model->tanggal_bayar = new CDbExpression('null');
                if ($model->save()) {
                    Yii::app()->util->setLog(AccessLog::TYPE_SUCCESS, Yii::t('trans', 'Update Setoran Pajak ID : ') . $model->id);
                    $this->redirect(array('index'));
                }
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

    public function actionDynamicDataSpt($id) {
        $data = Penetapan::model()->findByPk($id);
        $this->renderPartial('_ajax_data_spt', array('model' => $data), false, true);
    }

    public function actionJsonGetData($id = null) {
        if ($id != null) {
            $model = Penetapan::model()->findByPk($id);
            $data = array(
                'penetapan_id' => $model->id,
                'tanggal_jatuh_tempo' => date('d/m/Y', strtotime($model->tanggal_jatuh_tempo)),
                'jumlah_pajak' => number_format($model->spt->pajak, Yii::app()->params['currency_precision']),
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
            $model->jumlah_pajak = ($model->jumlah_pajak != '') ? doubleval(str_replace(',', '', $model->jumlah_pajak)) : 0;
            $model->jumlah_potongan = ($model->jumlah_potongan != '') ? doubleval(str_replace(',', '', $model->jumlah_potongan)) : 0;
            $model->jumlah_bayar = $model->jumlah_pajak - $model->jumlah_potongan;
        }
        echo CJSON::encode(array(
            'jumlah_bayar' => number_format($model->jumlah_bayar, Yii::app()->params['currency_precision']),
        ));
    }

}
