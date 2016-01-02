<?php

/**
 * JrBpsReklameForm class.
 * JrBpsReklameForm is the data structure for keeping
 */
class JrBpsReklameForm extends CFormModel {

    public $mengetahui;
    public $pembuat;
    public $tanggal;
    public $bulan;
    public $periode;

    public function rules() {
        return array(
            array('mengetahui, pembuat, tanggal, periode, bulan', 'required'),
            array('periode', 'numerical'),
            array('periode', 'check_periode'),
            array('mengetahui, pembuat', 'safe'),
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
            'mengetahui' => Yii::t('trans', 'Mengetahui'),
            'pembuat' => Yii::t('trans', 'Pembuat'),
            'tanggal' => Yii::t('trans', 'Tgl. Cetak'),
            'periode' => Yii::t('trans', 'Tahun'),
            'bulan' => Yii::t('trans', 'Bulan'),
        );
    }

    public function getPejabatOptions() {
        return CHtml::listData(Pejabat::model()->findAll(), 'id', 'nipNama');
    }

}
