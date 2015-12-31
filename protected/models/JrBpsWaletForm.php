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
            array('date_from, date_to, mengetahui, pembuat', 'safe'),
        );
    }

    public function attributeLabels() {
        return array(
            'date_from' => Yii::t('trans', 'Tanggal Proses'),
            'date_to' => Yii::t('trans', 's/d. Tanggal'),
            'mengetahui' => Yii::t('trans', 'Mengetahui'),
            'pembuat' => Yii::t('trans', 'Pembuat'),
        );
    }

    public function getPejabatOptions() {
        return CHtml::listData(Pejabat::model()->findAll(), 'id', 'nipNama');
    }

}
