<?php

class JReportController extends Controller {

    public $layout = '//layouts/column1';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'WAuth',
        );
    }

    public function actionUserList() {
        $title = Yii::t('trans', 'Laporan Data Pengguna');
        $filename = 'masteruser_list_' . date("d-m-Y_h:i:s-A");
        $model = new JrUserForm();
        $html_report = '';
        if (isset($_POST['JrUserForm'])) {
            $model->attributes = $_POST['JrUserForm'];
            if ($model->validate()) {
                $filter = array();
                $where = '';
                if (isset($model->status) && trim($model->status) != "")
                    $filter[] = 'status=' . $model->status;
                if (isset($model->role_id) && trim($model->role_id) != "")
                    $filter[] = 'role_id=' . $model->role_id;

                if (count($filter)) {
                    $where = ' where ' . implode(' AND ', $filter);
                }
                $rep = new WPJasper();
                $reportId = 'ag_user_list';
                $params = array(
                    'Par_JudulLaporan' => Yii::t('trans', 'MASTER USER REPORT'),
                    'Par_SubJudulLaporan' => Yii::t('trans', 'By User Name'),
                    'Par_SQL' => 'select * from v_userlist' . $where,
                );
                if (isset($_POST['type_report'])) {
                    $rep->generateReport($reportId, $_POST['type_report'], $params, $filename);
                } else {
                    $html_report = $rep->generateReport($reportId, WPJasper::FORMAT_HTML, $params, $filename);
                }
            }
        }
        $this->render('masteruser_list', array(
            'model' => $model,
            'title' => $title,
            'html_report' => $html_report,
        ));
    }

    public function actionUserActivityList() {
        $title = Yii::t('trans', 'Laporan Aktifitas Pengguna');
        $filename = 'masteruser_activity_list_' . date("d-m-Y_h:i:s-A");
        $model = new JrUserActivityForm();
        $model->date_from = date("01/m/Y");
        $model->date_to = date("d/m/Y");
        $model->user_id = Yii::app()->user->id;
        $html_report = '';
        if (isset($_POST['JrUserActivityForm'])) {
            $model->attributes = $_POST['JrUserActivityForm'];
            if ($model->validate()) {
                $filter = array();
                $where = '';
                if ((isset($model->date_from) && trim($model->date_from) != "") && (isset($model->date_to) && trim($model->date_to) != ""))
                    $filter[] = "time BETWEEN UNIX_TIMESTAMP('" . date("Y-m-d", strtotime(date_format(date_create_from_format('d/m/Y', $model->date_from), "Y-m-d"))) . "') AND UNIX_TIMESTAMP('" . date("Y-m-d", strtotime(date_format(date_create_from_format('d/m/Y', $model->date_to), "Y-m-d") . ' +1 day')) . "')";
                if (isset($model->user_id) && trim($model->user_id) != "")
                    $filter[] = 'user_id=' . $model->user_id;

                if (count($filter)) {
                    $where = ' where ' . implode(' AND ', $filter);
                }
                $rep = new WPJasper();
                $reportId = 'ag_user_log';
                $params = array(
                    'Par_JudulLaporan' => Yii::t('trans', 'USER ACTIVITIES LOG REPORT'),
                    'Par_SubJudulLaporan' => Yii::t('trans', 'By User Name'),
                    'Par_SQL' => 'select * from v_userlog' . $where,
                );
                if (isset($_POST['type_report'])) {
                    $rep->generateReport($reportId, $_POST['type_report'], $params, $filename);
                } else {
                    $html_report = $rep->generateReport($reportId, WPJasper::FORMAT_HTML, $params, $filename);
                }
            }
        }
        $this->render('masteruseractivity_list', array(
            'model' => $model,
            'title' => $title,
            'html_report' => $html_report,
        ));
    }

}
