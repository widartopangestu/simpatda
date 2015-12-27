<?php

/**
 * KartuDataForm class.
 * KartuDataForm is the data structure for keeping
 */
class KartuDataForm extends CFormModel {

    public $periode;
    public $wajib_pajak_id;
    public $npwpd;
    public $diperiksa;
    public $mengetahui;
    public $kode_rekening_id;

    public function rules() {
        return array(
            array('periode, npwpd, diperiksa, mengetahui, kode_rekening_id', 'required'),
            array('periode', 'numerical'),
            array('periode', 'check_periode'),
            array('npwpd, diperiksa, mengetahui, wajib_pajak_id, kode_rekening_id', 'safe'),
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
            'periode' => Yii::t('trans', 'Periode'),
            'npwpd' => Yii::t('trans', 'NPWPD'),
            'diperiksa' => Yii::t('trans', 'Diperiksa Oleh'),
            'mengetahui' => Yii::t('trans', 'Mengetahui'),
            'kode_rekening_id' => Yii::t('trans', 'Kode Rekening'),
        );
    }

    public function getPejabatOptions() {
        return CHtml::listData(Pejabat::model()->findAll(), 'id', 'nipNama');
    }

    public function getKodeRekeningOptions() {
        $data = array();
        if ($this->wajib_pajak_id) {
            $sql = "SELECT kode_rekening_id, nama_kode_rekening FROM v_spt_wajib_pajak_periode
     where id=$this->wajib_pajak_id;"; // and periode=$this->periode
            $result = Yii::app()->db->createCommand($sql)->queryAll();
            foreach ($result as $item) {
                $data[$item['kode_rekening_id']] = $item['nama_kode_rekening'];
            }
        }
        return $data;
    }

}
