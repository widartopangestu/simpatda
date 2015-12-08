<?php

class SetoranBankController extends Controller {

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
            'WAuth',
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        Yii::app()->util->setLog(AccessLog::TYPE_INFO, Yii::t('trans', 'View Setoran Bank ID : {id}', array('{id}' => $id)));
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new SetoranBank;
        $model->tanggal = date('d/m/Y');

        $setoran_pajak = new SetoranPajak('search');
        $setoran_pajak->unsetAttributes();  // clear any default values
        $criteria = new CDbCriteria();
        $criteria->condition = "t.id NOT IN (SELECT setoran_pajak_id FROM setoran_bank_item)";
        $setoran_pajak->setDbCriteria($criteria);
        if (isset($_GET['SetoranPajak'])) {
            $setoran_pajak->attributes = $_GET['SetoranPajak'];
        }
        if (isset($_POST['SetoranBank'])) {
            $transaction = Yii::app()->db->beginTransaction();
            $flag = true;
            $model->attributes = $_POST['SetoranBank'];
            if ($model->validate()) {
                if (!empty($model->tanggal) && $model->tanggal != '0000-00-00')
                    $model->tanggal = date_format(date_create_from_format('d/m/Y', $model->tanggal), "Y-m-d");
                else
                    $model->tanggal = new CDbExpression('null');
                $flag = $model->save() && $flag;
                if (isset($_POST['SetoranPajak_ids'])) {
                    foreach ($_POST['SetoranPajak_ids'] as $setoran_pajak_id) {
                        $bank_item = new SetoranBankItem;
                        $bank_item->setoran_bank_id = $model->primaryKey;
                        $bank_item->setoran_pajak_id = $setoran_pajak_id;
                        $flag = $bank_item->save() && $flag;
                    }
                } else {
                    $flag = false;
                    Yii::app()->util->setLog(AccessLog::TYPE_ERROR, Yii::t('trans', 'Setoran Pajak tidak boleh kosong. Minimal pilih 1 item.'));
                }
            } else {
                $flag = false;
            }
            if ($flag) {
                $transaction->commit();
                Yii::app()->util->setLog(AccessLog::TYPE_SUCCESS, Yii::t('trans', 'Create Setoran Bank ID : ') . $model->primaryKey);
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('create', array(
            'model' => $model,
            'setoran_pajak' => $setoran_pajak,
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
                    Yii::app()->util->setLog(AccessLog::TYPE_SUCCESS, Yii::t('trans', 'Delete Setoran Bank ID : ') . $id);
            } catch (CDbException $exc) {
                throw new CHttpException(500, Yii::t('trans', 'Delete Setoran Bank ID : {id}. Item ini sudah dipakai pada transaksi', array('{id}' => $id)));
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
        $model = new SetoranBank('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['SetoranBank'])) {
            $model->attributes = $_GET['SetoranBank'];
        }

        if (isset($_GET['pageSize'])) {
            Yii::app()->user->setState('pageSize' . $model->tableName(), (int) $_GET['pageSize']);
            unset($_GET['pageSize']);  // would interfere with pager and repetitive page size change
        }
        Yii::app()->util->setLog(AccessLog::TYPE_INFO, Yii::t('trans', 'Manage Setoran Bank'));

        $this->render('index', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return SetoranBank the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = SetoranBank::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, Yii::t('trans', 'The requested page does not exist.'));
        }
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param SetoranBank $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'setoran-bank-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
