<?php

/**
 * JrBppsDetailForm class.
 * JrBppsDetailForm is the data structure for keeping
 */
class JrBppsDetailForm extends CFormModel {

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
            array('kode_rekening_id', 'check_not_parent'),
            array('date_from, date_to, mengetahui, bendahara, kecamatan_id, kode_rekening_id, via_bayar', 'safe'),
        );
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
        return KodeRekening::model()->getParentTreeOptions(421);
    }

}
