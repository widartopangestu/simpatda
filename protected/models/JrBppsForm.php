<?php

/**
 * JrBppsForm class.
 * JrBppsForm is the data structure for keeping
 */
class JrBppsForm extends CFormModel {

    public $kode_rekening_id;
    public $kecamatan_id;
    public $via_bayar;
    public $date_from;
    public $date_to;
    public $mengetahui;
    public $bendahara;

    public function rules() {
        return array(
            array('date_from, date_to, mengetahui, bendahara, via_bayar', 'required'),
            array('kode_rekening_id', 'numerical'),
            array('date_from, date_to, mengetahui, bendahara, kecamatan_id, kode_rekening_id, via_bayar', 'safe'),
        );
    }

    public function attributeLabels() {
        return array(
            'kode_rekening_id' => Yii::t('trans', 'Kode Rekening'),
            'kecamatan_id' => Yii::t('trans', 'Kecamatan'),
            'via_bayar' => Yii::t('trans', 'BPPS Melalui'),
            'date_from' => Yii::t('trans', 'Tanggal Proses'),
            'date_to' => Yii::t('trans', 's/d. Tanggal'),
            'mengetahui' => Yii::t('trans', 'Mengetahui'),
            'bendahara' => Yii::t('trans', 'Bendahara'),
        );
    }

    public function getViaBayarOptions() {
        return SetoranPajak::model()->getViaBayarOptions();
    }

    public function getKecamatanOptions() {
        return CHtml::listData(Kecamatan::model()->findAll(), 'id', 'nama');
    }

    public function getPejabatOptions() {
        return CHtml::listData(Pejabat::model()->findAll(), 'id', 'nipNama');
    }

    public function getKodeRekeningOptions() {
        return Spt::model()->getKodeRekeningPajakOptions();
    }

}
