<?php

/**
 * This is the model class for table "tmp_rekapitulasi".
 *
 * The followings are the available columns in table 'tmp_rekapitulasi':
 * @property string $session_id
 * @property integer $periode
 * @property string $npwpd
 * @property string $nama_wajib_pajak
 * @property string $alamat_wajib_pajak
 * @property integer $kecamatan_id
 * @property string $nama_kecamatan
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
class TmpRekapitulasi extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tmp_rekapitulasi';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('session_id, periode, npwpd, nama_wajib_pajak, alamat_wajib_pajak, kecamatan_id, nama_kecamatan, kode_rekening_id, kode_rekening', 'required'),
            array('periode, kecamatan_id, kode_rekening_id', 'numerical', 'integerOnly' => true),
            array('januari, februari, maret, april, mei, juni, juli, agustus, september, oktober, november, desember', 'numerical'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('session_id, periode, npwpd, nama_wajib_pajak, alamat_wajib_pajak, kecamatan_id, nama_kecamatan, kode_rekening_id, kode_rekening, januari, februari, maret, april, mei, juni, juli, agustus, september, oktober, november, desember', 'safe', 'on' => 'search'),
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
            'npwpd' => Yii::t('trans', 'Npwpd'),
            'nama_wajib_pajak' => Yii::t('trans', 'Nama Wajib Pajak'),
            'alamat_wajib_pajak' => Yii::t('trans', 'Alamat Wajib Pajak'),
            'kecamatan_id' => Yii::t('trans', 'Kecamatan'),
            'nama_kecamatan' => Yii::t('trans', 'Nama Kecamatan'),
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

        $criteria->compare('session_id', $this->session_id, true);
        $criteria->compare('periode', $this->periode);
        $criteria->compare('npwpd', $this->npwpd, true);
        $criteria->compare('nama_wajib_pajak', $this->nama_wajib_pajak, true);
        $criteria->compare('alamat_wajib_pajak', $this->alamat_wajib_pajak, true);
        $criteria->compare('kecamatan_id', $this->kecamatan_id);
        $criteria->compare('nama_kecamatan', $this->nama_kecamatan, true);
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
     * @return TmpRekapitulasi the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getSumNilaiDetail($periode, $wajib_pajak_id, $kode_rekening_id, $bulan) {
        $sql = "SELECT sum(pajak) as total FROM v_setoran_spt_item WHERE wajib_pajak_id=$wajib_pajak_id AND kode_rekening_id=$kode_rekening_id AND date_part('month', tanggal_bayar)=$bulan AND periode=$periode";
        $result = Yii::app()->db->createCommand($sql)->queryRow();
        return $result['total'];
    }

    public function generateDataDetail($periode, $kode_rekening_id, $use_session = true) {
        $session_id = $use_session ? session_id() : 1;
        $check = self::model()->exists("session_id='$session_id' AND periode=$periode AND kode_rekening_id=$kode_rekening_id");
        if (!$check || $periode == date("Y")) {
            if ($check)
                self::model()->deleteAll("session_id='$session_id' AND periode=$periode AND kode_rekening_id=$kode_rekening_id");
            $sql = "SELECT * FROM v_spt_item_wajib_pajak_periode WHERE kode_rekening_id = $kode_rekening_id AND periode=$periode";
            $results = Yii::app()->db->createCommand($sql)->queryAll();
            foreach ($results as $result) {
                $tmp_model = new TmpRekapitulasi;
                $tmp_model->session_id = $session_id;
                $tmp_model->periode = $periode;
                $tmp_model->npwpd = $result['npwpd'];
                $tmp_model->nama_wajib_pajak = $result['nama'];
                $tmp_model->alamat_wajib_pajak = $result['alamat_lengkap'];
                $tmp_model->kecamatan_id = $result['kecamatan_id'];
                $tmp_model->nama_kecamatan = $result['nama_kecamatan'];
                $tmp_model->kode_rekening_id = $result['kode_rekening_id'];
                $tmp_model->kode_rekening = $result['nama_kode_rekening'];
                $tmp_model->januari = $this->getSumNilaiDetail($periode, $result['id'], $kode_rekening_id, 1);
                $tmp_model->februari = $this->getSumNilaiDetail($periode, $result['id'], $kode_rekening_id, 2);
                $tmp_model->maret = $this->getSumNilaiDetail($periode, $result['id'], $kode_rekening_id, 3);
                $tmp_model->april = $this->getSumNilaiDetail($periode, $result['id'], $kode_rekening_id, 4);
                $tmp_model->mei = $this->getSumNilaiDetail($periode, $result['id'], $kode_rekening_id, 5);
                $tmp_model->juni = $this->getSumNilaiDetail($periode, $result['id'], $kode_rekening_id, 6);
                $tmp_model->juli = $this->getSumNilaiDetail($periode, $result['id'], $kode_rekening_id, 7);
                $tmp_model->agustus = $this->getSumNilaiDetail($periode, $result['id'], $kode_rekening_id, 8);
                $tmp_model->september = $this->getSumNilaiDetail($periode, $result['id'], $kode_rekening_id, 9);
                $tmp_model->oktober = $this->getSumNilaiDetail($periode, $result['id'], $kode_rekening_id, 10);
                $tmp_model->november = $this->getSumNilaiDetail($periode, $result['id'], $kode_rekening_id, 11);
                $tmp_model->desember = $this->getSumNilaiDetail($periode, $result['id'], $kode_rekening_id, 12);
                $tmp_model->save();
            }
        }
    }

    public function getSumNilai($periode, $wajib_pajak_id, $kode_rekening_id, $bulan) {
        $sql = "SELECT sum(jumlah_bayar) as total FROM v_setoran_pajak WHERE wajib_pajak_id=$wajib_pajak_id AND kode_rekening_id=$kode_rekening_id AND date_part('month', tanggal_bayar)=$bulan AND periode=$periode";
        $result = Yii::app()->db->createCommand($sql)->queryRow();
        return $result['total'];
    }

    public function generateData($periode, $kode_rekening_id, $use_session = true) {
        $session_id = $use_session ? session_id() : 1;
        $check = self::model()->exists("session_id='$session_id' AND periode=$periode AND kode_rekening_id=$kode_rekening_id");
        if (!$check || $periode == date("Y")) {
            if ($check)
                self::model()->deleteAll("session_id='$session_id' AND periode=$periode AND kode_rekening_id=$kode_rekening_id");
            $sql = "SELECT * FROM v_spt_wajib_pajak_periode WHERE kode_rekening_id = $kode_rekening_id AND periode=$periode";
            $results = Yii::app()->db->createCommand($sql)->queryAll();
            foreach ($results as $result) {
                $tmp_model = new TmpRekapitulasi;
                $tmp_model->session_id = $session_id;
                $tmp_model->periode = $periode;
                $tmp_model->npwpd = $result['npwpd'];
                $tmp_model->nama_wajib_pajak = $result['nama'];
                $tmp_model->alamat_wajib_pajak = $result['alamat_lengkap'];
                $tmp_model->kecamatan_id = $result['kecamatan_id'];
                $tmp_model->nama_kecamatan = $result['nama_kecamatan'];
                $tmp_model->kode_rekening_id = $result['kode_rekening_id'];
                $tmp_model->kode_rekening = $result['nama_kode_rekening'];
                $tmp_model->januari = $this->getSumNilai($periode, $result['id'], $kode_rekening_id, 1);
                $tmp_model->februari = $this->getSumNilai($periode, $result['id'], $kode_rekening_id, 2);
                $tmp_model->maret = $this->getSumNilai($periode, $result['id'], $kode_rekening_id, 3);
                $tmp_model->april = $this->getSumNilai($periode, $result['id'], $kode_rekening_id, 4);
                $tmp_model->mei = $this->getSumNilai($periode, $result['id'], $kode_rekening_id, 5);
                $tmp_model->juni = $this->getSumNilai($periode, $result['id'], $kode_rekening_id, 6);
                $tmp_model->juli = $this->getSumNilai($periode, $result['id'], $kode_rekening_id, 7);
                $tmp_model->agustus = $this->getSumNilai($periode, $result['id'], $kode_rekening_id, 8);
                $tmp_model->september = $this->getSumNilai($periode, $result['id'], $kode_rekening_id, 9);
                $tmp_model->oktober = $this->getSumNilai($periode, $result['id'], $kode_rekening_id, 10);
                $tmp_model->november = $this->getSumNilai($periode, $result['id'], $kode_rekening_id, 11);
                $tmp_model->desember = $this->getSumNilai($periode, $result['id'], $kode_rekening_id, 12);
                $tmp_model->save();
            }
        }
    }

}
