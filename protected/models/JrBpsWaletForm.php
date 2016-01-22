<?php

/**
 * JrBpsWaletForm class.
 * JrBpsWaletForm is the data structure for keeping
 */
class JrBpsWaletForm extends CFormModel {

    public $date_from;
    public $date_to;
    public $mengetahui;
    public $pembuat;

    public function rules() {
        return array(
            array('date_from, date_to, mengetahui, pembuat', 'required'),
            array('date_to', 'dateCompare', 'compareAttribute' => 'date_from', 'operator' => '>=', 'format' => 'dd/MM/yyyy', 'allowEmpty' => TRUE),
            array('date_from, date_to, mengetahui, pembuat', 'safe'),
        );
    }

    public function attributeLabels() {
        return array(
            'date_from' => Yii::t('trans', 'Tanggal Proses'),
            'date_to' => Yii::t('trans', 's/d.'),
            'mengetahui' => Yii::t('trans', 'Mengetahui'),
            'pembuat' => Yii::t('trans', 'Pembuat'),
        );
    }

    public function getPejabatOptions() {
        return CHtml::listData(Pejabat::model()->findAll(), 'id', 'nipNama');
    }

    public function dateCompare($attribute, $params) {

        if (empty($params['compareAttribute']) || empty($params['operator']))
            $this->addError($attribute, Yii::t('trans', 'Invalid Parameters'));

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
            $this->addError($attribute, Yii::t('trans', '{attribute1} must be {compare} then {attribute2}', array('{attribute1}' => $this->getAttributeLabel($attribute), '{attribute2}' => $this->getAttributeLabel($params['compareAttribute']), '{compare}' => $compare)));
        }
    }

}
