<?php

/**
 * This is the model class for table "setoran_pajak".
 *
 * The followings are the available columns in table 'setoran_pajak':
 * @property string $id
 * @property integer $nomor
 * @property string $tanggal_bayar
 * @property double $jumlah_bayar
 * @property double $jumlah_potongan
 * @property integer $via_bayar
 * @property string $nama_penyetor
 * @property string $penetapan_id
 * @property string $created
 * @property string $updated
 *
 * The followings are the available model relations:
 * @property Penetapan $penetapan
 * @property SetoranBankItem[] $setoranBankItems
 */
class SetoranPajak extends CActiveRecord {

    const VIA_BAYAR_BENDAHARA = 1;
    const VIA_BAYAR_BANK = 2;
    const DENDA_PAJAK_HOTEL = 381;
    const DENDA_PAJAK_RESTORAN = 382;
    const DENDA_PAJAK_HIBURAN = 383;
    const DENDA_PAJAK_REKLAME = 384;
    const DENDA_PAJAK_ELECTRIC = 385;
    const DENDA_PAJAK_GALIAN = 389;
    const DENDA_PAJAK_AIR = 387;
    const DENDA_PAJAK_WALET = 388;
    const DENDA_PAJAK_RETRIBUSI = 419;

//    const DENDA_PAJAK_BPHTB = #;

