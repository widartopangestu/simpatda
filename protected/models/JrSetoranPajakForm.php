<?php

/**
 * JrSetoranPajakForm class.
 * JrSetoranPajakForm is the data structure for keeping
 */
class JrSetoranPajakForm extends CFormModel {

    public $periode;
    public $nomor_from;
    public $nomor_to;
    public $mengetahui;
    public $bendahara;
    public $tanggal;

    public function rules() {
        return array(
            array('periode, nomor_from, nomor_to, mengetahui, bendahara, tanggal', 'required'),
            array('periode', 'numerical'),
            array('periode', 'check_periode'),
            array('nomor_from, nomor_to, mengetahui, bendahara, tanggal', 'safe'),
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
            'nomor_from' => Yii::t('trans', 'Dari Nomor'),
            'nomor_to' => Yii::t('trans', 's/d. Nomor'),
            'mengetahui' => Yii::t('trans', 'Mengetahui'),
            'bendahara' => Yii::t('trans', 'Bendahara'),
            'tanggal' => Yii::t('trans', 'Tgl. Cetak'),
        );
    }

    public function getPejabatOptions() {
        return CHtml::listData(Pejabat::model()->findAll(), 'id', 'nipNama');
    }

}
