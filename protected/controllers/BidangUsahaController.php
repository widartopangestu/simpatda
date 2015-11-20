<?php

class BidangUsahaController extends Controller {

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
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new BidangUsaha;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['BidangUsaha'])) {
            $model->attributes = $_POST['BidangUsaha'];
            if ($model->save()) {
                Yii::app()->util->setLog(AccessLog::TYPE_SUCCESS, Yii::t('trans', 'Create Bidang Usaha ID : ') . $model->primaryKey);
                $this->redirect(array('index'));
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

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['BidangUsaha'])) {
            $model->attributes = $_POST['BidangUsaha'];
            if ($model->save()) {
                Yii::app()->util->setLog(AccessLog::TYPE_SUCCESS, Yii::t('trans', 'Update Bidang Usaha ID : ') . $model->id);
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
                    Yii::app()->util->setLog(AccessLog::TYPE_SUCCESS, Yii::t('trans', 'Delete Bidang Usaha ID : ') . $id);
            } catch (CDbException $exc) {
                throw new CHttpException(500, Yii::t('trans', 'Delete Bidang Usaha ID : {id}. Item ini sudah dipakai pada transaksi', array('{id}' => $id)));
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
        $model = new BidangUsaha('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['BidangUsaha'])) {
            $model->attributes = $_GET['BidangUsaha'];
        }

        if (isset($_GET['pageSize'])) {
            Yii::app()->user->setState('pageSize' . $model->tableName(), (int) $_GET['pageSize']);
            unset($_GET['pageSize']);  // would interfere with pager and repetitive page size change
        }
        Yii::app()->util->setLog(AccessLog::TYPE_INFO, Yii::t('trans', 'Manage Bidang Usaha'));

        $this->render('index', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return BidangUsaha the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = BidangUsaha::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, Yii::t('trans', 'The requested page does not exist.'));
        }
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param BidangUsaha $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'bidang-usaha-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
