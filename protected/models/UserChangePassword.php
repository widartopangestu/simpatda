<?php

/**
 * UserChangePassword class.
 * UserChangePassword is the data structure for keeping
 * user change password form data. It is used by the 'changepassword' action of 'UserController'.
 */
class UserChangePassword extends CFormModel {

    public $oldPassword;
    public $password;
    public $repeatpassword;

    public function rules() {
        return array(
            array('password, repeatpassword', 'required'),
            array('oldPassword, password, repeatpassword', 'length', 'max' => 128, 'min' => 4, 'message' => "Incorrect password (minimal length 4 symbols)."),
            array('repeatpassword', 'compare', 'compareAttribute' => 'password', 'message' => "Retype Password is incorrect."),
            array('oldPassword', 'required', 'on' => 'changepassword'),
            array('oldPassword', 'verifyOldPassword', 'on' => 'changepassword'),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels() {
        return array(
            'oldPassword' => Yii::t('trans', 'Old Password'),
            'password' => Yii::t('trans', 'Password'),
            'repeatpassword' => Yii::t('trans', 'Retype Password'),
        );
    }

    /**
     * Verify Old Password
     */
    public function verifyOldPassword($attribute, $params) {
        if (User::model()->findByPk(Yii::app()->user->id)->password != sha1($this->$attribute))
            $this->addError($attribute, "Old Password is incorrect.");
    }

}
