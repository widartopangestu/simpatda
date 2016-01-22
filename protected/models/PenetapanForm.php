<?php

/**
 * PenetapanForm class.
 * PenetapanForm is the data structure for keeping
 */
class PenetapanForm extends CFormModel {

    public $periode;
    public $spt_from;
    public $spt_to;
    public $tanggal_penetapan;

    public function rules() {
        return array(
            array('periode, spt_from, spt_to, tanggal_penetapan', 'required'),
            array('periode', 'numerical'),
            array('periode', 'check_periode'),
        );
    }

    public function check_periode($attribute) {
        $flag = Spt::model()->exists('periode = ' . (int) $this->$attribute);
        if ($flag) {
            return;
        } else {
            $this->addError($attribute, Yii::t('trans', '{attribute} {value} tidak ada.', array('{attribute}' => $this->getAttributeLabel($attribute), '{value}' => $this->$attribute)));
        }
    }

    public function attributeLabels() {
        return array(
            'spt_from' => Yii::t('trans', 'Dari Nomor SPT'),
            'spt_to' => Yii::t('trans', 's/d.'),
            'periode' => Yii::t('trans', 'Periode SPT'),
            'tanggal_penetapan' => Yii::t('trans', 'Tanggal Penetapan'),
        );
    }

}
