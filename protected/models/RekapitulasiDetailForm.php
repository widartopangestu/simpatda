<?php

/**
 * RekapitulasiDetailForm class.
 * RekapitulasiDetailForm is the data structure for keeping
 */
class RekapitulasiDetailForm extends CFormModel {

    public $periode;
    public $menyetujui;
    public $mengetahui;
    public $diperiksa;
    public $kecamatan_id;
    public $kode_rekening_id;

    public function rules() {
        return array(
            array('periode, menyetujui, mengetahui, diperiksa, kode_rekening_id', 'required'),
            array('periode, kode_rekening_id', 'numerical'),
            array('kode_rekening_id', 'check_not_parent'),
            array('periode', 'check_periode'),
            array('kode_rekening_id, menyetujui, mengetahui, diperiksa, kecamatan_id', 'safe'),
        );
    }

    public function check_periode($attribute) {
        if ($this->kode_rekening_id) {
            $check = array_key_exists($this->kode_rekening_id, Spt::model()->getKodeRekeningPajakOptions());
            if (!$check) {
                $flag = Spt::model()->exists('periode = ' . (int) $this->$attribute . ' AND kode_rekening_id=' . (int) KodeRekening::model()->getParentJenisPajak($this->kode_rekening_id)->id);
                if ($flag) {
                    return;
                } else {
                    $this->addError($attribute, Yii::t('trans', '{attribute} {value} tidak ada.', array('{attribute}' => $this->getAttributeLabel($attribute), '{value}' => $this->$attribute)));
                }
            }
        }
    }

    public function check_not_parent($attribute) {
        $flag = array_key_exists($this->$attribute, Spt::model()->getKodeRekeningPajakOptions());
        if ($flag) {
            $this->addError($attribute, Yii::t('trans', 'Tidak boleh memilih kode rekening parent.'));
        }
        return;
    }

    public function attributeLabels() {
        return array(
            'periode' => Yii::t('trans', 'Tahun'),
            'menyetujui' => Yii::t('trans', 'Menyetujui'),
            'mengetahui' => Yii::t('trans', 'Mengetahui'),
            'diperiksa' => Yii::t('trans', 'Diperiksa Oleh'),
            'kecamatan_id' => Yii::t('trans', 'Kecamatan'),
            'kode_rekening_id' => Yii::t('trans', 'Kode Rekening'),
        );
    }

    public function getPejabatOptions() {
        return CHtml::listData(Pejabat::model()->findAll(), 'id', 'nipNama');
    }

    public function getKecamatanOptions() {
        return CHtml::listData(Kecamatan::model()->findAll(), 'id', 'nama');
    }

    public function getKodeRekeningOptions() {
        return KodeRekening::model()->getParentTreeOptions(421);
    }

}
