<?php

/**
 * SuratTeguranForm class.
 * SuratTeguranForm is the data structure for keeping
 */
class SuratTeguranForm extends CFormModel {

    public $periode;
    public $wajib_pajak_id;
    public $npwpd;
    public $tanggal_proses;
    public $tanggal;
    public $mengetahui;

    public function rules() {
        return array(
            array('periode, npwpd, tanggal_proses, mengetahui, tanggal', 'required'),
            array('periode', 'numerical'),
            array('periode', 'check_periode'),
            array('npwpd, tanggal_proses, mengetahui, tanggal, wajib_pajak_id', 'safe'),
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
            'tanggal_proses' => Yii::t('trans', 'Tgl. Proses'),
            'mengetahui' => Yii::t('trans', 'Mengetahui'),
            'tanggal' => Yii::t('trans', 'Tgl. Cetak'),
        );
    }

    public function getPejabatOptions() {
        return CHtml::listData(Pejabat::model()->findAll(), 'id', 'nipNama');
    }

}
