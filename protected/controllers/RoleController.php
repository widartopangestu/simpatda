<?php

class RoleController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '/layouts/column2';
    public $defaultAction = 'admin';

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
        Yii::app()->util->setLog(AccessLog::TYPE_SUCCESS, Yii::t('trans', 'View Role ID : ') . $id);
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Role;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        $valid = TRUE;
        if (isset($_POST['Role'])) {
            $model->attributes = $_POST['Role'];
            $model->operations = $_POST['Role']['operations'];
            $transaction = Yii::app()->db->beginTransaction();
            if ($model->save()) {
                if (is_array($model->operations)) {
                    foreach ($model->operations as $val) {
                        $roleAccess = new RoleAccess;
                        $roleAccess->role_id = $model->id;
                        $roleAccess->operation_id = $val;
                        $valid = $roleAccess->save() && $valid;
                    }
                }
                if ($valid) {
                    Yii::app()->util->setLog(AccessLog::TYPE_SUCCESS, Yii::t('trans', 'Crerate Role ID : ') . $model->primaryKey);
                    $transaction->commit();
                    $this->redirect(array('view', 'id' => $model->id));
                }
            }
        }
        $operations_data = Operation::model()->findAll('tampilkan_dirole = 1 AND grup <> 0 AND nama_modul IS NOT NULL order by grup, name, urutan_ke ASC');
        $operations = array();
        foreach ($operations_data as $opt) {
            $opt_name = $opt->nama_modul;
            $operations[$opt->grup][$opt_name][] = $opt;
        }
        
        $this->render('create', array(
            'model' => $model,
            'operations' => $operations
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        $model->operations = $model->operationsValue;
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        $valid = TRUE;
        if (isset($_POST['Role'])) {
            $model->attributes = $_POST['Role'];
            $model->operations = isset($_POST['operation']) ? $_POST['operation'] : '';
            $transaction = Yii::app()->db->beginTransaction();
            if ($model->save()) {
                RoleAccess::model()->deleteAll(array(
                    'condition' => 'role_id=:role_id',
                    'params' => array(':role_id' => $model->id),
                ));

                if (is_array($model->operations)) {
                    foreach ($model->operations as $val) {
                        $roleAccess = new RoleAccess;
                        $roleAccess->role_id = $model->id;
                        $roleAccess->operation_id = $val;
                        $valid = $roleAccess->save() && $valid;
                    }
                }
                if ($valid) {
                    Yii::app()->util->setLog(AccessLog::TYPE_SUCCESS, Yii::t('trans', 'Update Role ID : ') . $model->id);
                    $transaction->commit();
                    $this->redirect(array('view', 'id' => $model->id));
                }
            }
        }
        $operations_data = Operation::model()->findAll('tampilkan_dirole = 1 AND grup <> 0 AND nama_modul IS NOT NULL  order by grup, name, urutan_ke ASC');
        $operations = array();
        foreach ($operations_data as $opt) {
            //$opt_name = ucwords(preg_replace("([A-Z])", " $0", $tmp[0]));
            $opt_name = $opt->nama_modul;
            $operations[$opt->grup][$opt_name][] = $opt;
        }
        $data = array();
        $tmp = count($operations);
        $ch_all = true;
        foreach ($operations as $key => $value) {
            $tmp1 = count($value);
            $ch = true;
            foreach ($value as $key2 => $value2) {
                $tmp2 = count($value2);
                foreach ($value2 as $opt) {
                    $check = $model->getChecked($opt->id);
                    $data[$opt->id . 'opt'] = $check;
                    if ($check !== 'checked') {
                        $tmp2 -= 1;
                    }
                }
                if ($tmp2 == count($value2)) {
                    $data[$key2 . 'mdl'] = 'checked';
                } else if ($tmp2 > 0 && $tmp2 < count($value2)) {
                    $data[$key2 . 'mdl'] = 'class="indeterminate"';
                    $ch = false;
                } else {
                    $data[$key2 . 'mdl'] = '';
                    $tmp1 -= 1;
                }
            }
            if ($tmp1 == count($value) && $ch) {
                $data[$key . 'grp'] = 'checked';
            } else if ($tmp1 > 0 && $tmp1 <= count($value)) {
                $data[$key . 'grp'] = 'class="indeterminate"';
                $ch_all = false;
            } else {
                $data[$key . 'grp'] = '';
                $tmp -= 1;
            }
        }
        if ($tmp == count($operations) && $ch_all) {
            $data['all_operation'] = 'checked';
        } else if ($tmp > 0 && $tmp <= count($operations)) {
            $data['all_operation'] = 'class="indeterminate"';
        } else {
            $data['all_operation'] = '';
        }

        $this->render('update', array(
            'model' => $model,
            'operations' => $operations,
            'data' => $data
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
            $transaction = Yii::app()->db->beginTransaction();
            if (RoleAccess::model()->count(array(
                        'condition' => 'role_id=:role_id',
                        'params' => array(':role_id' => $id),
                    )) > 0) {
                $valid = RoleAccess::model()->deleteAll(array(
                    'condition' => 'role_id=:role_id',
                    'params' => array(':role_id' => $id),
                ));
            }

            if ($this->loadModel($id)->delete() && $valid) {
                $transaction->commit();
                Yii::app()->util->setLog(AccessLog::TYPE_SUCCESS, Yii::t('trans', 'Delete Role ID : ') . $id);
            }

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax'])) {
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
            }
        } else {
            throw new CHttpException(400, Yii::t('trans', 'Invalid request. Please do not repeat this request again.'));
        }
    }

    public function actionAjaxRevoke($id) {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $user = User::model()->findByPk($id);
            if ($user === null)
                throw new CHttpException(404, Yii::t('trans', 'The requested page does not exist.'));
            $role_id = $user->role_id;
            $user->role_id = NULL;
            if ($user->save(FALSE))
                Yii::app()->util->setLog(AccessLog::TYPE_SUCCESS, Yii::t('trans', 'Revoke user ID : {user_id} from Role ID : {role_id}', array('{user_id}' => $user_id, '{role_id}' => $role_id)));
            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax'])) {
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('view', 'id' => $role_id));
            }
        } else {
            throw new CHttpException(400, Yii::t('trans', 'Invalid request. Please do not repeat this request again.'));
        }
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        Yii::app()->util->setLog(AccessLog::TYPE_INFO, Yii::t('trans', 'List Role'));
        $dataProvider = new CActiveDataProvider('Role');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Role('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Role'])) {
            $model->attributes = $_GET['Role'];
        }
        Yii::app()->util->setLog(AccessLog::TYPE_INFO, Yii::t('trans', 'Manage Role'));

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Role the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Role::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, Yii::t('trans', 'The requested page does not exist.'));
        }
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Role $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'role-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionAssign($id) {
        $model = $this->loadModel($id);
        $dataProvider = new CActiveDataProvider('User', array(
            'criteria' => array(
                'condition' => 'role_id IS NULL',
        )));

        $this->render('assign', array(
            'dataProvider' => $dataProvider,
            'model' => $model,
        ));
    }

    public function actionAjaxAssign($role_id, $user_id) {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $user = User::model()->findByPk($user_id);
            if ($user === null)
                throw new CHttpException(404, Yii::t('trans', 'The requested page does not exist.'));
            $user->role_id = $role_id;
            if ($user->save(FALSE))
                Yii::app()->util->setLog(AccessLog::TYPE_SUCCESS, Yii::t('trans', 'Assign user ID : {user_id} to Role ID : {role_id}', array('{user_id}' => $user_id, '{role_id}' => $role_id)));
            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax'])) {
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('view', 'id' => $role_id));
            }
        } else {
            throw new CHttpException(400, Yii::t('trans', 'Invalid request. Please do not repeat this request again.'));
        }
//        echo $role_id . ' ' . $user_id;
    }

}
