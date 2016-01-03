<?php

/**
 * This is the model class for table "tmp_rekapitulasi_penerimaan".
 *
 * The followings are the available columns in table 'tmp_rekapitulasi_penerimaan':
 * @property string $session_id
 * @property integer $periode
 * @property integer $kecamatan_id
 * @property string $nama_kecamatan
 * @property integer $kode_rekening_id
 * @property string $kode_rekening
 * @property integer $kode_rekening_parent_id
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
class TmpRekapitulasiPenerimaan extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tmp_rekapitulasi_penerimaan';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('session_id, periode, kecamatan_id, nama_kecamatan, kode_rekening_id, kode_rekening, kode_rekening_parent_id', 'required'),
            array('periode, kecamatan_id, kode_rekening_id, kode_rekening_parent_id', 'numerical', 'integerOnly' => true),
            array('januari, februari, maret, april, mei, juni, juli, agustus, september, oktober, november, desember', 'numerical'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('session_id, periode, kecamatan_id, nama_kecamatan, kode_rekening_id, kode_rekening, kode_rekening_parent_id, januari, februari, maret, april, mei, juni, juli, agustus, september, oktober, november, desember', 'safe', 'on' => 'search'),
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
            'kecamatan_id' => Yii::t('trans', 'Kecamatan'),
            'nama_kecamatan' => Yii::t('trans', 'Nama Kecamatan'),
            'kode_rekening_id' => Yii::t('trans', 'Kode Rekening'),
            'kode_rekening' => Yii::t('trans', 'Kode Rekening'),
            'kode_rekening_parent_id' => Yii::t('trans', 'Kode Rekening Parent'),
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

        $criteria->compare('session_id', $this->session_id, true);
        $criteria->compare('periode', $this->periode);
        $criteria->compare('kecamatan_id', $this->kecamatan_id);
        $criteria->compare('nama_kecamatan', $this->nama_kecamatan, true);
        $criteria->compare('kode_rekening_id', $this->kode_rekening_id);
        $criteria->compare('kode_rekening', $this->kode_rekening, true);
        $criteria->compare('kode_rekening_parent_id', $this->kode_rekening_parent_id);
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
     * @return TmpRekapitulasiPenerimaan the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getSumNilai($periode, $kode_rekening_id, $kecamatan_id, $bulan) {
        $sql = "SELECT sum(pajak) as total FROM v_setoran_spt_item WHERE kecamatan_id=$kecamatan_id AND kode_rekening_id=$kode_rekening_id AND date_part('month', tanggal_bayar)=$bulan AND periode=$periode";
        $result = Yii::app()->db->createCommand($sql)->queryRow();
        return $result['total'];
    }

    public function generateData($periode, $kode_rekening_id, $use_session = true) {
        $session_id = $use_session ? session_id() : 1;
        $check = self::model()->exists("session_id='$session_id' AND periode=$periode AND kode_rekening_parent_id=$kode_rekening_id");
        if (!$check || $periode == date("Y")) {
            if ($check)
                self::model()->deleteAll("session_id='$session_id' AND periode=$periode AND kode_rekening_parent_id=$kode_rekening_id");
            $kecamatans = Kecamatan::model()->findAll();
            foreach ($kecamatans as $kecamatan) {
                $kode_rekenings = KodeRekening::model()->getParentTreeOptions($kode_rekening_id);
                foreach ($kode_rekenings as $key => $kode_rekening) {
                    $tmp_rekening = explode(' - ', $kode_rekening);
                    $tmp_model = new TmpRekapitulasiPenerimaan;
                    $tmp_model->session_id = $session_id;
                    $tmp_model->periode = $periode;
                    $tmp_model->kecamatan_id = $kecamatan->id;
                    $tmp_model->nama_kecamatan = $kecamatan->nama;
                    $tmp_model->kode_rekening_id = $key;
                    $tmp_model->kode_rekening = $tmp_rekening[1];
                    $tmp_model->kode_rekening_parent_id = $kode_rekening_id;
                    $tmp_model->januari = $this->getSumNilai($periode, $key, $kecamatan->id, 1);
                    $tmp_model->februari = $this->getSumNilai($periode, $key, $kecamatan->id, 2);
                    $tmp_model->maret = $this->getSumNilai($periode, $key, $kecamatan->id, 3);
                    $tmp_model->april = $this->getSumNilai($periode, $key, $kecamatan->id, 4);
                    $tmp_model->mei = $this->getSumNilai($periode, $key, $kecamatan->id, 5);
                    $tmp_model->juni = $this->getSumNilai($periode, $key, $kecamatan->id, 6);
                    $tmp_model->juli = $this->getSumNilai($periode, $key, $kecamatan->id, 7);
                    $tmp_model->agustus = $this->getSumNilai($periode, $key, $kecamatan->id, 8);
                    $tmp_model->september = $this->getSumNilai($periode, $key, $kecamatan->id, 9);
                    $tmp_model->oktober = $this->getSumNilai($periode, $key, $kecamatan->id, 10);
                    $tmp_model->november = $this->getSumNilai($periode, $key, $kecamatan->id, 11);
                    $tmp_model->desember = $this->getSumNilai($periode, $key, $kecamatan->id, 12);
                    $tmp_model->save();
                }
            }
        }
    }

}
