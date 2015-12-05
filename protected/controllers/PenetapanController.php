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
            'WAuth',
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
                    }
                }
            } else {
                $flag = false;
            }
            if ($flag) {
                $transaction->commit();
                Yii::app()->util->setLog(AccessLog::TYPE_SUCCESS, Yii::t('trans', 'Create Penetapan dari nomor {spt_from} s/d. {spt_to}', array('{spt_from}' => $_POST['PenetapanForm']['spt_from'], '{spt_to}' => $_POST['PenetapanForm']['spt_to'])));
                $this->redirect(array('pajak'));
            }
        }

        $this->render('pajak', array(
            'model' => $model,
        ));
    }

    public function actionSanksi() {
        
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

}
