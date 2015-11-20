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
            'WAuth - dynamicKelurahan',
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
    public function actionIndex() {
        $model = new WajibPajak('search');
        $model->unsetAttributes();  // clear any default values
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
        $data = CHtml::listData(Kelurahan::model()->findAll('kecamatan_id=:kecamatan_id', array(':kecamatan_id' => (int) $_POST['WajibPajak']['kecamatan_id'])), 'id', 'nama');
        echo CHtml::tag('option', array('value' => ''), Yii::t('trans', '- Pilih Kelurahan -'), true);
        foreach ($data as $value => $name) {
            echo CHtml::tag('option', array('value' => $value), CHtml::encode($name), true);
        }
    }

}
