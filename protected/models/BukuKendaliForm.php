<?php

/**
 * BukuKendaliForm class.
 * BukuKendaliForm is the data structure for keeping
 */
class BukuKendaliForm extends CFormModel {

    public $tanggal;
    public $date_from;
    public $date_to;
    public $menyetujui;
    public $mengetahui;
    public $diperiksa;
    public $kecamatan_id;
    public $jenis_pajak;
    public $jenis_surat_id;

    public function rules() {
        return array(
            array('tanggal, date_from, date_to, menyetujui, mengetahui, diperiksa', 'required'),
            array('jenis_pajak, jenis_surat_id, mengetahui, menyetujui, diperiksa, kecamatan_id', 'safe'),
            array('date_to', 'dateCompare', 'compareAttribute' => 'date_from', 'operator' => '>=', 'format' => 'dd/MM/yyyy', 'allowEmpty' => TRUE),
        );
    }

    public function attributeLabels() {
        return array(
            'tanggal' => Yii::t('trans', 'Tanggal Cetak'),
            'date_from' => Yii::t('trans', 'Masa Pajak Dari'),
            'date_to' => Yii::t('trans', 's/d.'),
            'menyetujui' => Yii::t('trans', 'Menyetujui'),
            'mengetahui' => Yii::t('trans', 'Mengetahui'),
            'diperiksa' => Yii::t('trans', 'Diperiksa Oleh'),
            'kecamatan_id' => Yii::t('trans', 'Kecamatan'),
            'jenis_pajak' => Yii::t('trans', 'Jenis Pajak'),
            'jenis_surat_id' => Yii::t('trans', 'Status SPT'),
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

    public function getJenisSuratOptions() {
        return CHtml::listData(JenisSurat::model()->findAll(), 'id', 'nama');
    }

    public function dateCompare($attribute, $params) {

        if (empty($params['compareAttribute']) || empty($params['operator']))
            $this->addError($attribute, Yii::t('trans', 'Invalid Parameters'));

        $compareTo = $this->$params['compareAttribute'];

        if ($params['allowEmpty'] && (empty($this->$attribute) || empty($compareTo)))
            return;

        //set default format if not specified
        $format = (!empty($params['format'])) ? $params['format'] : 'yyyy-MM-dd';
        //default operator to >
        $compare = (!empty($params['operator'])) ? $params['operator'] : ">";

        $start = CDateTimeParser::parse($this->$attribute, $format);
        $end = CDateTimeParser::parse($compareTo, $format);
        //a little php trick - safe than eval and easier than a big switch statement
        if (version_compare($start, $end, $compare)) {
            return;
        } else {
            $this->addError($attribute, Yii::t('trans', '{attribute1} must be {compare} then {attribute2}', array('{attribute1}' => $this->getAttributeLabel($attribute), '{attribute2}' => $this->getAttributeLabel($params['compareAttribute']), '{compare}' => $compare)));
        }
    }

}
