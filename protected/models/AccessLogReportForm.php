<?php

class AccessLogReportForm extends CFormModel {

    public $dateFrom;
    public $dateTo;
    public $user;

    public function rules() {
        return array(
            array('dateFrom, dateTo', 'required'),
            array('user', 'safe'),
            array('dateTo', 'dateCompare', 'compareAttribute' => 'dateFrom', 'operator' => '>', 'format' => 'dd/MM/yyyy', 'allowEmpty' => TRUE),
        );
    }

    public function attributeLabels() {
        return array(
            'dateFrom' => Yii::t('access_log', 'Date From'),
            'dateTo' => Yii::t('access_log', 'Date To'),
            'user' => Yii::t('access_log', 'User'),
        );
    }

    public function getUserOptions() {
        return CHtml::listData(User::model()->findAll('status=' . User::STATUS_ACTIVE), 'id', 'username');
    }

    public function dateCompare($attribute, $params) {

        if (empty($params['compareAttribute']) || empty($params['operator']))
            $this->addError($attribute, 'Invalid Parameters to dateCompare');

        $compareTo = $this->$params['compareAttribute'];

        if ($params['allowEmpty'] && (empty($this->$attribute) || empty($compareTo)))
            return;

        //set default format if not specified
        $format = (!empty($params['format'])) ? $params['format'] : 'yyyy-MM-dd';
        //default operator to >
        $compare = (!empty($params['operator'])) ? $params['operator'] : ">";

        $start = CDateTimeParser::parse($this->$attribute, $format);
        $end = CDateTimeParser::parse($compareTo, $format);
        //a little php trick - safe than eval and easier than a big switch statement
        if (version_compare($start, $end, $compare)) {
            return;
        } else {
            $this->addError($attribute, 'Tanggal ' . $this->getAttributeLabel($attribute) . " must be $compare then " . $this->getAttributeLabel($params['compareAttribute']));
        }
    }

}

?>
