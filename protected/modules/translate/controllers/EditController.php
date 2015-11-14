<?php

class EditController extends TranslateBaseController {

    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'WAuth',
        );
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionCreate($id, $language) {
        $model = new Message('create');
        $model->id = $id;
        $model->language = $language;
        $model->category = $model->source;
        $model->message = $model->source;

        if (isset($_POST['Message'])) {
            $model->attributes = $_POST['Message'];
            if ($model->save())
                $this->redirect(array('missing'));
        }

        $this->render('create', array('model' => $model));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id, $language) {
        $model = $this->translateLoadModel($id, $language);

        if (isset($_POST['Message'])) {
            $model->attributes = $_POST['Message'];
            if ($model->save())
                $this->redirect(array('index'));
        }

        $this->render('update', array('model' => $model));
    }

    /**
     * Deletes a record
     * @param integer $id the ID of the model to be deleted
     * @param string $language the language of the model to de deleted
     */
    public function actionDelete($id, $language) {
        if (Yii::app()->getRequest()->getIsPostRequest()) {
            $model = $this->translateLoadModel($id, $language);
            if ($model->delete()) {
                if (Yii::app()->getRequest()->getIsAjaxRequest()) {
                    echo TranslateModule::t('Message deleted successfully');
                    Yii::app()->end();
                } else
                    $this->redirect(Yii::app()->getRequest()->getUrlReferrer());
            }
        } else
            throw new CHttpException(400);
    }

    /**
     * Manages all models.
     */
    public function actionIndex() {
        $model = new Message('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Message']))
            $model->attributes = $_GET['Message'];
        if (isset($_GET['pageSize'])) {
            Yii::app()->user->setState('pageSize' . $model->tableName(), (int) $_GET['pageSize']);
            unset($_GET['pageSize']);  // would interfere with pager and repetitive page size change 
        }

        $this->render('index', array(
            'model' => $model,
        ));
    }

    /**
     * 
     */
    public function actionMissing() {
        $model = new MessageSource('search');
        $model->unsetAttributes();  // clear any default values

        if (isset($_GET['MessageSource']))
            $model->attributes = $_GET['MessageSource'];
        if (isset($_GET['pageSize'])) {
            Yii::app()->user->setState('pageSize' . $model->tableName(), (int) $_GET['pageSize']);
            unset($_GET['pageSize']);  // would interfere with pager and repetitive page size change 
        }

        $model->language = TranslateModule::translator()->getLanguage();

        $this->render('missing', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a record
     * @param integer $id the ID of the model to be deleted
     * @param string $language the language of the model to de deleted
     */
    public function actionMissingdelete($id) {
        if (Yii::app()->getRequest()->getIsPostRequest()) {
            $model = MessageSource::model()->findByPk($id);
            if ($model->delete()) {
                if (Yii::app()->getRequest()->getIsAjaxRequest()) {
                    echo TranslateModule::t('Message deleted successfully');
                    Yii::app()->end();
                } else
                    $this->redirect(Yii::app()->getRequest()->getUrlReferrer());
            }
        } else
            throw new CHttpException(400);
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function translateLoadModel($id, $language) {
        $model = Message::model()->findByPk(array('id' => $id, 'language' => $language));
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

}
