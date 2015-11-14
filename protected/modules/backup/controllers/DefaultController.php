<?php

/**
 * Backup
 *
 * Yii module to backup, restore databse
 *
 * @version 1.0
 * @author Shiv Charan Panjeta <shiv@toxsl.com> <shivcharan.panjeta@outlook.com>
 */
function escape_string_val($string) {
    if (strlen($string) == 0)
        return 'NULL';
    else {
        if (is_numeric($string))
            return $string;
        else
            return "'" . str_replace("'", "''", $string) . "'";
    }
}

function escape_string($string) {
    return str_replace("'", "''", $string);
}

class DefaultController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';
    public $tables = array();
    public $fp;
    public $file_name;
    public $_path = null;
    public $back_temp_file = 'db_backup_';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'WAuth'
        );
    }

    protected function getPath() {
        $db = Yii::app()->session['user_choose_db'];
        if (isset($this->module->path))
            $this->_path = $this->module->path . '/' . $db . '/';
        else
            $this->_path = Yii::app()->basePath . '/../_backup/' . $db . '/';

        if (!file_exists($this->_path)) {
            mkdir($this->_path,0777);
            //chmod($this->_path, '777');
        }
        return $this->_path;
    }

    public function execSqlFile($sqlFile) {
        $message = "ok";

        if (file_exists($sqlFile)) {
            $sqlArray = file_get_contents($sqlFile);

            $cmd = Yii::app()->db->createCommand($sqlArray);
            try {
                $cmd->execute();
            } catch (CDbException $e) {
                $message = $e->getMessage();
            }
        }
        return $message;
    }

    public function getColumns($tableName) {
        $sql = 'SHOW CREATE TABLE ' . $tableName;
        $cmd = Yii::app()->db->createCommand($sql);
        $table = $cmd->queryRow();

        $create_query = $table['Create Table'] . ';';

        $create_query = preg_replace('/^CREATE TABLE/', 'CREATE TABLE IF NOT EXISTS', $create_query);
        //$create_query = preg_replace('/AUTO_INCREMENT\s*=\s*([0-9])+/', '', $create_query);
        if ($this->fp) {
            $this->writeComment('TABLE `' . addslashes($tableName) . '`');
            $final = 'DROP TABLE IF EXISTS `' . addslashes($tableName) . '`;' . PHP_EOL . $create_query . PHP_EOL . PHP_EOL;
            fwrite($this->fp, $final);
        } else {
            $this->tables[$tableName]['create'] = $create_query;
            return $create_query;
        }
    }

    public function getData($tableName) {
        $sql = 'SELECT * FROM ' . $tableName;
        $cmd = Yii::app()->db->createCommand($sql);
        $dataReader = $cmd->query();

        $data_string = '';
        $i = 0;
        foreach ($dataReader as $data) {
            ++$i;
            $itemNames = array_keys($data);
            $itemNames = array_map("escape_string", $itemNames);
            $items = join('`,`', $itemNames);
            $itemValues = array_values($data);
            $itemValues = array_map("escape_string_val", $itemValues);
            $valueString = join(",", $itemValues);
            $valueString = "(" . $valueString . "),";
            $values = "\n" . $valueString;
            if ($i == 1) {
                $data_string .= "INSERT INTO `$tableName` (`$items`) VALUES";
            }
            if ($values != "") {
                if ($i == $dataReader->rowCount) {
                    $data_string .= rtrim($values, ",") . ";";
                } else {
                    $data_string .= rtrim($values, ",") . ",";
                }
            }
        }

        if ($data_string == '')
            return null;

        if ($this->fp) {
            $this->writeComment('TABLE DATA ' . $tableName);
            $final = $data_string . PHP_EOL . PHP_EOL;
            fwrite($this->fp, $final);
        } else {
            $this->tables[$tableName]['data'] = $data_string;
            return $data_string;
        }
    }

    public function getTables($exclude = array()) {
        $sql = 'SHOW TABLES';
        $cmd = Yii::app()->db->createCommand($sql);
        $tables = $cmd->queryColumn();
        return array_diff($tables, $exclude);
    }

    public function StartBackup($addcheck = true) {
        $this->file_name = $this->path . $this->back_temp_file . date('Y.m.d_H.i.s') . '.sql';

        $this->fp = fopen($this->file_name, 'w+');

        if ($this->fp == null)
            return false;
        fwrite($this->fp, '-- -------------------------------------------' . PHP_EOL);
        if ($addcheck) {
            fwrite($this->fp, 'SET AUTOCOMMIT=0;' . PHP_EOL);
            fwrite($this->fp, 'START TRANSACTION;' . PHP_EOL);
            fwrite($this->fp, 'SET SQL_QUOTE_SHOW_CREATE = 1;' . PHP_EOL);
        }
        fwrite($this->fp, 'SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;' . PHP_EOL);
        fwrite($this->fp, 'SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;' . PHP_EOL);
        fwrite($this->fp, '-- -------------------------------------------' . PHP_EOL);
        $this->writeComment('START BACKUP');
        return true;
    }

    public function EndBackup($addcheck = true) {
        fwrite($this->fp, '-- -------------------------------------------' . PHP_EOL);
        fwrite($this->fp, 'SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;' . PHP_EOL);
        fwrite($this->fp, 'SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;' . PHP_EOL);

        if ($addcheck) {
            fwrite($this->fp, 'COMMIT;' . PHP_EOL);
        }
        fwrite($this->fp, '-- -------------------------------------------' . PHP_EOL);
        $this->writeComment('END BACKUP');
        fclose($this->fp);
        $this->fp = null;
    }

    public function writeComment($string) {
        fwrite($this->fp, '-- -------------------------------------------' . PHP_EOL);
        fwrite($this->fp, '-- ' . $string . PHP_EOL);
        fwrite($this->fp, '-- -------------------------------------------' . PHP_EOL);
    }

    public function actionCreate() {
        ini_set('max_execution_time', 0); //300 seconds = 5 minutes
        ini_set('memory_limit', '-1');
        $exclude_tables = array('lokasi', 'operation_trx');
        $tables = $this->getTables($exclude_tables);

        if (!$this->StartBackup()) {
            //render error
            return;
        }

        foreach ($tables as $tableName) {
            $this->getColumns($tableName);
        }
        foreach ($tables as $tableName) {
            $this->getData($tableName);
        }
        $this->EndBackup();

        $this->redirect(array('index'));
    }

    public function actionClean($redirect = true) {
        ini_set('max_execution_time', 0); //300 seconds = 5 minutes
        ini_set('memory_limit', '-1');
        $exclude_tables = array('access_log', 'operation', 'role', 'role_access', 'user', 'sourcemessage', 'message', 'pesan_inbox', 'pesan_outbox', 'mata_uang', 'cabang', 'lokasi', 'periode_mulai', 'saldo_awal_akun', 'nomor_transaksi', 'operation_trx');
        $tables = $this->getTables($exclude_tables);

        if (!$this->StartBackup()) {
            //render error
            return;
        }

        foreach ($tables as $tableName) {
            fwrite($this->fp, '-- -------------------------------------------' . PHP_EOL);
            fwrite($this->fp, 'DROP TABLE IF EXISTS ' . addslashes($tableName) . ';' . PHP_EOL);
            fwrite($this->fp, '-- -------------------------------------------' . PHP_EOL);
        }
        $this->EndBackup();

        // logout so there is no problme later .
        Yii::app()->user->logout();

        $this->execSqlFile($this->file_name);
        unlink($this->file_name);
        if ($redirect == true)
            $this->redirect(array('index'));
    }

    public function actionDelete($file = null) {
        $this->updateMenuItems();
        if (isset($file)) {
            $sqlFile = $this->path . basename($file);
            if (file_exists($sqlFile))
                unlink($sqlFile);
        } else
            throw new CHttpException(404, Yii::t('trans', 'File not found'));
        $this->actionIndex();
    }

    public function actionDownload($file = null) {
        $this->updateMenuItems();
        if (isset($file)) {
            $sqlFile = $this->path . basename($file);
            if (file_exists($sqlFile)) {
                $request = Yii::app()->getRequest();
                $request->sendFile(basename($sqlFile), file_get_contents($sqlFile));
            }
        }
        throw new CHttpException(404, Yii::t('trans', 'File not found'));
    }

    public function actionIndex() {
        $this->updateMenuItems();
        $path = $this->path;

        $dataArray = array();

        $list_files = glob($path . '*.sql');
        if ($list_files) {
            $list = array_map('basename', $list_files);
            sort($list);


            foreach ($list as $id => $filename) {
                $columns = array();
                $columns['id'] = $id;
                $columns['name'] = basename($filename);
                $columns['size'] = floor(filesize($path . $filename) / 1024) . ' KB';
                $columns['create_time'] = date(DATE_RFC822, filectime($path . $filename));
                $dataArray[] = $columns;
            }
        }
        $dataProvider = new CArrayDataProvider($dataArray);
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionSyncdown() {
        $tables = $this->getTables();

        if (!$this->StartBackup()) {
            //render error
            $this->render('create');
            return;
        }

        foreach ($tables as $tableName) {
            $this->getColumns($tableName);
        }
        foreach ($tables as $tableName) {
            $this->getData($tableName);
        }
        $this->EndBackup();
        $this->actionDownload(basename($this->file_name));
    }

    public function actionRestore($file = null) {
        ini_set('max_execution_time', 0); //300 seconds = 5 minutes
        ini_set('memory_limit', '-1');
        $this->updateMenuItems();
        $message = Yii::t('trans', 'OK. Done');
        $sqlFile = $this->path . 'install.sql';
        if (isset($file)) {
            $sqlFile = $this->path . basename($file);
        }

        $this->execSqlFile($sqlFile);
        $this->render('restore', array('error' => $message));
    }

    public function actionUpload() {
        ini_set('max_execution_time', 0); //300 seconds = 5 minutes
        ini_set('memory_limit', '-1');
        $model = new UploadForm('upload');
        $this->updateMenuItems($model);
        if (isset($_POST['UploadForm'])) {
            $model->attributes = $_POST['UploadForm'];
            $model->upload_file = CUploadedFile::getInstance($model, 'upload_file');
            if ($model->validate()) {
                if ($model->upload_file->saveAs($this->path . $model->upload_file)) {
                    // redirect to success page
                    $this->redirect(array('index'));
                }
            }
        }

        $this->render('upload', array('model' => $model));
    }

    protected function updateMenuItems($model = null) {
        // create static model if model is null
        if ($model == null)
            $model = new UploadForm('install');

        switch ($this->action->id) {
            case 'restore': {
                    
                }
            case 'create': {
                    $this->menu[] = array('label' => Yii::t('trans', 'List Backup') . ' ' . $model->label(2), 'url' => array('index'), 'icon' => 'list-alt', 'visible' => (Yii::app()->util->is_authorized('backup.default.index')) ? true : false);
                }
                break;
            case 'upload': {
                    $this->menu[] = array('label' => Yii::t('trans', 'List Backup') . ' ' . $model->label(2), 'url' => array('index'), 'icon' => 'list-alt', 'visible' => (Yii::app()->util->is_authorized('backup.default.index')) ? true : false);
                    $this->menu[] = array('label' => Yii::t('trans', 'Create Backup') . ' ' . $model->label(), 'url' => array('create'), 'icon' => 'file', 'visible' => (Yii::app()->util->is_authorized('backup.default.create')) ? true : false);
                }
                break;
            default: {
                    $this->menu[] = array('label' => Yii::t('trans', 'Create Backup') . ' ' . $model->label(), 'url' => array('create'), 'icon' => 'file', 'visible' => (Yii::app()->util->is_authorized('backup.default.create')) ? true : false);
                    $this->menu[] = array('label' => Yii::t('trans', 'Upload Backup') . ' ' . $model->label(), 'url' => array('upload'), 'icon' => 'upload', 'visible' => (Yii::app()->util->is_authorized('backup.default.upload')) ? true : false);
                    $this->menu[] = array('label' => Yii::t('trans', 'Restore Backup') . ' ' . $model->label(), 'url' => array('restore'), 'icon' => 'repeat', 'visible' => (Yii::app()->util->is_authorized('backup.default.restore')) ? true : false);
//                    $this->menu[] = array('label' => Yii::t('trans', 'Clean Database') . ' ' . $model->label(), 'url' => array('clean'), 'icon' => 'leaf', 'visible' => (Yii::app()->util->is_authorized('backup.default.clean')) ? true : false);
                }
                break;
        }
    }

}
