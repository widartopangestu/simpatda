<?php

class AccessLogController extends Controller {

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

    public function actionDownload($id) {
        Yii::app()->util->_ini_set_timeout();
        $model = $this->loadModel($id);
        $filename = 'LOG' . '_' . date("d-m-Y_h:i:s-A");
        $title = Yii::t('trans', 'Aktifitas Pengguna') . ' (' . $model->user->username . ')';
        $filename = $filename . '.txt';
        header('Content-Type: text/plain');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $log = str_replace('<li> ', PHP_EOL, $model->activity);
        $log = str_replace('<li>', PHP_EOL . '   ', $log);
        $log = str_replace('<ul>', '', $log);
        $log = str_replace('</ul>', '', $log);
        $log = str_replace('</li>', '', $log);
        $content = $title . PHP_EOL . '=======================================' . PHP_EOL . $log;
        print $content;
    }

    /**
     * Manages all models.
     */
    public function actionIndex() {
        $model = new AccessLog('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['AccessLog'])) {
            $model->attributes = $_GET['AccessLog'];
        }

        if (isset($_GET['pageSize'])) {
            Yii::app()->user->setState('pageSize' . $model->tableName(), (int) $_GET['pageSize']);
            unset($_GET['pageSize']);  // would interfere with pager and repetitive page size change 
        }
//        Yii::app()->util->setLog(AccessLog::TYPE_INFO, Yii::t('trans', 'Manage Access Logs');

        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function loadModel($id) {
        $model = AccessLog::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, Yii::t('trans', 'The requested page does not exist.'));
        }
        return $model;
    }

}
