<?php

/**
 * This is the model class for table "pejabat".
 *
 * The followings are the available columns in table 'pejabat':
 * @property integer $id
 * @property string $kode
 * @property string $nama
 * @property string $nip
 * @property boolean $status
 * @property string $created
 * @property string $updated
 * @property integer $golongan_id
 * @property integer $jabatan_id
 * @property integer $pangkat_id
 *
 * The followings are the available model relations:
 * @property Jabatan $jabatan
 * @property Golongan $golongan
 * @property Pangkat $pangkat
 */
class Pejabat extends CActiveRecord {

    const STATUS_NOACTIVE = 0;
    const STATUS_ACTIVE = 1;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'pejabat';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('kode, nama, nip, golongan_id, jabatan_id, pangkat_id', 'required'),
            array('golongan_id, jabatan_id, pangkat_id', 'numerical', 'integerOnly' => true),
            array('kode', 'length', 'max' => 2),
            array('nama', 'length', 'max' => 255),
            array('nip', 'length', 'max' => 30),
            array('status', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, kode, nama, nip, status, created, updated, golongan_id, jabatan_id, pangkat_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'jabatan' => array(self::BELONGS_TO, 'Jabatan', 'jabatan_id'),
            'golongan' => array(self::BELONGS_TO, 'Golongan', 'golongan_id'),
            'pangkat' => array(self::BELONGS_TO, 'Pangkat', 'pangkat_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => Yii::t('trans', 'ID'),
            'kode' => Yii::t('trans', 'Kode'),
            'nama' => Yii::t('trans', 'Nama'),
            'nip' => Yii::t('trans', 'Nip'),
            'status' => Yii::t('trans', 'Status'),
            'created' => Yii::t('trans', 'Created'),
            'updated' => Yii::t('trans', 'Updated'),
            'golongan_id' => Yii::t('trans', 'Golongan'),
            'jabatan_id' => Yii::t('trans', 'Jabatan'),
            'pangkat_id' => Yii::t('trans', 'Pangkat'),
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

        $criteria->compare('id', $this->id);
        $criteria->compare('kode', $this->kode, true);
        $criteria->compare('nama', $this->nama, true);
        $criteria->compare('nip', $this->nip, true);
        $criteria->compare('status', $this->status);
        $criteria->compare('golongan_id', $this->golongan_id);
        $criteria->compare('jabatan_id', $this->jabatan_id);
        $criteria->compare('pangkat_id', $this->pangkat_id);

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
     * @return Pejabat the static model class
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

    public function getNipNama() {
        return $this->nip . ' ' . $this->nama;
    }

    public function getStatusOptions() {
        return array(
            self::STATUS_ACTIVE => Yii::t('trans', 'Active'),
            self::STATUS_NOACTIVE => Yii::t('trans', 'Not Active'),
        );
    }

    public function getStatusText($status = null) {
        $value = ($status === null) ? $this->status : $status;
        $statusOptions = $this->getStatusOptions();
        return isset($statusOptions[$value]) ?
                $statusOptions[$value] : "unknown status ({$value})";
    }

    public function getGolonganOptions() {
        return CHtml::listData(Golongan::model()->findAll(), 'id', 'nama');
    }

    public function getNamaGolongan() {
        return ($this->golongan_id !== NULL) ? $this->golongan->nama : Yii::t('trans', 'Not Set');
    }

    public function getJabatanOptions() {
        return CHtml::listData(Jabatan::model()->findAll(), 'id', 'nama');
    }

    public function getNamaJabatan() {
        return ($this->jabatan_id !== NULL) ? $this->jabatan->nama : Yii::t('trans', 'Not Set');
    }

    public function getPangkatOptions() {
        return CHtml::listData(Pangkat::model()->findAll(), 'id', 'nama');
    }

    public function getNamaPangkat() {
        return ($this->pangkat_id !== NULL) ? $this->pangkat->nama : Yii::t('trans', 'Not Set');
    }

}
