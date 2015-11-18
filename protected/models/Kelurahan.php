<?php

/**
 * This is the model class for table "kelurahan".
 *
 * The followings are the available columns in table 'kelurahan':
 * @property integer $id
 * @property string $kode
 * @property string $nama
 * @property string $created
 * @property string $updated
 * @property integer $kecamatan_id
 *
 * The followings are the available model relations:
 * @property WajibPajak[] $wajibPajaks
 * @property Kecamatan $kecamatan
 */
class Kelurahan extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'kelurahan';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('kode, nama, kecamatan_id', 'required'),
            array('kecamatan_id', 'numerical', 'integerOnly' => true),
            array('kode', 'length', 'max' => 2),
            array('nama', 'length', 'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, kode, nama, created, updated, kecamatan_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'wajibPajaks' => array(self::HAS_MANY, 'WajibPajak', 'kelurahan_id'),
            'kecamatan' => array(self::BELONGS_TO, 'Kecamatan', 'kecamatan_id'),
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
            'created' => Yii::t('trans', 'Created'),
            'updated' => Yii::t('trans', 'Updated'),
            'kecamatan_id' => Yii::t('trans', 'Kecamatan'),
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
        $criteria->compare('created', $this->created, true);
        $criteria->compare('updated', $this->updated, true);
        $criteria->compare('kecamatan_id', $this->kecamatan_id);

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
     * @return Kelurahan the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function beforeSave() {
        if ($this->isNewRecord)
            $this->created = new CDbExpression('NOW()');
        else
            $this->updated = new CDbExpression('NOW()');
        return parent::beforeSave();
    }

}
