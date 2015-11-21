<?php

/**
 * Description of WPJasper
 *
 * @author "Widarto Pangestu" <pangestu2art@gmail.com>
 */
require_once(dirname(__FILE__) . '/../vendors/jasper/autoload.php');

use Jaspersoft\Client\Client;

class WPJasper extends CApplicationComponent {

    const FORMAT_HTML = 'html';
    const FORMAT_PDF = 'pdf';
    const FORMAT_EXCEL = 'xls';
    const FORMAT_DOC = 'docx';
    const FORMAT_RTF = 'rtf';
    const FORMAT_CSV = 'csv';
    const FORMAT_ODT = 'odt';
    const FORMAT_ODS = 'ods';
    const FORMAT_EXCEL07 = 'xlsx';

    private $serverUrl = "http://localhost:8082/jasperserver";
    private $username = "jasperadmin";
    private $password = "jasperadmin";
    private $orgId = null;
    private $mime_types = array(
        'pdf' => 'application/pdf',
        'xls' => 'application/vnd.ms-excel',
        'csv' => 'text/csv',
        'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'rtf' => 'text/rtf',
        'odt' => 'application/vnd.oasis.opendocument.text',
        'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
        'xlsx' => 'application/vnd.ms-excel'
    );
    protected $_client = null;
    protected $_report = null;

    function __construct() {
        $this->init();
    }

    public function init() {
        if (isset(Yii::app()->params['jasper_url']) && isset(Yii::app()->params['jasper_username']) && isset(Yii::app()->params['jasper_password'])) {
            $this->serverUrl = Yii::app()->params['jasper_url'];
            $this->username = Yii::app()->params['jasper_username'];
            $this->password = Yii::app()->params['jasper_password'];
        }
        $this->_client = new Client($this->serverUrl, $this->username, $this->password, $this->orgId);
    }

    private function reportToDownload($data, $fileName, $format) {
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Description: File Transfer');
        header('Content-Disposition: attachment; filename=' . $fileName . '.' . $format);
        header('Content-Transfer-Encoding: binary');
        header('Content-Length: ' . strlen($data));
        if (isset($this->mime_types[$format])) {
            header('Content-Type: ' . $this->mime_types[$format]);
        } else {
            header('Content-Type: application/octet-stream');
        }
        echo $data;
    }

    public function getClient() {
        if ($this->_client == null)
            $this->init();
        return $this->_client;
    }

    public function generateReport($reportId, $format = 'pdf', $inputControls = null, $fileName = 'report', $pages = null) {
        $uri = '/reports/' . Yii::app()->session['user_choose_db'] . '/' . $reportId;
        $defaultControls = array(
            'CompanyName' => Yii::app()->params['company_name_report'],
            'CompanyAddress' => Yii::app()->params['company_address_report'],
            'CompanySlogan' => Yii::app()->params['company_description_report']
        );
        $inputControls = array_merge($defaultControls, $inputControls);

        try {
            ini_set('max_execution_time', 0);
            ini_set('memory_limit', '-1');
            $this->_client->setRequestTimeout(60 * 60);
            $report = $this->_client->reportService()->runReport($uri, $format, $pages, null, $inputControls);
            if ($format == self::FORMAT_HTML) {
                return $report;
            } else {
                $this->reportToDownload($report, $fileName, $format);
            }
        } catch (\Jaspersoft\Exception\RESTRequestException $e) {
//            printf('Caught Exception: %s', $e->getMessage());
            Yii::app()->util->setLog(AccessLog::TYPE_ERROR, Yii::t('trans', 'Caught Exception: {ex}', array('{ex}' => $e->getMessage())));
            Yii::app()->controller->refresh();
        }
    }

    public function getReports() {
        if (isset($_GET['uri'])) {
            $result = array();
            $repo = $this->client->getRepository($_GET['uri']);
            foreach ($repo as $r) {
                $result[] = array('name' => $r->getName(), 'uri' =>
                    $r->getUriString());
            }
            return $result;
        }
    }

    public function getTypes() {
        $result = array();
        foreach ($this->mime_types as $key => $val) {
            $result[] = array('name' => $key, 'value' => $val);
        }
        return $result;
    }

}

?>