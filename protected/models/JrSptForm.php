<?php

/**
 * JrSptForm class.
 * JrSptForm is the data structure for keeping
 */
class JrSptForm extends CFormModel {

    public $periode;
    public $nomor_from;
    public $nomor_to;
    public $mengetahui;
    public $diperiksa;

    public function rules() {
        return array(
            array('periode, nomor_from, nomor_to, mengetahui, diperiksa', 'required'),
            array('periode', 'numerical'),
            array('periode', 'check_periode'),
            array('nomor_from, nomor_to, mengetahui, diperiksa', 'safe'),
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
            'nomor_from' => Yii::t('trans', 'Nomor SPT Dari'),
            'nomor_to' => Yii::t('trans', 's/d.'),
            'mengetahui' => Yii::t('trans', 'Mengetahui'),
            'diperiksa' => Yii::t('trans', 'Diperiksa Oleh'),
        );
    }

    public function getPejabatOptions() {
        return CHtml::listData(Pejabat::model()->findAll(), 'id', 'nipNama');
    }

}
