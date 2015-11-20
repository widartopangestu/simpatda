<?php

class PejabatController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout = '//layouts/column1';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'WAuth',
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
                Yii::app()->util->setLog(AccessLog::TYPE_INFO, Yii::t('trans', 'View Pejabat ID : {id}', array('{id}' => $id)));
                $this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Pejabat;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Pejabat'])) {
			$model->attributes=$_POST['Pejabat'];
			if ($model->save()) {
				Yii::app()->util->setLog(AccessLog::TYPE_SUCCESS, Yii::t('trans', 'Create Pejabat ID : ') . $model->primaryKey);
                                $this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Pejabat'])) {
			$model->attributes=$_POST['Pejabat'];
			if ($model->save()) {
				Yii::app()->util->setLog(AccessLog::TYPE_SUCCESS, Yii::t('trans', 'Update Pejabat ID : ') . $model->id);
                                $this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('update',array(
			'model'=>$model,
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
                    Yii::app()->util->setLog(AccessLog::TYPE_SUCCESS, Yii::t('trans', 'Delete Pejabat ID : ') . $id);
            } catch (CDbException $exc) {
                throw new CHttpException(500, Yii::t('trans', 'Delete Pejabat ID : {id}. Item ini sudah dipakai pada transaksi', array('{id}' => $id)));
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
	public function actionIndex()
	{
		$model=new Pejabat('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['Pejabat'])) {
			$model->attributes=$_GET['Pejabat'];
		}
                
                if (isset($_GET['pageSize'])) {
                    Yii::app()->user->setState('pageSize' . $model->tableName(), (int) $_GET['pageSize']);
                    unset($_GET['pageSize']);  // would interfere with pager and repetitive page size change
                }
                Yii::app()->util->setLog(AccessLog::TYPE_INFO, Yii::t('trans', 'Manage Pejabat'));
                                
		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Pejabat the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Pejabat::model()->findByPk($id);
		if ($model===null) {
			throw new CHttpException(404, Yii::t('trans', 'The requested page does not exist.'));
		}
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Pejabat $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax']==='pejabat-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}