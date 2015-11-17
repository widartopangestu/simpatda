<?php

class ReportController extends Controller {

    public $layout = '//layouts/column1';

    public function init() {
        ini_set('max_execution_time', 300); //300 seconds = 5 minutes
        ini_set('memory_limit', '-1');
    }

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'WAuth',
        );
    }

    public function actionUserLog() {
        $model = new User('search');
        $model->unsetAttributes();  // clear any default values
        $model->status = User::STATUS_ACTIVE;
        if (isset($_GET['User'])) {
            $model->attributes = $_GET['User'];
        }

        Yii::app()->util->setLog(AccessLog::TYPE_INFO, Yii::t('trans', 'User Log Report'));

        $this->render('user_log_form', array(
            'model' => $model,
        ));
    }

    public function actionUserLogForm($id) {
        $title = Yii::t('trans', 'User Log Report {date}', array('{date}' => date('D j M Y G:i:s')));
        $filename = 'user_logs_report_' . date("d-m-Y_h:i:s-A");
        $model = new AccessLogReportForm;
        $model->dateFrom = date("01/m/Y");
        $model->dateTo = date("d/m/Y");
        $model->user = $id;

        $criteria = new CDbCriteria;
        $criteria->order = 'time DESC';
        if (isset($_POST['AccessLogReportForm'])) {
            $model->attributes = $_POST['AccessLogReportForm'];
            if ($model->validate()) {

                if ((isset($model->dateFrom) && trim($model->dateFrom) != "") && (isset($model->dateTo) && trim($model->dateTo) != ""))
                    $criteria->condition = "time BETWEEN UNIX_TIMESTAMP('" . date("Y-m-d", strtotime(date_format(date_create_from_format('d/m/Y', $model->dateFrom), "Y-m-d"))) . "') AND UNIX_TIMESTAMP('" . date("Y-m-d", strtotime(date_format(date_create_from_format('d/m/Y', $model->dateTo), "Y-m-d") . ' +1 day')) . "')";

                if ((isset($model->user) && trim($model->user) != ""))
                    $criteria->addCondition('user_id=' . $model->user);
            }
        } else {
            $user = User::model()->findByPk($model->user);
            if ($user === null) {
                throw new CHttpException(404, Yii::t('trans', 'The requested page does not exist.'));
            }
            $criteria->addCondition('user_id=' . $model->user);
            $criteria->condition = "time BETWEEN UNIX_TIMESTAMP('" . date("Y-m-d", strtotime(date_format(date_create_from_format('d/m/Y', $model->dateFrom), "Y-m-d"))) . "') AND UNIX_TIMESTAMP('" . date("Y-m-d", strtotime(date_format(date_create_from_format('d/m/Y', $model->dateTo), "Y-m-d") . ' +1 day')) . "')";
        }
        $dataProvider = new CActiveDataProvider('AccessLog', array(
            'criteria' => $criteria,
            'pagination' => FALSE,
        ));
        if (isset($_POST['type_report']) && $_POST['type_report'] == 'pdf') {
            $filename = $filename . '.pdf';
            Yii::app()->util->setLog(AccessLog::TYPE_SUCCESS, Yii::t('trans', 'Export User Logs Report To PDF > \'filename\' : {filename}', array('{filename}' => $filename)));
            $this->layout = '//layouts/report';
            $mPDF1 = Yii::app()->ePdf->mpdf('', 'A4-L');

            $stylesheet = file_get_contents(Yii::getPathOfAlias('webroot') . '/css/tabel_report.css'); /// here call you external css file 
            $mPDF1->WriteHTML($stylesheet, 1);
            $mPDF1->SetFooter('Dicetak tgl : ' . date('d/m/Y') . '|' . Yii::app()->name . '|{PAGENO}');
            $mPDF1->WriteHTML($this->renderPartial('user_log_print', array('title' => $title, 'model' => $model, 'dataProvider' => $dataProvider), true));
            $mPDF1->Output($filename, 'D');
        } else if (isset($_POST['type_report']) && $_POST['type_report'] == 'excel') {
            $author = User::model()->findByPk(Yii::app()->user->id)->nickname;
            $filename = $filename . '.xlsx';
            $titleSheet = 'User Log Report';
            Yii::app()->util->setLog(AccessLog::TYPE_SUCCESS, Yii::t('trans', 'Export User Logs Report To Excel > \'filename\' : {filename}', array('{filename}' => $filename)));
            spl_autoload_unregister(array('YiiBase', 'autoload'));
            Yii::import('application.vendors.phpexcel.PHPExcel', true);
            spl_autoload_register(array('YiiBase', 'autoload'));
            $objPHPExcel = new PHPExcel();
            $objPHPExcel->getProperties()->setCreator($author)
                    ->setLastModifiedBy($author)
                    ->setTitle($title);

            $objPHPExcel->setActiveSheetIndex(0)->mergeCells("A1:J1");
            $objPHPExcel->setActiveSheetIndex(0)->getCell("A1")->setValue($title);

            $objPHPExcel->setActiveSheetIndex(0)->mergeCells("A3:C3");
            $objPHPExcel->setActiveSheetIndex(0)->getCell("A3")->setValue(Yii::t('trans', 'User') . ' : ');
            $objPHPExcel->setActiveSheetIndex(0)->mergeCells("D3:J3");
            $objPHPExcel->setActiveSheetIndex(0)->getCell("D3")->setValue((!empty($model->user)) ? User::model()->findByPk($model->user)->username : Yii::t('trans', 'All User'));
            $objPHPExcel->setActiveSheetIndex(0)->mergeCells("A4:C4");
            $objPHPExcel->setActiveSheetIndex(0)->getCell("A4")->setValue(Yii::t('trans', 'Date Activity') . ' : ');
            $objPHPExcel->setActiveSheetIndex(0)->mergeCells("D4:J4");
            $objPHPExcel->setActiveSheetIndex(0)->getCell("D4")->setValue($model->dateFrom . ' to ' . $model->dateTo);

            // Tabel Header
            $header = array('No', 'type', 'User', 'Activity', 'Time');
            $no = '7';
            $char_h = 'A';
            $start_cell = "$char_h$no";
            foreach ($header as $value) {
                $objPHPExcel->setActiveSheetIndex(0)->getCell($char_h . $no)->setValue($value);
                $objPHPExcel->getActiveSheet()->getColumnDimension($char_h)->setAutoSize(true);
                $lst_char = $char_h;
                $char_h++;
            }
            $objPHPExcel->setActiveSheetIndex(0)->getStyle("$start_cell:$lst_char$no")->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            // Tabel Body
            $no = '8';
            if ($dataProvider->itemCount > 0) {
                $i = 1;
                foreach ($dataProvider->getData() as $id => $singleRecord) {
                    // Data row
                    $data_row = array($i++, $singleRecord->typeText, $singleRecord->user->nickname, $singleRecord->activity, date('d-m-Y h:i:s A', $singleRecord->time));
                    $char_dr = 'A';
                    $start_cell_dr = "$char_dr$no";
                    foreach ($data_row as $value) {
                        $objPHPExcel->setActiveSheetIndex(0)->getCell($char_dr . $no)->setValue($value);
                        $objPHPExcel->getActiveSheet()->getColumnDimension($char_dr)->setAutoSize(true);
                        $lst_char_dr = $char_dr;
                        $char_dr++;
                    }
                    $objPHPExcel->setActiveSheetIndex(0)->getStyle("$start_cell_dr:$lst_char_dr$no")->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    $no++;
                }
            } else {
                $objPHPExcel->setActiveSheetIndex(0)->mergeCells("A8:" . $lst_char . "8");
                $objPHPExcel->setActiveSheetIndex(0)->getCell('A8')->setValue('There is no activity.');
                $objPHPExcel->setActiveSheetIndex(0)->getStyle("A8:" . $lst_char . "8")->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            }

            $objPHPExcel->getActiveSheet()->setTitle($titleSheet);
            $objPHPExcel->setActiveSheetIndex(0);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="' . $filename . '"');
            header('Cache-Control: max-age=0');

            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            ob_end_clean();
            $objWriter->save('php://output');
            exit;
        }
        $this->render('user_log', array('title' => $title, 'model' => $model, 'dataProvider' => $dataProvider));
    }

}
