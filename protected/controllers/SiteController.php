<?php

class SiteController extends Controller {

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'WAuth - help, error',
        );
    }

    /**
     * Declares class-based actions.
     */
    public function actions() {
        return array(
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
        if (Yii::app()->user->isGuest)
            $this->redirect(Yii::app()->user->loginUrl);
        else {
            $accessLog = new AccessLog('search');
            $accessLog->unsetAttributes();  // clear any default values
            $accessLog->user_id = Yii::app()->user->id;
            if (isset($_GET['AccessLog'])) {
                $accessLog->attributes = $_GET['AccessLog'];
            }
            $user = User::model()->findByPk(Yii::app()->user->id);
            $this->render('index', array('user' => $user, 'accessLog' => $accessLog));
        }
    }

    public function actionHelp() {
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
        $this->render('help');
    }

    public function actionConfig() {
        $file = dirname(__FILE__) . '/../config/params.inc';
        $content = file_get_contents($file);
        $arr = unserialize(base64_decode($content));
        $model = new ConfigForm();
        $model->setAttributes($arr);
        $model->language = TranslateModule::translator()->getLanguage();
        if (isset($_POST['ConfigForm'])) {
            $model->setAttributes($_POST['ConfigForm']);
            if ($model->validate()) {
                $model->currency_precision = intval($model->currency_precision);
                $model->qty_precision = intval($model->qty_precision);
                $config = $model->getAttributes();
                //set language
                TranslateModule::translator()->setLanguage($_POST['ConfigForm']['language']);
                $str = base64_encode(serialize($config));
                file_put_contents($file, $str);
                $model->setAttributes($config);
                Yii::app()->util->setLog(AccessLog::TYPE_SUCCESS, Yii::t('trans', 'Configuration has been changed.'));
            }
        }

        $this->render('config', array('model' => $model));
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        $this->layout = '//layouts/member1';
        $this->mainNav = array(
            array('label' => 'Back to Home', 'icon' => 'icon-chevron-left', 'url' => Yii::app()->request->baseUrl)
        );
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
        Yii::app()->util->setLog(AccessLog::TYPE_ERROR, $error['code'] . ' ' . $error['message'] . ' - Access Page : "' . Yii::app()->request->requestUri . '"');
    }

}
