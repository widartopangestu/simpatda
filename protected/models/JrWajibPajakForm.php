<?php

/**
 * JrWajibPajakForm class.
 * JrWajibPajakForm is the data structure for keeping
 */
class JrWajibPajakForm extends CFormModel {

    public $status;
    public $jenis;
    public $golongan;
    public $kode_rekening;
    public $kecamatan;
    public $kelurahan;
    public $mengetahui;
    public $diperiksa;
    public $tanggal;

    public function rules() {
        return array(
            array('jenis, mengetahui, diperiksa, tanggal', 'required'),
            array('status, jenis, golongan, kode_rekening, kecamatan, kelurahan, mengetahui, diperiksa, tanggal', 'safe'),
        );
    }

    public function attributeLabels() {
        return array(
            'status' => Yii::t('trans', 'Aktif Status'),
            'jenis' => Yii::t('trans', 'Jenis'),
            'golongan' => Yii::t('trans', 'Golongan'),
            'kode_rekening' => Yii::t('trans', 'Kode Rekening'),
            'kecamatan' => Yii::t('trans', 'Kecamatan'),
            'kelurahan' => Yii::t('trans', 'Kelurahan'),
            'mengetahui' => Yii::t('trans', 'Mengetahui'),
            'diperiksa' => Yii::t('trans', 'Diperiksa oleh'),
            'tanggal' => Yii::t('trans', 'Tgl. Cetak'),
        );
    }

    public function getStatusOptions() {
        return WajibPajak::model()->getStatusOptions();
    }

    public function getJenisOptions() {
        return WajibPajak::model()->getJenisOptions();
    }

    public function getGolonganOptions() {
        return WajibPajak::model()->getGolonganOptions();
    }

    public function getKelurahanOptions() {
        if ($this->kecamatan)
            return CHtml::listData(Kelurahan::model()->findAll('kecamatan_id=:kecamatan_id', array(':kecamatan_id' => $this->kecamatan)), 'id', 'nama');
        else
            return array(); //CHtml::listData(Kelurahan::model()->findAll(), 'id', 'nama');
    }

    public function getKecamatanOptions() {
        return CHtml::listData(Kecamatan::model()->findAll(), 'id', 'nama');
    }

    public function getKodeRekeningOptions() {
        return KodeRekening::model()->getParentTreeOptions();
    }

    public function getPejabatOptions() {
        return CHtml::listData(Pejabat::model()->findAll(), 'id', 'nipNama');
    }

}
