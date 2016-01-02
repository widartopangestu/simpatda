<?php

/**
 * This is the model class for table "tmp_rekapitulasi_penggunaan_galian".
 *
 * The followings are the available columns in table 'tmp_rekapitulasi_penggunaan_galian':
 * @property integer $periode
 * @property integer $kode_rekening_id
 * @property string $kode_rekening
 * @property double $januari
 * @property double $februari
 * @property double $maret
 * @property double $april
 * @property double $mei
 * @property double $juni
 * @property double $juli
 * @property double $agustus
 * @property double $september
 * @property double $oktober
 * @property double $november
 * @property double $desember
 */
class TmpRekapitulasiPenggunaanGalian extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tmp_rekapitulasi_penggunaan_galian';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('periode, kode_rekening_id, kode_rekening', 'required'),
            array('periode, kode_rekening_id', 'numerical', 'integerOnly' => true),
            array('januari, februari, maret, april, mei, juni, juli, agustus, september, oktober, november, desember', 'numerical'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('periode, kode_rekening_id, kode_rekening, januari, februari, maret, april, mei, juni, juli, agustus, september, oktober, november, desember', 'safe', 'on' => 'search'),
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
            'periode' => Yii::t('trans', 'Periode'),
            'kode_rekening_id' => Yii::t('trans', 'Kode Rekening'),
            'kode_rekening' => Yii::t('trans', 'Kode Rekening'),
            'januari' => Yii::t('trans', 'Januari'),
            'februari' => Yii::t('trans', 'Februari'),
            'maret' => Yii::t('trans', 'Maret'),
            'april' => Yii::t('trans', 'April'),
            'mei' => Yii::t('trans', 'Mei'),
            'juni' => Yii::t('trans', 'Juni'),
            'juli' => Yii::t('trans', 'Juli'),
            'agustus' => Yii::t('trans', 'Agustus'),
            'september' => Yii::t('trans', 'September'),
            'oktober' => Yii::t('trans', 'Oktober'),
            'november' => Yii::t('trans', 'November'),
            'desember' => Yii::t('trans', 'Desember'),
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

        $criteria->compare('periode', $this->periode);
        $criteria->compare('kode_rekening_id', $this->kode_rekening_id);
        $criteria->compare('kode_rekening', $this->kode_rekening, true);
        $criteria->compare('januari', $this->januari);
        $criteria->compare('februari', $this->februari);
        $criteria->compare('maret', $this->maret);
        $criteria->compare('april', $this->april);
        $criteria->compare('mei', $this->mei);
        $criteria->compare('juni', $this->juni);
        $criteria->compare('juli', $this->juli);
        $criteria->compare('agustus', $this->agustus);
        $criteria->compare('september', $this->september);
        $criteria->compare('oktober', $this->oktober);
        $criteria->compare('november', $this->november);
        $criteria->compare('desember', $this->desember);

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
     * @return TmpRekapitulasiPenggunaanGalian the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getSumNilai($periode, $kode_rekening_id, $bulan) {
        $sql = "SELECT sum(nilai) as total FROM v_setoran_spt_item WHERE kode_rekening_id = $kode_rekening_id AND date_part('month', tanggal_bayar)=$bulan AND periode=$periode";
        $result = Yii::app()->db->createCommand($sql)->queryRow();
        return $result['total'];
    }

    public function generateData($periode) {
        $check = self::model()->exists('periode=' . $periode);
        if (!$check || $periode == date("Y")) {
            if ($check)
                self::model()->deleteAll('periode=' . $periode);
            $galians = KodeRekening::model()->getParentTreeOptions(Spt::PARENT_GALIAN);
            foreach ($galians as $key => $galian) {
                $tmp_rekening = explode(' - ', $galian);
                $tmp_model = new TmpRekapitulasiPenggunaanGalian;
                $tmp_model->periode = $periode;
                $tmp_model->kode_rekening_id = $key;
                $tmp_model->kode_rekening = $tmp_rekening[1];
                $tmp_model->januari = $this->getSumNilai($periode, $key, 1);
                $tmp_model->februari = $this->getSumNilai($periode, $key, 2);
                $tmp_model->maret = $this->getSumNilai($periode, $key, 3);
                $tmp_model->april = $this->getSumNilai($periode, $key, 4);
                $tmp_model->mei = $this->getSumNilai($periode, $key, 5);
                $tmp_model->juni = $this->getSumNilai($periode, $key, 6);
                $tmp_model->juli = $this->getSumNilai($periode, $key, 7);
                $tmp_model->agustus = $this->getSumNilai($periode, $key, 8);
                $tmp_model->september = $this->getSumNilai($periode, $key, 9);
                $tmp_model->oktober = $this->getSumNilai($periode, $key, 10);
                $tmp_model->november = $this->getSumNilai($periode, $key, 11);
                $tmp_model->desember = $this->getSumNilai($periode, $key, 12);
                $tmp_model->save();
            }
        }
    }

}
