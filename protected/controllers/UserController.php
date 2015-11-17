<?php

class UserController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '/layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'WAuth - login, logout, captcha, registration, activation, recovery',
        );
    }

    /**
     * Declares class-based actions.
     */
    public function actions() {
        return array(
// captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        Yii::app()->util->setLog(AccessLog::TYPE_INFO, Yii::t('trans', 'View User ID : {id}', array('{id}' => $id)));
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new User;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            if ($model->save()) {
                Yii::app()->util->setLog(AccessLog::TYPE_SUCCESS, Yii::t('trans', 'Create User ID : ') . $model->primaryKey);
                $this->redirect(array('view', 'id' => $model->id));
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
        $old_pass = $model->password;
        $model->password = "";
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            if (empty($model->password))
                $model->password = $old_pass;
            if ($model->save()) {
                Yii::app()->util->setLog(AccessLog::TYPE_SUCCESS, Yii::t('trans', 'Update User ID : ') . $id);
                $this->redirect(array('view', 'id' => $model->id));
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
        $valid = TRUE;
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            if (Yii::app()->user->id == $id) {
                if (!isset($_GET['ajax'])) {
                    Yii::app()->util->setLog(AccessLog::TYPE_ERROR, Yii::t('trans', 'You Can\'t Delete Current Loged In  User ID : {id}', array('{id}' => $id)));
                    $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
                } else {
                    throw new CHttpException(403, Yii::t('trans', 'You Can\'t Delete Current Loged In  User ID : {id}', array('{id}' => $id)));
                }
            } else {
                $transaction = Yii::app()->db->beginTransaction();

                if (AccessLog::model()->findAll(array(
                            'condition' => 'user_id=:user_id',
                            'params' => array(':user_id' => $id),
                        ))) {
                    $valid = false;
//                            AccessLog::model()->deleteAll(array(
//                        'condition' => 'user_id=:user_id',
//                        'params' => array(':user_id' => $id),
//                    ));
                }

                if ($valid) {
                    if ($this->loadModel($id)->delete()) {
                        $transaction->commit();
                        Yii::app()->util->setLog(AccessLog::TYPE_SUCCESS, Yii::t('trans', 'Delete User ID : ') . $id); // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
                        if (!isset($_GET['ajax'])) {
                            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
                        }
                    }
                } else {
                    if (!isset($_GET['ajax'])) {
                        Yii::app()->util->setLog(AccessLog::TYPE_ERROR, Yii::t('trans', 'You Can\'t Delete Current Loged In  User ID : {id} Because, this user has been doing transactions. Set User to Not Active or Banned.', array('{id}' => $id)));
                        $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
                    } else {
                        throw new CHttpException(403, Yii::t('trans', 'You Can\'t Delete Current Loged In  User ID : {id} Because, this user has been doing transactions. Set User to Not Active or Banned.', array('{id}' => $id)));
                    }
                }
            }
        } else {
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
        }
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $model = new User('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['User'])) {
            $model->attributes = $_GET['User'];
        }

        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function actionRegistration() {
        $this->layout = '//layouts/member1';
        $this->mainNav = array(
            array('label' => Yii::t('trans', 'Already have an account? Login now'), 'url' => Yii::app()->user->loginUrl),
//            array('label' => Yii::t('trans', 'Back to Home'), 'icon' => 'icon-chevron-left', 'url' => Yii::app()->request->baseUrl)
        );
        if (Yii::app()->user->id)
            $this->redirect(array('/profile/profile'));

        $model = new UserRegistrationForm;
        $valid = TRUE;
        if (isset($_SESSION['emaildaftar']))
            $model->email = Yii::app()->session['emaildaftar'];
        if (isset($_POST['UserRegistrationForm'])) {
            $model->attributes = $_POST['UserRegistrationForm'];
            $model->activkey = sha1(microtime() . $model->password);
            $model->role_id = Yii::app()->params['general_user_role'];
            $transaction = Yii::app()->db->beginTransaction();
            if ($model->save()) {
                $activation_url = $this->createAbsoluteUrl('/user/activation', array("activkey" => $model->activkey, "email" => $model->email));
                $valid = User::sendMail($model->email, Yii::t('trans', 'You registered from ') . Yii::app()->name, Yii::t('trans', 'Please activate you account go to ') . $activation_url);
                if ($valid) {
                    $transaction->commit();
                    Yii::app()->user->setFlash('registration', Yii::t('trans', 'Thank you for your registration. Please check your email.'));
                    $this->refresh();
                }
            }
        }

        $this->render('registration', array(
            'model' => $model,
        ));
    }

    public function actionActivation($activkey, $email) {
        $this->layout = '//layouts/member1';
        $this->mainNav = array(
            array('label' => Yii::t('trans', 'Already have an account? Login now'), 'url' => Yii::app()->user->loginUrl),
//            array('label' => Yii::t('trans', 'Back to Home'), 'icon' => 'icon-chevron-left', 'url' => Yii::app()->request->baseUrl)
        );
        if (Yii::app()->user->id)
            $this->redirect(array('/user/profile'));

        if ($email && $activkey) {
            $find = User::model()->findByAttributes(array('email' => $email));
            if (isset($find) && $find->status == User::STATUS_ACTIVE) {
                $this->render('/user/activation', array('content' => "You account is active."));
            } elseif (isset($find->activkey) && ($find->activkey == $activkey)) {
                $find->activkey = sha1(microtime());
                $find->status = User::STATUS_ACTIVE;
                $find->save(FALSE);
                $this->render('/user/activation', array('content' => Yii::t('trans', 'Your account is activated.')));
            } else {
                $this->render('/user/activation', array('content' => Yii::t('trans', 'Incorrect activation URL.')));
            }
        } else {
            $this->render('/user/activation', array('content' => Yii::t('trans', 'Incorrect activation URL.')));
        }
    }

    public function actionRecovery($activkey = NULL, $email = NULL) {
        $this->layout = '//layouts/member1';
        $this->mainNav = array(
            array('label' => Yii::t('trans', 'Already have an account? Login now'), 'url' => Yii::app()->user->loginUrl),
//            array('label' => Yii::t('trans', 'Back to Home'), 'icon' => 'icon-chevron-left', 'url' => Yii::app()->request->baseUrl)
        );
        if (Yii::app()->user->id)
            $this->redirect(array('/user/profile'));

        if ($activkey !== NULL && $email !== NULL) {
            $form2 = new UserChangePassword;
            $find = User::model()->findByAttributes(array('email' => $email));
            if (isset($find) && $find->activkey == $activkey) {
                if (isset($_POST['UserChangePassword'])) {
                    $form2->attributes = $_POST['UserChangePassword'];
                    if ($form2->validate()) {
                        $find->password = $form2->password;
                        $find->activkey = sha1(microtime() . $form2->password);
                        if ($find->status == User::STATUS_NOACTIVE) {
                            $find->status = User::STATUS_ACTIVE;
                        }
                        $find->save(FALSE);
                        Yii::app()->user->setFlash('recoveryMessage', Yii::t('trans', 'New password is saved.'));
                        $this->redirect(array('/user/recovery'));
                    }
                }
                $this->render('changepasswordrecovery', array('model' => $form2));
            } else {
                Yii::app()->user->setFlash('recoveryMessage', Yii::t('trans', 'Incorrect recovery link.'));
                $this->redirect(array('/user/recovery'));
            }
        } else {
            $form = new UserRecoveryForm;
            if (isset($_POST['UserRecoveryForm'])) {
                $form->attributes = $_POST['UserRecoveryForm'];
                if ($form->validate()) {
                    $user = User::model()->findbyPk($form->user_id);
                    $user->activkey = sha1($user->username . time());
                    $user->save(false);
                    $activation_url = CHtml::link('click here', $this->createAbsoluteUrl('/user/recovery', array("activkey" => $user->activkey, "email" => $user->email)));

                    $subject = Yii::t('trans', 'Requested password recovery | {appname}', array('{appname}' => Yii::app()->name));
                    $message = Yii::t('trans', 'You have requested the password recovery from {appname}. To receive a new password, use this link to reset your password. {activationurl}', array('{appname}' => Yii::app()->name, '{activationurl}' => $activation_url));

                    User::sendMail($user->email, $subject, $message);

                    Yii::app()->user->setFlash('recoveryMessage', Yii::t('trans', 'Please check your email. An instructions was sent to your email address.'));
                    $this->refresh();
                }
            }
            $this->render('recovery', array('form' => $form));
        }
    }

    /**
     * Displays the login page
     */
    public function actionLogin() {
        $this->layout = '//layouts/member1';
        $this->mainNav = array(
            array('label' => Yii::t('trans', 'Don\'t have an account?'), 'url' => array('user/registration'), 'visible' => Yii::app()->params['member']),
//            array('label' => Yii::t('trans', 'Back to Home'), 'icon' => 'icon-chevron-left', 'url' => Yii::app()->request->baseUrl)
        );

        $model = new LoginForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            $session = new CHttpSession;
            $session->open();
            $current_db = explode('dbname=', Yii::app()->db->connectionString);
            $session['user_choose_db'] = $current_db[1];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login())
                $this->redirect(Yii::app()->user->returnUrl);
            else
                unset(Yii::app()->session['user_choose_db']);
        }
        // display the login form
        $this->render('login', array('model' => $model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return User the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = User::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, Yii::t('trans', 'The requested page does not exist.'));
        }
        return $model;
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

}
