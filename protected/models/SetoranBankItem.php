<?php

/**
 * This is the model class for table "setoran_bank_item".
 *
 * The followings are the available columns in table 'setoran_bank_item':
 * @property string $id
 * @property string $setoran_pajak_id
 * @property string $setoran_bank_id
 * @property string $created
 * @property string $updated
 *
 * The followings are the available model relations:
 * @property SetoranBank $setoranBank
 * @property SetoranPajak $setoranPajak
 */
class SetoranBankItem extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'setoran_bank_item';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('setoran_pajak_id, setoran_bank_id', 'required'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, setoran_pajak_id, setoran_bank_id, created, updated', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'setoranBank' => array(self::BELONGS_TO, 'SetoranBank', 'setoran_bank_id'),
            'setoranPajak' => array(self::BELONGS_TO, 'SetoranPajak', 'setoran_pajak_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => Yii::t('trans', 'ID'),
            'setoran_pajak_id' => Yii::t('trans', 'Setoran Pajak'),
            'setoran_bank_id' => Yii::t('trans', 'Setoran Bank'),
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

        $criteria->compare('id', $this->id, true);
        $criteria->compare('setoran_pajak_id', $this->setoran_pajak_id, true);
        $criteria->compare('setoran_bank_id', $this->setoran_bank_id, true);
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
     * @return SetoranBankItem the static model class
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
