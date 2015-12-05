<?php

/**
 * PenetapanForm class.
 * PenetapanForm is the data structure for keeping
 */
class PenetapanForm extends CFormModel {

    public $periode;
    public $spt_from;
    public $spt_to;
    public $tanggal_penetapan;

    public function rules() {
        return array(
            array('periode, spt_from, spt_to, tanggal_penetapan', 'required'),
        );
    }

    public function attributeLabels() {
        return array(
            'spt_from' => Yii::t('trans', 'Dari Nomor SPT'),
            'spt_to' => Yii::t('trans', 's/d Nomor SPT'),
            'periode' => Yii::t('trans', 'Periode SPT'),
            'tanggal_penetapan' => Yii::t('trans', 'Tanggal Penetapan'),
        );
    }

}
