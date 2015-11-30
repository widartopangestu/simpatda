<?php

/**
 * TutupWajibPajakForm class.
 * TutupWajibPajakForm is the data structure for keeping
 */
class TutupWajibPajakForm extends CFormModel {

    public $tanggal_tutup;
    public $wajib_pajak_id;
    public $npwpd;
    public $nama;
    public $alamat;
    public $kecamatan;
    public $kelurahan;
    public $kabupaten;
    public $no_ba;
    public $isi_ba;

    public function rules() {
        return array(
            array('tanggal_tutup, npwpd, no_ba, isi_ba', 'required'),
            array('wajib_pajak_id, nama, alamat, kabupaten, kecamatan, kelurahan', 'safe'),
        );
    }

    public function attributeLabels() {
        return array(
            'tanggal_tutup' => Yii::t('trans', 'Tgl. Tutup'),
            'npwpd' => Yii::t('trans', 'NPWPD'),
            'nama' => Yii::t('trans', 'Nama WP'),
            'alamat' => Yii::t('trans', 'Alamat'),
            'kecamatan' => Yii::t('trans', 'Kecamatan'),
            'kelurahan' => Yii::t('trans', 'Kelurahan'),
            'kabupaten' => Yii::t('trans', 'Kabupaten'),
            'no_ba' => Yii::t('trans', 'No. Berita Acara'),
            'isi_ba' => Yii::t('trans', 'Isi Berita Acara'),
        );
    }

}
