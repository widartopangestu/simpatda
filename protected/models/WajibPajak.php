<?php

/**
 * This is the model class for table "wajib_pajak".
 *
 * The followings are the available columns in table 'wajib_pajak':
 * @property string $id
 * @property string $jenis
 * @property integer $golongan
 * @property string $nomor
 * @property string $nama
 * @property string $alamat
 * @property string $kabupaten
 * @property string $kecamatan
 * @property string $kelurahan
 * @property string $telepon
 * @property boolean $status
 * @property string $tanggal_tutup
 * @property string $kodepos
 * @property integer $id_jenis
 * @property string $id_nomor
 * @property string $tanggal_lahir
 * @property string $kk_nomor
 * @property string $kk_tanggal
 * @property string $pekerjaan
 * @property string $alamat_pekerjaan
 * @property string $bu_nama
 * @property string $bu_alamat
 * @property string $bu_kabupaten
 * @property string $bu_kecamatan
 * @property string $bu_kelurahan
 * @property string $bu_telepon
 * @property string $bu_kodepos
 * @property integer $kelurahan_id
 * @property integer $kecamatan_id
 * @property integer $bidang_usaha_id
 * @property string $warga_negara
 * @property string $created
 * @property string $updated
 *
 * The followings are the available model relations:
 * @property Kecamatan $kecamatan0
 * @property Kelurahan $kelurahan0
 * @property BidangUsaha $bidangUsaha
 */
class WajibPajak extends CActiveRecord {

