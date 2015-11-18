<?php

/**
 * This is the model class for table "kode_rekening".
 *
 * The followings are the available columns in table 'kode_rekening':
 * @property integer $id
 * @property string $kode
 * @property string $nama
 * @property double $tarif_persen
 * @property double $tarif_dasar
 * @property string $created
 * @property string $updated
 * @property integer $parent_id
 *
 * The followings are the available model relations:
 * @property KodeRekening $parent
 * @property KodeRekening[] $kodeRekenings
 */
class KodeRekening extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'kode_rekening';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('kode, nama', 'required'),
            array('parent_id', 'numerical', 'integerOnly' => true),
            array('tarif_persen, tarif_dasar', 'numerical'),
            array('kode, nama', 'length', 'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, kode, nama, tarif_persen, tarif_dasar, created, updated, parent_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'parent' => array(self::BELONGS_TO, 'KodeRekening', 'parent_id'),
            'kodeRekenings' => array(self::HAS_MANY, 'KodeRekening', 'parent_id'),
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
            'tarif_persen' => Yii::t('trans', 'Tarif Persen'),
            'tarif_dasar' => Yii::t('trans', 'Tarif Dasar'),
            'created' => Yii::t('trans', 'Created'),
            'updated' => Yii::t('trans', 'Updated'),
            'parent_id' => Yii::t('trans', 'Parent'),
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
        $criteria->compare('tarif_persen', $this->tarif_persen);
        $criteria->compare('tarif_dasar', $this->tarif_dasar);
        $criteria->compare('created', $this->created, true);
        $criteria->compare('updated', $this->updated, true);
        $criteria->compare('parent_id', $this->parent_id);

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
     * @return KodeRekening the static model class
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

}
