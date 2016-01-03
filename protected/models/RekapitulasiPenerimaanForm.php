<?php

/**
 * RekapitulasiPenerimaanForm class.
 * RekapitulasiPenerimaanForm is the data structure for keeping
 */
class RekapitulasiPenerimaanForm extends CFormModel {

    public $periode;
    public $menyetujui;
    public $mengetahui;
    public $diperiksa;
    public $kecamatan_id;
    public $kode_rekening_id;

    public function rules() {
        return array(
            array('periode, menyetujui, mengetahui, diperiksa', 'required'),
            array('periode, kode_rekening_id', 'numerical'),
            array('periode', 'check_periode'),
            array('kode_rekening_id, mengetahui, menyetujui, diperiksa, kecamatan_id', 'safe'),
        );
    }

    public function check_periode($attribute) {
        $flag = Spt::model()->exists('periode = ' . (int) $this->$attribute . ' AND kode_rekening_id=' . (int) $this->kode_rekening_id);
        if ($flag) {
            return;
        } else {
            $this->addError($attribute, Yii::t('trans', '{attribute} {value} tidak ada.', array('{attribute}' => $this->getAttributeLabel($attribute), '{value}' => $this->$attribute)));
        }
    }

    public function attributeLabels() {
        return array(
            'periode' => Yii::t('trans', 'Tahun'),
            'menyetujui' => Yii::t('trans', 'Menyetujui'),
            'mengetahui' => Yii::t('trans', 'Mengetahui'),
            'diperiksa' => Yii::t('trans', 'Diperiksa Oleh'),
            'kecamatan_id' => Yii::t('trans', 'Kecamatan'),
            'kode_rekening_id' => Yii::t('trans', 'Jenis Pajak'),
        );
    }

    public function getPejabatOptions() {
        return CHtml::listData(Pejabat::model()->findAll(), 'id', 'nipNama');
    }

    public function getKecamatanOptions() {
        return CHtml::listData(Kecamatan::model()->findAll(), 'id', 'nama');
    }

    public function getKodeRekeningOptions() {
        return Spt::model()->getKodeRekeningPajakOptions();
    }

    public function getKodeRekeningText() {
        $model = KodeRekening::model()->findByPk($this->kode_rekening_id);
        $nama = '';
        if ($model !== null) {
            $nama = $model->nama;
        }
        return $nama;
    }

}
