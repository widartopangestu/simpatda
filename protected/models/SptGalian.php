<?php

/**
 * This is the model class for table "spt_galian".
 *
 * The followings are the available columns in table 'spt_galian':
 * @property integer $spt_id
 * @property string $nama
 * @property double $jml_rab
 * @property string $no_kontrak
 * @property string $created
 * @property string $updated
 *
 * The followings are the available model relations:
 * @property Spt $spt
 */
class SptGalian extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'spt_galian';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('spt_id, nama', 'required'),
            array('spt_id', 'numerical', 'integerOnly' => true),
            array('jml_rab', 'numerical'),
            array('no_kontrak', 'length', 'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('spt_id, nama, jml_rab, no_kontrak, created, updated', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'spt' => array(self::BELONGS_TO, 'Spt', 'spt_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'spt_id' => Yii::t('trans', 'Spt'),
            'nama' => Yii::t('trans', 'Nama'),
            'jml_rab' => Yii::t('trans', 'Jml Rab'),
            'no_kontrak' => Yii::t('trans', 'No Kontrak'),
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

        $criteria->compare('spt_id', $this->spt_id);
        $criteria->compare('nama', $this->nama, true);
        $criteria->compare('jml_rab', $this->jml_rab);
        $criteria->compare('no_kontrak', $this->no_kontrak, true);
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
     * @return SptGalian the static model class
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
