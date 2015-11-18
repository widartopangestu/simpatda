<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property string $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $fullname
 * @property string $phone_1
 * @property string $phone_2
 * @property string $address
 * @property integer $status
 * @property datetime $last_login
 * @property integer $role_id
 *
 * The followings are the available model relations:
 * @property Role $role
 * @property AccessLog[] $accessLogs
 */
class User extends CActiveRecord {

    const STATUS_NOACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_BANNED = -1;

    public $repeatpassword;
    public $verifyCode;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'user';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('username, phone_1, email', 'required'),
            array('password', 'required', 'on' => 'insert'),
            array('username, password, email', 'length', 'max' => 255),
            array('fullname, address, status', 'length', 'max' => 45),
            array('email', 'email'),
            array('phone_1, phone_2, role_id, activkey', 'safe'),
            array('username', 'unique', 'message' => "This user's name already exists."),
            array('email', 'unique', 'message' => "This user's email address already exists."),
            array('username', 'match', 'pattern' => '/^[A-Za-z0-9_]+$/u', 'message' => "Incorrect symbols (A-z0-9)."),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, username, password, email, phone_1, phone_2, fullname, address, status, role_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'role' => array(self::BELONGS_TO, 'Role', 'role_id'),
            'accessLogs' => array(self::HAS_MANY, 'AccessLog', 'user_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => Yii::t('trans', 'ID'),
            'username' => Yii::t('trans', 'Username'),
            'password' => Yii::t('trans', 'Password'),
            'email' => Yii::t('trans', 'Email'),
            'fullname' => Yii::t('trans', 'Fullname'),
            'phone_1' => Yii::t('trans', 'Phone 1'),
            'phone_2' => Yii::t('trans', 'Phone 2'),
            'address' => Yii::t('trans', 'Address'),
            'status' => Yii::t('trans', 'Status'),
            'last_login' => Yii::t('trans', 'Last Login'),
            'activkey' => Yii::t('trans', 'Activkey'),
            'role_id' => Yii::t('trans', 'Role'),
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
        $criteria->compare('username', $this->username, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('phone_1', $this->phone_1, true);
        $criteria->compare('fullname', $this->fullname, true);
        $criteria->compare('address', $this->address, true);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('last_login', $this->last_login, true);
        $criteria->compare('role_id', $this->role_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return User the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getRoleOptions() {
        return CHtml::listData(Role::model()->findAll(), 'id', 'name');
    }

    public function beforeSave() {
        if ($this->isNewRecord) {
            $this->password = sha1($this->password);
        } else {
            $user = User::model()->findByPk($this->id);
            if ($user->password != $this->password) {
                $this->password = sha1($this->password);
            }
        }
        return true;
    }

    public function getStatusOptions() {
        return array(
            self::STATUS_ACTIVE => Yii::t('trans', 'Active'),
            self::STATUS_NOACTIVE => Yii::t('trans', 'Not Active'),
            self::STATUS_BANNED => Yii::t('trans', 'Banned'),
        );
    }

    public function getStatusText($status = null) {
        $value = ($status === null) ? $this->status : $status;
        $statusOptions = $this->getStatusOptions();
        return isset($statusOptions[$value]) ?
                $statusOptions[$value] : "unknown status ({$value})";
    }

    public function getStatusValue($status = null) {
        $statusOptions = $this->getStatusOptions();
        return array_search($status, $statusOptions);
    }

    public function getOperationsArray() {
        $data = array();
        if (is_object($this->role))
            foreach ($this->role->operations as $operation)
                array_push($data, $operation->name);
        return $data;
    }

    /**
     * Checks if the given password is correct.
     * @param string the password to be validated
     * @return boolean whether the password is valid
     */
    public function validatePassword($password) {
        return sha1($password) === $this->password;
    }

    public function getRoleName() {
        return ($this->role !== NULL) ? $this->role->name : Yii::t('trans', 'Not Set');
    }

    public function getRoleNameLink() {
        return ($this->role !== NULL) ? CHtml::link(CHtml::encode($model->role->name), array('role/view', 'id' => $model->role_id)) : Yii::t('trans', 'Not Set');
    }

    /**
     * Send mail method
     */
    public static function sendMail($email, $subject, $message) {
        ini_set('max_execution_time', 300); //300 seconds = 5 minutes
        ini_set('memory_limit', '-1');

        $adminEmail = Yii::app()->params['adminEmail'];

        if (Yii::app()->params['mail_type'] == 'smtp') {
            Yii::import('ext.yii-mail.YiiMailMessage');
            $emailMessage = new YiiMailMessage;
            $emailMessage->subject = $subject;
            $emailMessage->setBody($message, 'text/html');
            $emailMessage->addTo($email);
            $emailMessage->from = $adminEmail;
            Yii::app()->mail->send($emailMessage);
        } else {
            $headers = "MIME-Version: 1.0\r\nFrom: $adminEmail\r\nReply-To: $adminEmail\r\nContent-Type: text/html; charset=utf-8";
            $message = wordwrap($message, 70);
            $message = str_replace("\n.", "\n..", $message);
            return mail($email, '=?UTF-8?B?' . base64_encode($subject) . '?=', $message, $headers);
        }
    }

    public function getNickname() {
        return (!empty($this->fullname)) ? $this->fullname : $this->username;
    }

    public function lastLogin() {
        $this->last_login = date("Y-m-d H:i:s");
        $this->save(FALSE);
    }

}
