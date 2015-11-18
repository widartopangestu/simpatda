<?php

/**
 * This is the model class for table "access_log".
 *
 * The followings are the available columns in table 'access_log':
 * @property integer $id
 * @property integer $type
 * @property string $activity
 * @property string $time
 * @property integer $user_id
 *
 * The followings are the available model relations:
 * @property User $user
 */
class AccessLog extends CActiveRecord {

    const TYPE_ERROR = 0;
    const TYPE_WARNING = 1;
    const TYPE_SUCCESS = 2;
    const TYPE_INFO = 3;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'access_log';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('user_id', 'required'),
            array('type, user_id', 'numerical', 'integerOnly' => true),
            array('activity, time', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, type, activity, time, user_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => Yii::t('trans', 'ID'),
            'type' => Yii::t('trans', 'Type'),
            'activity' => Yii::t('trans', 'Activity'),
            'time' => Yii::t('trans', 'Time'),
            'user_id' => Yii::t('trans', 'User'),
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
        $criteria->compare('type', $this->type);
        $criteria->compare('activity', $this->activity, true);
        $criteria->compare('time', $this->time, true);
        $criteria->compare('user_id', $this->user_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 'time DESC',
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
     * @return AccessLog the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getTypeOptions() {
        return array(
            self::TYPE_ERROR => 'error',
            self::TYPE_WARNING => 'warning',
            self::TYPE_SUCCESS => 'success',
            self::TYPE_INFO => 'info',
        );
    }

    public function getTypeText($type = null) {
        $value = ($type === null) ? $this->type : $type;
        $typeOptions = $this->getTypeOptions();
        return isset($typeOptions[$value]) ?
                $typeOptions[$value] : "Not Set";
    }

    public function getUserName() {
        return ($this->user !== NULL) ? $this->user->username : 'Not Set';
    }

    public function getUserOptions() {
        return CHtml::listData(User::model()->findAll('status=' . User::STATUS_ACTIVE), 'id', 'username');
    }

    public function beforeSave() {
        if ($this->isNewRecord)
            $this->time = new CDbExpression('NOW()');
        return parent::beforeSave();
    }

}
