<?php

/**
 * This is the model class for table "spt".
 *
 * The followings are the available columns in table 'spt':
 * @property string $id
 * @property integer $periode
 * @property string $nomor
 * @property string $periode_awal
 * @property string $periode_akhir
 * @property double $pajak
 * @property double $nilai
 * @property integer $jenis_pemungutan
 * @property double $tarif_dasar
 * @property double $tarif_persen
 * @property string $tanggal_proses
 * @property string $tanggal_entry
 * @property string $uraian
 * @property integer $jenis_pajak
 * @property integer $wajib_pajak_id
 * @property integer $kode_rekening_id
 * @property integer $jenis_surat_id
 * @property string $updated
 * @property string $created
 *
 * The followings are the available model relations:
 * @property PemeriksaanItem[] $pemeriksaanItems
 * @property WajibPajak $wajibPajak
 * @property KodeRekening $kodeRekening
 * @property JenisSurat $jenisSurat
 * @property SptReklame $sptReklame
 * @property SptGalian $sptGalian
 * @property SptBphtb $sptBphtb
 * @property SptItem[] $sptItems
 * @property Penetapan[] $penetapans
 */
class Spt extends CActiveRecord {

    public $npwpd;
    public $nama;
    public $alamat;
    public $kecamatan;
    public $kelurahan;
    public $kabupaten;
    public $nama_kode_rekening;
    public $wp_search;
    public $dasar_pengenaan;

