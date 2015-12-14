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
            array('nomor_from, nomor_to, mengetahui, diperiksa', 'safe'),
        );
    }

    public function attributeLabels() {
        return array(
            'periode' => Yii::t('trans', 'Periode'),
            'nomor_from' => Yii::t('trans', 'Nomor SPT Dari'),
            'nomor_to' => Yii::t('trans', 's/d. Nomor'),
            'mengetahui' => Yii::t('trans', 'Mengetahui'),
            'diperiksa' => Yii::t('trans', 'Diperiksa Oleh'),
        );
    }

    public function getPejabatOptions() {
        return CHtml::listData(Pejabat::model()->findAll(), 'id', 'nipNama');
    }

}