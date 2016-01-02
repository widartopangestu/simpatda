<?php

/**
 * This is the model class for table "tmp_produksi_penerimaan_galian".
 *
 * The followings are the available columns in table 'tmp_produksi_penerimaan_galian':
 * @property string $session_id
 * @property integer $periode
 * @property integer $kode_rekening_id
 * @property string $kode_rekening
 * @property double $volume
 * @property double $tarip
 * @property double $jumlah
 * @property double $penerimaan
 * @property integer $bulan_from
 * @property integer $bulan_to
 */
class TmpProduksiPenerimaanGalian extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tmp_produksi_penerimaan_galian';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('session_id, periode, kode_rekening_id, kode_rekening', 'required'),
            array('periode, kode_rekening_id, bulan_from, bulan_to', 'numerical', 'integerOnly' => true),
            array('volume, tarip, jumlah, penerimaan', 'numerical'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('session_id, periode, kode_rekening_id, kode_rekening, volume, tarip, jumlah, penerimaan, bulan_from, bulan_to', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'session_id' => Yii::t('trans', 'Session'),
            'periode' => Yii::t('trans', 'Periode'),
            'kode_rekening_id' => Yii::t('trans', 'Kode Rekening'),
            'kode_rekening' => Yii::t('trans', 'Kode Rekening'),
            'volume' => Yii::t('trans', 'Volume'),
            'tarip' => Yii::t('trans', 'Tarip'),
            'jumlah' => Yii::t('trans', 'Jumlah'),
            'penerimaan' => Yii::t('trans', 'Penerimaan'),
            'bulan_from' => Yii::t('trans', 'Bulan From'),
            'bulan_to' => Yii::t('trans', 'Bulan To'),
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('session_id', $this->session_id, true);
        $criteria->compare('periode', $this->periode);
        $criteria->compare('kode_rekening_id', $this->kode_rekening_id);
        $criteria->compare('kode_rekening', $this->kode_rekening, true);
        $criteria->compare('volume', $this->volume);
        $criteria->compare('tarip', $this->tarip);
        $criteria->compare('jumlah', $this->jumlah);
        $criteria->compare('penerimaan', $this->penerimaan);
        $criteria->compare('bulan_from', $this->bulan_from);
        $criteria->compare('bulan_to', $this->bulan_to);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => Yii::app()->user->getState('pageSize' . $this->tableName(), Yii::app()->params['defaultPageSize']),
            ),
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return TmpProduksiPenerimaanGalian the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getSumNilai($periode, $kode_rekening_id, $bulan_from, $bulan_to) {
        $sql = "SELECT sum(nilai) as total FROM v_setoran_spt_item WHERE kode_rekening_id = $kode_rekening_id AND periode=$periode AND date_part('month', tanggal_bayar) BETWEEN $bulan_from AND $bulan_to ";
        $result = Yii::app()->db->createCommand($sql)->queryRow();
        return $result['total'];
    }

    public function generateData($periode, $bulan_from, $bulan_to, $use_session = true) {
        $session_id = $use_session ? session_id() : 1;
        $check = self::model()->exists("session_id='$session_id' AND periode=$periode AND bulan_from=$bulan_from AND bulan_to=$bulan_to");
        if (!$check || $periode == date("Y")) {
            if ($check)
                self::model()->deleteAll("session_id='$session_id' AND periode=$periode AND bulan_from=$bulan_from AND bulan_to=$bulan_to");
            $galians = KodeRekening::model()->getParentTreeOptions(Spt::PARENT_GALIAN);
            foreach ($galians as $key => $galian) {
                $kode_rekening = KodeRekening::model()->findByPk($key);
                $volume = $this->getSumNilai($periode, $key, $bulan_from, $bulan_to);
                $tmp_model = new TmpProduksiPenerimaanGalian;
                $tmp_model->session_id = $session_id;
                $tmp_model->periode = $periode;
                $tmp_model->kode_rekening_id = $kode_rekening->id;
                $tmp_model->kode_rekening = $kode_rekening->nama;
                $tmp_model->volume = $volume;
                $tmp_model->tarip = $kode_rekening->tarif_dasar;
                $tmp_model->jumlah = $tmp_model->volume * $tmp_model->tarip;
                $tmp_model->penerimaan = $tmp_model->jumlah * ($kode_rekening->tarif_persen / 100);
                $tmp_model->bulan_from = $bulan_from;
                $tmp_model->bulan_to = $bulan_to;
                $tmp_model->save();
            }
        }
    }

}
