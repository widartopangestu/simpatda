<?php

/**
 * KartuDataForm class.
 * KartuDataForm is the data structure for keeping
 */
class KartuDataForm extends CFormModel {

    public $periode;
    public $wajib_pajak_id;
    public $npwpd;
    public $diperiksa;
    public $mengetahui;

    public function rules() {
        return array(
            array('periode, npwpd, diperiksa, mengetahui', 'required'),
            array('periode', 'numerical'),
            array('periode', 'check_periode'),
            array('npwpd, diperiksa, mengetahui, wajib_pajak_id', 'safe'),
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
            'periode' => Yii::t('trans', 'Periode'),
            'npwpd' => Yii::t('trans', 'NPWPD'),
            'diperiksa' => Yii::t('trans', 'Diperiksa Oleh'),
            'mengetahui' => Yii::t('trans', 'Mengetahui'),
        );
    }

    public function getPejabatOptions() {
        return CHtml::listData(Pejabat::model()->findAll(), 'id', 'nipNama');
    }

}
