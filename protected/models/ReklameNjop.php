<?php

/**
 * This is the model class for table "reklame_njop".
 *
 * The followings are the available columns in table 'reklame_njop':
 * @property integer $id
 * @property string $nama
 * @property double $nilai
 * @property string $created
 * @property string $updated
 * @property integer $kode_rekening_id
 *
 * The followings are the available model relations:
 * @property KodeRekening $kodeRekening
 */
class ReklameNjop extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'reklame_njop';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('nama, nilai, kode_rekening_id', 'required'),
            array('kode_rekening_id', 'numerical', 'integerOnly' => true),
            array('nilai', 'numerical'),
            array('nama', 'length', 'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, nama, nilai, created, updated, kode_rekening_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'kodeRekening' => array(self::BELONGS_TO, 'KodeRekening', 'kode_rekening_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'nama' => 'Nama',
            'nilai' => 'Nilai',
            'created' => 'Created',
            'updated' => 'Updated',
            'kode_rekening_id' => 'Kode Rekening',
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
        $criteria->compare('nama', $this->nama, true);
        $criteria->compare('nilai', $this->nilai);
        $criteria->compare('created', $this->created, true);
        $criteria->compare('updated', $this->updated, true);
        $criteria->compare('kode_rekening_id', $this->kode_rekening_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return ReklameNjop the static model class
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