    const PUNGUTAN_SELF = 1;
    const PUNGUTAN_OFFICE = 2;
    const JENIS_SURAT = 8;
    const PARENT_HOTEL = 2;
    const PARENT_RESTORAN = 7;
    const PARENT_HIBURAN = 15;
    const PARENT_REKLAME = 19;
    const PARENT_ELECTRIC = 342;
    const PARENT_GALIAN = 444; //58
    const PARENT_AIR = 77;
    const PARENT_WALET = 329;
    const PARENT_RETRIBUSI = 124;//392;
    const PARENT_BPHTB = 256;
    const JENIS_PAJAK_HOTEL = 1;
    const JENIS_PAJAK_RESTORAN = 2;
    const JENIS_PAJAK_HIBURAN = 3;
    const JENIS_PAJAK_REKLAME = 4;
    const JENIS_PAJAK_ELECTRIC = 5;
    const JENIS_PAJAK_GALIAN = 11;
    const JENIS_PAJAK_AIR = 8;
    const JENIS_PAJAK_WALET = 9;
    const JENIS_PAJAK_RETRIBUSI = 12;
    const JENIS_PAJAK_BPHTB = 13;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'spt';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('npwpd, periode, nomor, periode_awal, periode_akhir, jenis_pemungutan, tanggal_proses, tanggal_entry, kode_rekening_id, jenis_surat_id', 'required'),
            array('periode, jenis_pemungutan, jenis_pajak, wajib_pajak_id, kode_rekening_id, jenis_surat_id', 'numerical', 'integerOnly' => true),
            array('periode, pajak, nilai, tarif_dasar, tarif_persen', 'numerical'),
            array('uraian, nama, alamat, kabupaten, kecamatan, kelurahan, nama_kode_rekening', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, periode, nomor, periode_awal, periode_akhir, pajak, nilai, jenis_pemungutan, tarif_dasar, tarif_persen, tanggal_proses, tanggal_entry, uraian, jenis_pajak, wajib_pajak_id, kode_rekening_id, jenis_surat_id, updated, created, wp_search, dasar_pengenaan', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'pemeriksaanItems' => array(self::HAS_MANY, 'PemeriksaanItem', 'spt_id'),
            'wajibpajak' => array(self::BELONGS_TO, 'WajibPajak', 'wajib_pajak_id'),
            'kodeRekening' => array(self::BELONGS_TO, 'KodeRekening', 'kode_rekening_id'),
            'jenisSurat' => array(self::BELONGS_TO, 'JenisSurat', 'jenis_surat_id'),
            'sptReklame' => array(self::HAS_ONE, 'SptReklame', 'spt_id'),
            'sptGalian' => array(self::HAS_ONE, 'SptGalian', 'spt_id'),
            'sptBphtb' => array(self::HAS_ONE, 'SptBphtb', 'spt_id'),
            'sptItems' => array(self::HAS_MANY, 'SptItem', 'spt_id'),
            'sptItemCount' => array(self::STAT, 'SptItem', 'spt_id'),
            'penetapans' => array(self::HAS_MANY, 'Penetapan', 'spt_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => Yii::t('trans', 'ID'),
            'periode' => Yii::t('trans', 'Periode'),
            'nomor' => Yii::t('trans', 'Nomor'),
            'periode_awal' => Yii::t('trans', 'Periode Awal'),
            'periode_akhir' => Yii::t('trans', 'Periode Akhir'),
            'pajak' => Yii::t('trans', 'Pajak'),
            'nilai' => Yii::t('trans', 'Dasar Pengenaan'),
            'jenis_pemungutan' => Yii::t('trans', 'Jenis Pemungutan'),
            'tarif_dasar' => Yii::t('trans', 'Tarif Dasar'),
            'tarif_persen' => Yii::t('trans', 'Tarif Persen'),
            'tanggal_proses' => Yii::t('trans', 'Tanggal Proses'),
            'tanggal_entry' => Yii::t('trans', 'Tanggal Entry'),
            'uraian' => Yii::t('trans', 'Uraian'),
            'jenis_pajak' => Yii::t('trans', 'Jenis Pajak'),
            'wajib_pajak_id' => Yii::t('trans', 'Wajib Pajak'),
            'wp_search' => Yii::t('trans', 'Wajib Pajak'),
            'kode_rekening_id' => Yii::t('trans', 'Kode Rekening'),
            'jenis_surat_id' => Yii::t('trans', 'Jenis Surat'),
            'updated' => Yii::t('trans', 'Updated'),
            'created' => Yii::t('trans', 'Created'),
            'npwpd' => Yii::t('trans', 'NPWPD'),
            'nama' => Yii::t('trans', 'Nama WP'),
            'alamat' => Yii::t('trans', 'Alamat'),
            'kecamatan' => Yii::t('trans', 'Kecamatan'),
            'kelurahan' => Yii::t('trans', 'Kelurahan'),
            'kabupaten' => Yii::t('trans', 'Kabupaten'),
            'nama_kode_rekening' => Yii::t('trans', 'Nama Rekening'),
            'dasar_pengenaan' => Yii::t('trans', 'Dasar Pengenaan'),
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

        $criteria->with = array('wajibpajak');
        $criteria->compare('id', $this->id, true);
        $criteria->compare('periode', $this->periode);
        $criteria->compare('nomor', $this->nomor, true);
        $criteria->compare('periode_awal', $this->periode_awal, true);
        $criteria->compare('periode_akhir', $this->periode_akhir, true);
        $criteria->compare('pajak', $this->pajak);
        $criteria->compare('nilai', $this->nilai);
        $criteria->compare('jenis_pemungutan', $this->jenis_pemungutan);
        $criteria->compare('tarif_dasar', $this->tarif_dasar);
        $criteria->compare('tarif_persen', $this->tarif_persen);
        $criteria->compare('tanggal_proses', $this->tanggal_proses, true);
        $criteria->compare('tanggal_entry', $this->tanggal_entry, true);
        $criteria->compare('uraian', $this->uraian, true);
        $criteria->compare('jenis_pajak', $this->jenis_pajak);
        $criteria->compare('wajib_pajak_id', $this->wajib_pajak_id);
        $criteria->compare('wajibpajak.nama', $this->wp_search, true);
        $criteria->compare('kode_rekening_id', $this->kode_rekening_id);
        $criteria->compare('jenis_surat_id', $this->jenis_surat_id);
        $criteria->compare('updated', $this->updated, true);
        $criteria->compare('created', $this->created, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 't.created DESC',
                'attributes' => array(
                    'wpr_search' => array(
                        'asc' => 'wajibpajak.nama ASC',
                        'desc' => 'wajibpajak.nama DESC',
                    ),
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
     * @return Spt the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
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

    public function getJenisPemungutanOptions() {
        return array(
            self::PUNGUTAN_SELF => Yii::t('trans', 'Self Assesment'),
            self::PUNGUTAN_OFFICE => Yii::t('trans', 'Official Assesment'),
        );
    }

    public function getJenisPemungutanText($jenisPemungutan = null) {
        $value = ($jenisPemungutan === null) ? $this->jenis_pemungutan : $jenisPemungutan;
        $jenisPemungutanOptions = $this->getJenisPemungutanOptions();
        return isset($jenisPemungutanOptions[$value]) ?
                $jenisPemungutanOptions[$value] : "unknown Jenis Pemungutan ({$value})";
    }

    public function getJenisPajakOptions() {
        return array(
            self::JENIS_PAJAK_HOTEL => Yii::t('trans', 'Pajak Hotel'),
            self::JENIS_PAJAK_RESTORAN => Yii::t('trans', 'Pajak Restoran'),
            self::JENIS_PAJAK_HIBURAN => Yii::t('trans', 'Pajak Hiburan'),
            self::JENIS_PAJAK_REKLAME => Yii::t('trans', 'Pajak Reklame'),
            self::JENIS_PAJAK_ELECTRIC => Yii::t('trans', 'Pajak Penerangan Jalan / Genset'),
            self::JENIS_PAJAK_AIR => Yii::t('trans', 'Pajak Air Bawah Tanah'),
            self::JENIS_PAJAK_WALET => Yii::t('trans', 'Pajak Sarang Burung Walet'),
            self::JENIS_PAJAK_GALIAN => Yii::t('trans', 'Pajak Bahan Mineral Bukan Logam dan Batuan'),
            self::JENIS_PAJAK_RETRIBUSI => Yii::t('trans', 'Retribusi'),
            self::JENIS_PAJAK_BPHTB => Yii::t('trans', 'BPHTB')
        );
    }

    public function getJenisPajakText($jenisPajak = null) {
        $value = ($jenisPajak === null) ? $this->jenis_pajak : $jenisPajak;
        $jenisPajakOptions = $this->getJenisPajakOptions();
        return isset($jenisPajakOptions[$value]) ?
                $jenisPajakOptions[$value] : "unknown Jenis Pajak ({$value})";
    }

    public function beforeSave() {
        if ($this->isNewRecord) {
            if (strtolower($this->nomor) === strtolower('AUTO')) {
                $sql = "SELECT MAX(nomor) AS maxnomor FROM spt WHERE periode='$this->periode'";
                $result = Yii::app()->db->createCommand($sql)->queryRow();
                $new_code = $this->preventUniqueKode($result['maxnomor'] + 1);
                $this->nomor = $new_code;
            }
        }
        return parent::beforeSave();
    }

    public function preventUniqueKode($count) {
        $form = (int) $count;
        $flag = self::model()->find("nomor = '$form' AND periode='$this->periode'");
        if ($flag) {
            $count++;
            $form = $this->preventUniqueNumber($count);
        }
        return $form;
    }

    function getUpdateLink($jenis, $id) {
        switch ($jenis) {
            case self::JENIS_PAJAK_HOTEL:
                $url = 'spt/updateHotel';
                break;
            case self::JENIS_PAJAK_RESTORAN:
                $url = 'spt/updateRestoran';
                break;
            case self::JENIS_PAJAK_HIBURAN:
                $url = 'spt/updateHiburan';
                break;
            case self::JENIS_PAJAK_REKLAME:
                $url = 'spt/updateReklame';
                break;
            case self::JENIS_PAJAK_ELECTRIC:
                $url = 'spt/updateElectric';
                break;
            case self::JENIS_PAJAK_AIR:
                $url = 'spt/updateAir';
                break;
            case self::JENIS_PAJAK_WALET:
                $url = 'spt/updateWalet';
                break;
            case self::JENIS_PAJAK_GALIAN:
                $url = 'spt/updateGalian';
                break;
            case self::JENIS_PAJAK_RETRIBUSI:
                $url = 'spt/updateRetribusi';
                break;
            case self::JENIS_PAJAK_BPHTB:
                $url = 'spt/updateBphtb';
                break;
        }
        return Yii::app()->createUrl($url, array("id" => $id));
    }

}