    public $kohir;
    public $jenis_surat;
    public $npwpd;
    public $nama;
    public $alamat;
    public $kecamatan;
    public $kelurahan;
    public $kabupaten;
    public $tanggal_jatuh_tempo;
    public $jumlah_pajak;
    public $jumlah_pajak_denda;
    public $jumlah_bayar_denda;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'setoran_pajak';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('nomor, tanggal_bayar, jumlah_bayar, penetapan_id, kohir', 'required'),
            array('nomor, via_bayar', 'numerical', 'integerOnly' => true),
            array('jumlah_bayar, jumlah_potongan', 'numerical'),
            array('nama_penyetor', 'length', 'max' => 255),
            array('jumlah_pajak, jumlah_bayar_denda, jumlah_pajak_denda, jenis_surat', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, nomor, tanggal_bayar, jumlah_bayar, jumlah_potongan, via_bayar, nama_penyetor, penetapan_id, created, updated', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'penetapan' => array(self::BELONGS_TO, 'Penetapan', 'penetapan_id'),
            'setoranBankItems' => array(self::HAS_MANY, 'SetoranBankItem', 'setoran_pajak_id'),
            'penetapanDenda' => array(self::HAS_ONE, 'PenetapanDenda', 'setoran_pajak_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => Yii::t('trans', 'ID'),
            'nomor' => Yii::t('trans', 'Nomor'),
            'tanggal_bayar' => Yii::t('trans', 'Tanggal Bayar'),
            'jumlah_bayar' => Yii::t('trans', 'Jumlah Bayar'),
            'jumlah_potongan' => Yii::t('trans', 'Jumlah Potongan'),
            'via_bayar' => Yii::t('trans', 'Via Bayar'),
            'nama_penyetor' => Yii::t('trans', 'Nama Penyetor'),
            'penetapan_id' => Yii::t('trans', 'Penetapan'),
            'kohir' => Yii::t('trans', 'Kohir'),
            'created' => Yii::t('trans', 'Created'),
            'updated' => Yii::t('trans', 'Updated'),
            'npwpd' => Yii::t('trans', 'NPWPD'),
            'nama' => Yii::t('trans', 'Nama WP'),
            'alamat' => Yii::t('trans', 'Alamat'),
            'kecamatan' => Yii::t('trans', 'Kecamatan'),
            'kelurahan' => Yii::t('trans', 'Kelurahan'),
            'tanggal_jatuh_tempo' => Yii::t('trans', 'Batas Penyetoran Terakhir'),
            'jumlah_pajak' => Yii::t('trans', 'Jumlah Pajak'),
            'jumlah_pajak_denda' => Yii::t('trans', 'Jumlah Pajak'),
            'jenis_surat' => Yii::t('trans', 'Jenis Surat'),
            'jumlah_bayar_denda' => Yii::t('trans', 'Jumlah Bayar'),
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

        $criteria->compare('t.id', $this->id, true);
        $criteria->compare('t.nomor', $this->nomor);
        $criteria->compare('t.tanggal_bayar', $this->tanggal_bayar, true);
        $criteria->compare('t.jumlah_bayar', $this->jumlah_bayar);
        $criteria->compare('t.jumlah_potongan', $this->jumlah_potongan);
        $criteria->compare('t.via_bayar', $this->via_bayar);
        $criteria->compare('t.nama_penyetor', $this->nama_penyetor, true);
        $criteria->compare('t.penetapan_id', $this->penetapan_id, true);
        $criteria->compare('t.created', $this->created, true);
        $criteria->compare('t.updated', $this->updated, true);

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
     * @return SetoranPajak the static model class
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

    public function getViaBayarOptions() {
        return array(
            self::VIA_BAYAR_BENDAHARA => Yii::t('trans', 'Bendahara Penerima'),
            self::VIA_BAYAR_BANK => Yii::t('trans', 'Bank/Kasda'),
        );
    }

    public function getViaBayarText($viaBayar = null) {
        $value = ($viaBayar === null) ? $this->via_bayar : $viaBayar;
        $viaBayarOptions = $this->getViaBayarOptions();
        return isset($viaBayarOptions[$value]) ?
                $viaBayarOptions[$value] : "unknown Jenis Pemungutan ({$value})";
    }

    public function getJenisSuratOptions() {
        return CHtml::listData(JenisSurat::model()->findAll(), 'id', 'nama');
    }

    public function getNamaJenisSurat() {
        return ($this->penetapan_id !== NULL) ? $this->penetapan->jenisSurat->nama : Yii::t('trans', 'Not Set');
    }

    public function beforeValidate() {
        if ($this->isNewRecord) {
            if (empty($this->nomor)) {
                $periode = date('Y', strtotime($this->tanggal_bayar));
                $sql = "SELECT MAX(nomor) AS maxnomor FROM setoran_pajak WHERE date_part('year', tanggal_bayar)='$periode'";
                $result = Yii::app()->db->createCommand($sql)->queryRow();
                $new_code = $this->preventUniqueKode($result['maxnomor'] + 1);
                $this->nomor = $new_code;
            }
        }
        return parent::beforeValidate();
    }

    public function preventUniqueKode($count) {
        $form = (int) $count;
        $periode = date('Y', strtotime($this->tanggal_bayar));
        $flag = self::model()->find("nomor = '$form' AND date_part('year', tanggal_bayar)='$periode'");
        if ($flag) {
            $count++;
            $form = $this->preventUniqueNumber($count);
        }
        return $form;
    }

    public function getKodeRekeningDenda($parent) {
        $id = null;
        switch ($parent) {
            case Spt::PARENT_HOTEL:
                $id = self::DENDA_PAJAK_HOTEL;
                break;
            case Spt::PARENT_RESTORAN:
                $id = self::DENDA_PAJAK_RESTORAN;
                break;
            case Spt::PARENT_HIBURAN:
                $id = self::DENDA_PAJAK_HIBURAN;
                break;
            case Spt::PARENT_REKLAME:
                $id = self::DENDA_PAJAK_REKLAME;
                break;
            case Spt::PARENT_ELECTRIC:
                $id = self::DENDA_PAJAK_ELECTRIC;
                break;
            case Spt::PARENT_AIR:
                $id = self::DENDA_PAJAK_AIR;
                break;
            case Spt::PARENT_WALET:
                $id = self::DENDA_PAJAK_WALET;
                break;
            case Spt::PARENT_GALIAN:
                $id = self::DENDA_PAJAK_GALIAN;
                break;
            case Spt::PARENT_RETRIBUSI:
                $id = self::DENDA_PAJAK_RETRIBUSI;
                break;
        }
        return KodeRekening::model()->findByPk($id);
    }

}
