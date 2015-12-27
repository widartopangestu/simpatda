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
 * @property string $instansi_nama
 * @property string $instansi_alamat
 * @property string $id_jenis
 * @property string $nomer_berita_acara
 * @property string $isi_berita_acara
 *
 * The followings are the available model relations:
 * @property Pemeriksaan[] $pemeriksaans
 * @property Spt[] $spts
 * @property Kecamatan $kecamatan0
 * @property Kelurahan $kelurahan0
 * @property BidangUsaha $bidangUsaha
 */
class WajibPajak extends CActiveRecord {

    const STATUS_NOACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const JENIS_PAJAK = 'p';
    const JENIS_RETRIBUSI = 'r';
    const WARGANEGARA_WNI = 'WNI';
    const WARGANEGARA_WNA = 'WNA';
    const GOLONGAN_PRIBADI = 1;
    const GOLONGAN_BADAN_USAHA = 2;
    const ID_JENIS_KTP = 1;
    const ID_JENIS_SIM = 2;
    const ID_JENIS_PASPOR = 3;

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
            array('jenis, nomor, nama, kabupaten, kecamatan, kelurahan, telepon', 'required'),
            array('golongan, kelurahan_id, kecamatan_id, bidang_usaha_id', 'numerical', 'integerOnly' => true),
            array('jenis', 'length', 'max' => 1),
            array('nomor', 'length', 'max' => 7),
            array('nomor', 'unique'),
            array('nama, kabupaten, kecamatan, kelurahan, id_nomor, kk_nomor, pekerjaan, bu_nama, bu_kabupaten, bu_kecamatan, bu_kelurahan, instansi_nama, nomer_berita_acara', 'length', 'max' => 255),
            array('telepon, bu_telepon', 'length', 'max' => 20),
            array('kodepos, bu_kodepos, warga_negara', 'length', 'max' => 5),
            array('id_jenis', 'length', 'max' => 10),
            array('alamat, status, tanggal_tutup, tanggal_lahir, kk_tanggal, alamat_pekerjaan, bu_alamat, created, updated, instansi_alamat, isi_berita_acara', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, jenis, golongan, nomor, nama, alamat, kabupaten, kecamatan, kelurahan, telepon, status, tanggal_tutup, kodepos, id_nomor, tanggal_lahir, kk_nomor, kk_tanggal, pekerjaan, alamat_pekerjaan, bu_nama, bu_alamat, bu_kabupaten, bu_kecamatan, bu_kelurahan, bu_telepon, bu_kodepos, kelurahan_id, kecamatan_id, bidang_usaha_id, warga_negara, created, updated, instansi_nama, instansi_alamat, id_jenis, nomer_berita_acara, isi_berita_acara', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'pemeriksaans' => array(self::HAS_MANY, 'Pemeriksaan', 'wajib_pajak_id'),
            'spts' => array(self::HAS_MANY, 'Spt', 'wajib_pajak_id'),
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
            'telepon' => Yii::t('trans', 'No. Telepon'),
            'status' => Yii::t('trans', 'Status'),
            'tanggal_tutup' => Yii::t('trans', 'Tanggal Tutup'),
            'kodepos' => Yii::t('trans', 'Kodepos'),
            'id_jenis' => Yii::t('trans', 'Tanda Bukti Diri'),
            'id_nomor' => Yii::t('trans', 'Nomor'),
            'tanggal_lahir' => Yii::t('trans', 'Tgl. Lahir'),
            'kk_nomor' => Yii::t('trans', 'Nomor Kartu Keluarga'),
            'kk_tanggal' => Yii::t('trans', 'Tgl. Kartu Keluarga'),
            'pekerjaan' => Yii::t('trans', 'Pekerjaan/Usaha'),
            'alamat_pekerjaan' => Yii::t('trans', 'Alamat Instansi'),
            'bu_nama' => Yii::t('trans', 'Nama Instansi Tempat Bekerja/Usaha'),
            'bu_alamat' => Yii::t('trans', 'Alamat'),
            'bu_kabupaten' => Yii::t('trans', 'Kabupaten'),
            'bu_kecamatan' => Yii::t('trans', 'Kecamatan'),
            'bu_kelurahan' => Yii::t('trans', 'Kelurahan'),
            'bu_telepon' => Yii::t('trans', 'Telepon'),
            'bu_kodepos' => Yii::t('trans', 'Kodepos'),
            'kelurahan_id' => Yii::t('trans', 'Kelurahan'),
            'kecamatan_id' => Yii::t('trans', 'Kecamatan'),
            'bidang_usaha_id' => Yii::t('trans', 'Bidang Usaha'),
            'warga_negara' => Yii::t('trans', 'Warga Negara'),
            'created' => Yii::t('trans', 'Created'),
            'updated' => Yii::t('trans', 'Updated'),
            'instansi_nama' => Yii::t('trans', 'Instansi Nama'),
            'instansi_alamat' => Yii::t('trans', 'Instansi Alamat'),
            'nomer_berita_acara' => Yii::t('trans', 'Nomer Berita Acara'),
            'isi_berita_acara' => Yii::t('trans', 'Isi Berita Acara'),
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
        $criteria->compare('instansi_nama', $this->instansi_nama, true);
        $criteria->compare('instansi_alamat', $this->instansi_alamat, true);
        $criteria->compare('nomer_berita_acara', $this->nomer_berita_acara, true);
        $criteria->compare('isi_berita_acara', $this->isi_berita_acara, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 'nomor DESC',
                'attributes' => array(
                    '*',
                ),
            ),
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

    public function beforeValidate() {
        if ($this->isNewRecord) {
            if (strtolower($this->nomor) === strtolower('AUTO')) {
                $sql = "SELECT MAX(nomor)::INT AS maxnomor FROM wajib_pajak";
                $result = Yii::app()->db->createCommand($sql)->queryRow();
                $new_code = $this->preventUniqueKode($result['maxnomor'] + 1);
                $this->nomor = str_pad($new_code, 7, '0', STR_PAD_LEFT);
            }
        }
        if (empty($this->kecamatan)) {
            $this->kecamatan = $this->namaKecamatan;
        }
        if (empty($this->kelurahan)) {
            $this->kelurahan = $this->namaKelurahan;
        }
        return parent::beforeValidate();
    }

    public function preventUniqueKode($count) {
        $form = (int) $count;
        $flag = self::model()->find("nomor = '$form'");
        if ($flag) {
            $count++;
            $form = $this->preventUniqueNumber($count);
        }
        return $form;
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

    public function getGolonganOptions() {
        return array(
            self::GOLONGAN_PRIBADI => Yii::t('trans', 'Pribadi'),
            self::GOLONGAN_BADAN_USAHA => Yii::t('trans', 'Badan Usaha'),
        );
    }

    public function getWargaNegaraOptions() {
        return array(
            self::WARGANEGARA_WNI => 'WNI',
            self::WARGANEGARA_WNA => 'WNA',
        );
    }

    public function getIdJenisOptions() {
        return array(
            self::ID_JENIS_KTP => 'KTP',
            self::ID_JENIS_SIM => 'SIM',
            self::ID_JENIS_PASPOR => 'PASPOR',
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

    public function getGolonganText($golongan = null) {
        $value = ($golongan === null) ? $this->golongan : $golongan;
        $golonganOptions = $this->getGolonganOptions();
        return isset($golonganOptions[$value]) ?
                $golonganOptions[$value] : "unknown golongan ({$value})";
    }

    public function getWargaNegaraText($wargaNegara = null) {
        $value = ($wargaNegara === null) ? $this->wargaNegara : $wargaNegara;
        $wargaNegaraOptions = $this->getWargaNegaraOptions();
        return isset($wargaNegaraOptions[$value]) ?
                $wargaNegaraOptions[$value] : "unknown warga negara ({$value})";
    }

    public function getIdJenisText($idJenis = null) {
        $value = ($idJenis === null) ? $this->id_jenis : $idJenis;
        $idJenisOptions = $this->getIdJenisOptions();
        return isset($idJenisOptions[$value]) ?
                $idJenisOptions[$value] : "unknown id jenis ({$value})";
    }

    public function getKelurahanOptions() {
        if ($this->kecamatan_id)
            return CHtml::listData(Kelurahan::model()->findAll('kecamatan_id=:kecamatan_id ORDER BY kode ASC', array(':kecamatan_id' => $this->kecamatan_id)), 'id', 'kodeNama');
        else
            return array(); //CHtml::listData(Kelurahan::model()->findAll(), 'id', 'nama');
    }

    public function getNamaKelurahan() {
        return ($this->kelurahan_id !== NULL) ? $this->kelurahan0->nama : Yii::t('trans', 'Not Set');
    }

    public function getKecamatanOptions() {
        return CHtml::listData(Kecamatan::model()->findAll(array('order' => 'kode ASC')), 'id', 'kodeNama');
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

    public function getNpwpd() {
        return strtoupper($this->jenis) . '.' . $this->golongan . '.' . $this->nomor . '.' . $this->kecamatan0->kode . '.' . $this->kelurahan0->kode;
    }

    public function getGolonganPajak($id, $periode, $parent_kode_rekening) {
        $sql = "SELECT distinct f.kode_rekening_id,
    d.periode,
    a.id,
    e.kode,
    f.kode_rekening_id,
    e.nama as nama_kode_rekening,
    d.kode_rekening_id as parent_kode_rekening
   FROM spt_item f
     JOIN spt d ON f.spt_id = d.id
     JOIN wajib_pajak a ON a.id = d.wajib_pajak_id
     JOIN kecamatan b ON a.kecamatan_id = b.id
     JOIN kelurahan c ON a.kelurahan_id = c.id
     join kode_rekening e on f.kode_rekening_id=e.id
     where a.id=$id and d.periode=$periode and d.kode_rekening_id=$parent_kode_rekening
  ORDER BY e.kode;";
        $result = Yii::app()->db->createCommand($sql)->queryAll();
        $data = array();
        foreach ($result as $item) {
            $data[] = $item['nama_kode_rekening'];
        }
        return implode(', ', $data);
    }

}
