<?php

/**
 * JrProduksiGalianForm class.
 * JrProduksiGalianForm is the data structure for keeping
 */
class JrProduksiGalianForm extends CFormModel {

    public $mengetahui;
    public $pembuat;
    public $bulan_from;
    public $bulan_to;
    public $periode;

    public function rules() {
        return array(
            array('mengetahui, pembuat, periode, bulan_from, bulan_to', 'required'),
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
            'periode' => Yii::t('trans', 'Tahun'),
            'bulan_from' => Yii::t('trans', 'Dari Bulan'),
            'bulan_to' => Yii::t('trans', 's/d.'),
        );
    }

    public function getPejabatOptions() {
        return CHtml::listData(Pejabat::model()->findAll(), 'id', 'nipNama');
    }

}
