<?php

/**
 * This is the model class for table "pemeriksaan".
 *
 * The followings are the available columns in table 'pemeriksaan':
 * @property string $id
 * @property string $tanggal
 * @property integer $periode
 * @property integer $nomor
 * @property integer $wajib_pajak_id
 * @property integer $kode_rekening_id
 * @property string $spt_id
 * @property string $periode_awal
 * @property string $periode_akhir
 * @property string $tanggal_jatuh_tempo
 * @property double $kompensasi
 * @property double $setoran
 * @property double $kredit_lain
 * @property double $bunga
 * @property double $kenaikan
 * @property double $terhutang
 * @property double $nilai_pajak
 * @property string $created
 * @property string $updated
 *
 * The followings are the available model relations:
 * @property Penetapan[] $penetapans
 * @property WajibPajak $wajibPajak
 * @property KodeRekening $kodeRekening
 * @property Spt $spt
 */
class Pemeriksaan extends CActiveRecord {

    public $npwpd;
    public $nama;
    public $alamat;
    public $kecamatan;
    public $kelurahan;
    public $kabupaten;
    public $wp_search;
    public $total_kredit;
    public $total_sanksi;
    public $pajak;
    public $total;
    public $setoran_pajak_id;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'pemeriksaan';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('npwpd, tanggal, periode, nomor, wajib_pajak_id, spt_id, periode_awal, periode_akhir, terhutang, nilai_pajak', 'required'),
            array('periode, nomor, wajib_pajak_id, kode_rekening_id', 'numerical', 'integerOnly' => true),
            array('kompensasi, setoran, kredit_lain, bunga, kenaikan, terhutang, nilai_pajak, setoran_pajak_id', 'numerical'),
            array('tanggal_jatuh_tempo, nama, alamat, kabupaten, kecamatan, kelurahan, total_kredit, total_sanksi, pajak, total, setoran_pajak_id', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, tanggal, periode, nomor, wajib_pajak_id, kode_rekening_id, spt_id, periode_awal, periode_akhir, tanggal_jatuh_tempo, kompensasi, setoran, kredit_lain, bunga, kenaikan, terhutang, nilai_pajak, created, updated', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'penetapans' => array(self::HAS_MANY, 'Penetapan', 'pemeriksaan_id'),
            'wajibpajak' => array(self::BELONGS_TO, 'WajibPajak', 'wajib_pajak_id'),
            'kodeRekening' => array(self::BELONGS_TO, 'KodeRekening', 'kode_rekening_id'),
            'spt' => array(self::BELONGS_TO, 'Spt', 'spt_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => Yii::t('trans', 'ID'),
            'tanggal' => Yii::t('trans', 'Tanggal'),
            'periode' => Yii::t('trans', 'Periode'),
            'nomor' => Yii::t('trans', 'Nomor'),
            'wajib_pajak_id' => Yii::t('trans', 'Wajib Pajak'),
            'wp_search' => Yii::t('trans', 'Wajib Pajak'),
            'kode_rekening_id' => Yii::t('trans', 'Kode Rekening'),
            'spt_id' => Yii::t('trans', 'Spt'),
            'periode_awal' => Yii::t('trans', 'Periode Awal'),
            'periode_akhir' => Yii::t('trans', 'Periode Akhir'),
            'tanggal_jatuh_tempo' => Yii::t('trans', 'Tanggal Jatuh Tempo'),
            'kompensasi' => Yii::t('trans', 'Kompensasi'),
            'setoran' => Yii::t('trans', 'Setoran'),
            'kredit_lain' => Yii::t('trans', 'Kredit Lain'),
            'bunga' => Yii::t('trans', 'Bunga'),
            'kenaikan' => Yii::t('trans', 'Kenaikan'),
            'terhutang' => Yii::t('trans', 'Terhutang'),
            'nilai_pajak' => Yii::t('trans', 'Nilai Pajak'),
            'created' => Yii::t('trans', 'Created'),
            'updated' => Yii::t('trans', 'Updated'),
            'npwpd' => Yii::t('trans', 'NPWPD'),
            'nama' => Yii::t('trans', 'Nama WP'),
            'alamat' => Yii::t('trans', 'Alamat'),
            'kecamatan' => Yii::t('trans', 'Kecamatan'),
            'kelurahan' => Yii::t('trans', 'Kelurahan'),
            'kabupaten' => Yii::t('trans', 'Kabupaten'),
            'total_kredit' => Yii::t('trans', 'Total Kredit'),
            'total_sanksi' => Yii::t('trans', 'Total Sanksi'),
            'pajak' => Yii::t('trans', 'Pajak'),
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
        $criteria->compare('tanggal', $this->tanggal, true);
        $criteria->compare('periode', $this->periode);
        $criteria->compare('nomor', $this->nomor);
        $criteria->compare('wajib_pajak_id', $this->wajib_pajak_id);
        $criteria->compare('wajibpajak.nama', $this->wp_search, true);
        $criteria->compare('kode_rekening_id', $this->kode_rekening_id);
        $criteria->compare('spt_id', $this->spt_id, true);
        $criteria->compare('periode_awal', $this->periode_awal, true);
        $criteria->compare('periode_akhir', $this->periode_akhir, true);
        $criteria->compare('tanggal_jatuh_tempo', $this->tanggal_jatuh_tempo, true);
        $criteria->compare('kompensasi', $this->kompensasi);
        $criteria->compare('setoran', $this->setoran);
        $criteria->compare('kredit_lain', $this->kredit_lain);
        $criteria->compare('bunga', $this->bunga);
        $criteria->compare('kenaikan', $this->kenaikan);
        $criteria->compare('terhutang', $this->terhutang);
        $criteria->compare('nilai_pajak', $this->nilai_pajak);
        $criteria->compare('created', $this->created, true);
        $criteria->compare('updated', $this->updated, true);

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
     * @return Pemeriksaan the static model class
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

    public function beforeValidate() {
        if ($this->isNewRecord) {
            if (strtolower($this->nomor) === strtolower('AUTO')) {
                $sql = "SELECT MAX(nomor) AS maxnomor FROM pemeriksaan WHERE periode='$this->periode'";
                $result = Yii::app()->db->createCommand($sql)->queryRow();
                $new_code = $this->preventUniqueKode($result['maxnomor'] + 1);
                $this->nomor = (int) $new_code;
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

}
