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
            array('npwpd, tanggal_proses, mengetahui, tanggal, wajib_pajak_id', 'safe'),
        );
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
