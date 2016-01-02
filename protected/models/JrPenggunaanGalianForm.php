<?php

/**
 * JrPenggunaanGalianForm class.
 * JrPenggunaanGalianForm is the data structure for keeping
 */
class JrPenggunaanGalianForm extends CFormModel {

    public $mengetahui;
    public $pembuat;
    public $periode;

    public function rules() {
        return array(
            array('mengetahui, pembuat, periode', 'required'),
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
        );
    }

    public function getPejabatOptions() {
        return CHtml::listData(Pejabat::model()->findAll(), 'id', 'nipNama');
    }

}
