<?php

class ProfileController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column1';
    public $userTitle = 'Profile';
    public $defaultAction = 'profile';
    private $_model;

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
    public function actionProfile() {
        Yii::app()->util->setLog(AccessLog::TYPE_INFO, Yii::t('trans', 'View Profile'));
        $model_log = new AccessLog('search');
        $model_log->unsetAttributes();  // clear any default values
        if (isset($_GET['AccessLog'])) {
            $model_log->attributes = $_GET['AccessLog'];
        }
        $model_log->user_id = Yii::app()->user->id;
// page size drop down changed
        if (isset($_GET['pageSize'])) {
            Yii::app()->user->setState('pageSize' . $model_log->tableName(), (int) $_GET['pageSize']);
            unset($_GET['pageSize']);  // would interfere with pager and repetitive page size change
        }
        $this->render('profile', array(
            'model' => $this->loadUser(),
            'model_log' => $model_log
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionEdit() {
        if (!Yii::app()->user->id)
            $this->redirect(array(Yii::app()->user->loginUrl));

        $model = UserProfileForm::model()->findByPk(Yii::app()->user->id);
        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            if ($model->save()) {
                Yii::app()->util->setLog(AccessLog::TYPE_SUCCESS, Yii::t('trans', 'Update Profile Saved'));
                $this->redirect(array('/profile/profile'));
            }
        }

        $this->render('edit', array(
            'model' => $model,
        ));
    }

    /**
     * Change password
     */
    public function actionChangePassword() {
        if (Yii::app()->user->id) {
            $model = new UserChangePassword('changepassword');
            if (isset($_POST['UserChangePassword'])) {
                $model->attributes = $_POST['UserChangePassword'];
                if ($model->validate()) {
                    $new_password = User::model()->findbyPk(Yii::app()->user->id);
                    $new_password->password = $model->password;
                    $new_password->save(FALSE);
                    Yii::app()->util->setLog(AccessLog::TYPE_INFO, Yii::t('trans', 'Password has been changed.'));
                    $this->redirect(array('/profile/profile'));
                }
            }
            $this->render('changepassword', array('model' => $model));
        } else
            $this->redirect(Yii::app()->createUrl(Yii::app()->user->loginUrl));
    }

    /**
     * Change photo
     */
    public function actionChangePhoto() {
        $model = new UserChangePhoto;
        if (Yii::app()->user->id) {

            // ajax validator
//            if (isset($_POST['ajax']) && $_POST['ajax'] === 'changeimage-form') {
//                echo UActiveForm::validate($model);
//                Yii::app()->end();
//            }

            if (isset($_POST['UserChangePhoto'])) {
                $model->attributes = $_POST['UserChangePhoto'];
                if ($model->validate()) {
                    $instance_image = CUploadedFile::getInstance($model, 'image');
                    if ($instance_image !== null) {
                        $fileName = sha1($instance_image->getName() . rand(1, 9999999999)) . '.' . $instance_image->getExtensionName();
                        $old_image = $model->image;
                        $model->image = $fileName;
                        $dir = Yii::getPathOfAlias('webroot') . Yii::app()->params['upload_image_profile'];
                        if ($instance_image->saveAs($dir . $fileName) && file_exists($dir . $old_image) && $old_image != NULL) {
                            unlink($dir . $old_image);
                        }
                    }
                    $new_image = User::model()->findByPk(Yii::app()->user->id);
                    $new_image->image = $model->image;
                    $new_image->save();
                    Yii::app()->util->setLog(AccessLog::TYPE_INFO, Yii::t('trans', 'Image has been changed.'));
                    $this->redirect(array("profile"));
                }
            }
            $this->render('changephoto', array('model' => $model));
        }
    }

    /**
     * Performs the AJAX validation.
     * @param User $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the primary key value. Defaults to null, meaning using the 'id' GET variable
     */
    public function loadUser() {
        if ($this->_model === null) {
            if (Yii::app()->user->id)
                $this->_model = User::model()->findByPk(Yii::app()->user->id);
            if ($this->_model === null)
                $this->redirect(array(Yii::app()->user->loginUrl));
        }
        return $this->_model;
    }

}