    const STATUS_NOACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const JENIS_PAJAK = 'P';
    const JENIS_RETRIBUSI = 'R';
    const WARGANEGARA_WNI = 'WNI';
    const WARGANEGARA_WNA = 'WNA';

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'wajib_pajak';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('jenis, nomor, nama, kabupaten, kecamatan_id, kelurahan_id, telepon, kodepos', 'required'),
            array('golongan, id_jenis, kelurahan_id, kecamatan_id, bidang_usaha_id', 'numerical', 'integerOnly' => true),
            array('jenis', 'length', 'max' => 1),
            array('nomor', 'length', 'max' => 7),
            array('nama, kabupaten, kecamatan, kelurahan, id_nomor, kk_nomor, pekerjaan, bu_nama, bu_kabupaten, bu_kecamatan, bu_kelurahan', 'length', 'max' => 255),
            array('telepon, bu_telepon', 'length', 'max' => 20),
            array('kodepos, bu_kodepos, warga_negara', 'length', 'max' => 5),
            array('alamat, status, tanggal_tutup, tanggal_lahir, kk_tanggal, alamat_pekerjaan, bu_alamat', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, jenis, golongan, nomor, nama, alamat, kabupaten, kecamatan, kelurahan, telepon, status, tanggal_tutup, kodepos, id_jenis, id_nomor, tanggal_lahir, kk_nomor, kk_tanggal, pekerjaan, alamat_pekerjaan, bu_nama, bu_alamat, bu_kabupaten, bu_kecamatan, bu_kelurahan, bu_telepon, bu_kodepos, kelurahan_id, kecamatan_id, bidang_usaha_id, warga_negara, created, updated', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'kecamatan0' => array(self::BELONGS_TO, 'Kecamatan', 'kecamatan_id'),
            'kelurahan0' => array(self::BELONGS_TO, 'Kelurahan', 'kelurahan_id'),
            'bidangUsaha' => array(self::BELONGS_TO, 'BidangUsaha', 'bidang_usaha_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => Yii::t('trans', 'ID'),
            'jenis' => Yii::t('trans', 'Jenis'),
            'golongan' => Yii::t('trans', 'Golongan'),
            'nomor' => Yii::t('trans', 'Nomor'),
            'nama' => Yii::t('trans', 'Nama'),
            'alamat' => Yii::t('trans', 'Alamat'),
            'kabupaten' => Yii::t('trans', 'Kabupaten'),
            'kecamatan' => Yii::t('trans', 'Kecamatan'),
            'kelurahan' => Yii::t('trans', 'Kelurahan'),
            'telepon' => Yii::t('trans', 'Telepon'),
            'status' => Yii::t('trans', 'Status'),
            'tanggal_tutup' => Yii::t('trans', 'Tanggal Tutup'),
            'kodepos' => Yii::t('trans', 'Kodepos'),
            'id_jenis' => Yii::t('trans', 'Id Jenis'),
            'id_nomor' => Yii::t('trans', 'Id Nomor'),
            'tanggal_lahir' => Yii::t('trans', 'Tanggal Lahir'),
            'kk_nomor' => Yii::t('trans', 'Kk Nomor'),
            'kk_tanggal' => Yii::t('trans', 'Kk Tanggal'),
            'pekerjaan' => Yii::t('trans', 'Pekerjaan'),
            'alamat_pekerjaan' => Yii::t('trans', 'Alamat Pekerjaan'),
            'bu_nama' => Yii::t('trans', 'Bu Nama'),
            'bu_alamat' => Yii::t('trans', 'Bu Alamat'),
            'bu_kabupaten' => Yii::t('trans', 'Bu Kabupaten'),
            'bu_kecamatan' => Yii::t('trans', 'Bu Kecamatan'),
            'bu_kelurahan' => Yii::t('trans', 'Bu Kelurahan'),
            'bu_telepon' => Yii::t('trans', 'Bu Telepon'),
            'bu_kodepos' => Yii::t('trans', 'Bu Kodepos'),
            'kelurahan_id' => Yii::t('trans', 'Kelurahan'),
            'kecamatan_id' => Yii::t('trans', 'Kecamatan'),
            'bidang_usaha_id' => Yii::t('trans', 'Bidang Usaha'),
            'warga_negara' => Yii::t('trans', 'Warga Negara'),
            'created' => Yii::t('trans', 'Created'),
            'updated' => Yii::t('trans', 'Updated'),
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

        $criteria->compare('id', $this->id, true);
        $criteria->compare('jenis', $this->jenis, true);
        $criteria->compare('golongan', $this->golongan);
        $criteria->compare('nomor', $this->nomor, true);
        $criteria->compare('nama', $this->nama, true);
        $criteria->compare('alamat', $this->alamat, true);
        $criteria->compare('kabupaten', $this->kabupaten, true);
        $criteria->compare('kecamatan', $this->kecamatan, true);
        $criteria->compare('kelurahan', $this->kelurahan, true);
        $criteria->compare('telepon', $this->telepon, true);
        $criteria->compare('status', $this->status);
        $criteria->compare('tanggal_tutup', $this->tanggal_tutup, true);
        $criteria->compare('kodepos', $this->kodepos, true);
        $criteria->compare('id_jenis', $this->id_jenis);
        $criteria->compare('id_nomor', $this->id_nomor, true);
        $criteria->compare('tanggal_lahir', $this->tanggal_lahir, true);
        $criteria->compare('kk_nomor', $this->kk_nomor, true);
        $criteria->compare('kk_tanggal', $this->kk_tanggal, true);
        $criteria->compare('pekerjaan', $this->pekerjaan, true);
        $criteria->compare('alamat_pekerjaan', $this->alamat_pekerjaan, true);
        $criteria->compare('bu_nama', $this->bu_nama, true);
        $criteria->compare('bu_alamat', $this->bu_alamat, true);
        $criteria->compare('bu_kabupaten', $this->bu_kabupaten, true);
        $criteria->compare('bu_kecamatan', $this->bu_kecamatan, true);
        $criteria->compare('bu_kelurahan', $this->bu_kelurahan, true);
        $criteria->compare('bu_telepon', $this->bu_telepon, true);
        $criteria->compare('bu_kodepos', $this->bu_kodepos, true);
        $criteria->compare('kelurahan_id', $this->kelurahan_id);
        $criteria->compare('kecamatan_id', $this->kecamatan_id);
        $criteria->compare('bidang_usaha_id', $this->bidang_usaha_id);
        $criteria->compare('warga_negara', $this->warga_negara, true);
        $criteria->compare('created', $this->created, true);
        $criteria->compare('updated', $this->updated, true);

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
     * @return WajibPajak the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function beforeSave() {
        $this->kecamatan = $this->namaKecamatan;
        $this->kelurahan = $this->namaKelurahan;
        return parent::beforeSave();
    }

    public function behaviors() {
        return array(
            'timestamps' => array(
                'class' => 'zii.behaviors.CTimestampBehavior',
                'createAttribute' => 'created',
                'updateAttribute' => 'updated',
                'timestampExpression' => new CDbExpression('NOW()'),
                'setUpdateOnCreate' => true,
            ),
        );
    }

    public function getStatusOptions() {
        return array(
            self::STATUS_ACTIVE => Yii::t('trans', 'Active'),
            self::STATUS_NOACTIVE => Yii::t('trans', 'Not Active'),
        );
    }

    public function getJenisOptions() {
        return array(
            self::JENIS_PAJAK => Yii::t('trans', 'PAJAK'),
            self::JENIS_RETRIBUSI => Yii::t('trans', 'RETRIBUSI'),
        );
    }

    public function getWargaNegaraOptions() {
        return array(
            self::WARGANEGARA_WNI => 'WNI',
            self::WARGANEGARA_WNA => 'WNA',
        );
    }

    public function getStatusText($status = null) {
        $value = ($status === null) ? $this->status : $status;
        $statusOptions = $this->getStatusOptions();
        return isset($statusOptions[$value]) ?
                $statusOptions[$value] : "unknown status ({$value})";
    }

    public function getJenisText($jenis = null) {
        $value = ($jenis === null) ? $this->jenis : $jenis;
        $jenisOptions = $this->getJenisOptions();
        return isset($jenisOptions[$value]) ?
                $jenisOptions[$value] : "unknown jenis ({$value})";
    }

    public function getWargaNegaraText($wargaNegara = null) {
        $value = ($wargaNegara === null) ? $this->wargaNegara : $wargaNegara;
        $wargaNegaraOptions = $this->getWargaNegaraOptions();
        return isset($wargaNegaraOptions[$value]) ?
                $wargaNegaraOptions[$value] : "unknown wargaNegara ({$value})";
    }

    public function getKelurahanOptions() {
        return CHtml::listData(Kelurahan::model()->findAll(), 'id', 'nama');
    }

    public function getNamaKelurahan() {
        return ($this->kelurahan_id !== NULL) ? $this->kelurahan0->nama : Yii::t('trans', 'Not Set');
    }

    public function getKecamatanOptions() {
        return CHtml::listData(Kecamatan::model()->findAll(), 'id', 'nama');
    }

    public function getNamaKecamatan() {
        return ($this->kecamatan_id !== NULL) ? $this->kecamatan0->nama : Yii::t('trans', 'Not Set');
    }

    public function getBidangUsahaOptions() {
        return CHtml::listData(BidangUsaha::model()->findAll(), 'id', 'nama');
    }

    public function getNamaBidangUsaha() {
        return ($this->bidang_usaha_id !== NULL) ? $this->bidangUsaha->nama : Yii::t('trans', 'Not Set');
    }

}
