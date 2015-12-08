<?php

/**
 * This is the model class for table "pemeriksaan".
 *
 * The followings are the available columns in table 'pemeriksaan':
 * @property string $id
 * @property string $tanggal
 * @property integer $periode
 * @property integer $nomor
 * @property double $nilai_pajak
 * @property integer $wajib_pajak_id
 * @property integer $kode_rekening_id
 * @property string $created
 * @property string $updated
 *
 * The followings are the available model relations:
 * @property WajibPajak $wajibPajak
 * @property KodeRekening $kodeRekening
 * @property PemeriksaanItem[] $pemeriksaanItems
 */
class Pemeriksaan extends CActiveRecord {

    public $npwpd;
    public $nama;
    public $alamat;
    public $kecamatan;
    public $kelurahan;
    public $kabupaten;
    public $wp_search;

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
            array('npwpd, tanggal, periode, nomor, wajib_pajak_id', 'required'),
            array('periode, nomor, wajib_pajak_id, kode_rekening_id', 'numerical', 'integerOnly' => true),
            array('nilai_pajak', 'numerical'),
            array('nama, alamat, kabupaten, kecamatan, kelurahan', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, wp_search, tanggal, periode, nomor, nilai_pajak, wajib_pajak_id, kode_rekening_id, created, updated', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'wajibpajak' => array(self::BELONGS_TO, 'WajibPajak', 'wajib_pajak_id'),
            'kodeRekening' => array(self::BELONGS_TO, 'KodeRekening', 'kode_rekening_id'),
            'pemeriksaanItems' => array(self::HAS_MANY, 'PemeriksaanItem', 'pemeriksaan_id'),
            'pemeriksaanItemCount' => array(self::STAT, 'PemeriksaanItem', 'pemeriksaan_id'),
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
            'nilai_pajak' => Yii::t('trans', 'Nilai Pajak'),
            'wajib_pajak_id' => Yii::t('trans', 'Wajib Pajak'),
            'wp_search' => Yii::t('trans', 'Wajib Pajak'),
            'kode_rekening_id' => Yii::t('trans', 'Kode Rekening'),
            'created' => Yii::t('trans', 'Created'),
            'updated' => Yii::t('trans', 'Updated'),
            'npwpd' => Yii::t('trans', 'NPWPD'),
            'nama' => Yii::t('trans', 'Nama WP'),
            'alamat' => Yii::t('trans', 'Alamat'),
            'kecamatan' => Yii::t('trans', 'Kecamatan'),
            'kelurahan' => Yii::t('trans', 'Kelurahan'),
            'kabupaten' => Yii::t('trans', 'Kabupaten'),
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
        $criteria->compare('nilai_pajak', $this->nilai_pajak);
        $criteria->compare('wajib_pajak_id', $this->wajib_pajak_id);
        $criteria->compare('wajibpajak.nama', $this->wp_search, true);
        $criteria->compare('kode_rekening_id', $this->kode_rekening_id);
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
