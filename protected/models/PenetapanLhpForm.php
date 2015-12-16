<?php

/**
 * PenetapanLhpForm class.
 * PenetapanLhpForm is the data structure for keeping
 */
class PenetapanLhpForm extends CFormModel {

    public $periode;
    public $pemeriksaan_from;
    public $pemeriksaan_to;
    public $tanggal_penetapan;

    public function rules() {
        return array(
            array('periode, pemeriksaan_from, pemeriksaan_to, tanggal_penetapan', 'required'),
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
            'pemeriksaan_from' => Yii::t('trans', 'Dari Nomor LHP'),
            'pemeriksaan_to' => Yii::t('trans', 's/d Nomor LHP'),
            'periode' => Yii::t('trans', 'Periode LHP'),
            'tanggal_penetapan' => Yii::t('trans', 'Tanggal Penetapan'),
        );
    }

}
