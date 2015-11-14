<?php

/**
 * RegistrationForm class.
 * RegistrationForm is the data structure for keeping
 * user registration form data. It is used by the 'registration' action of 'UserController'.
 */
class UserRegistrationForm extends User {
    public $verifyCode;
    public $repeatpassword;

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('username, password, email', 'required'),
            array('repeatpassword', 'compare', 'compareAttribute' => 'password', 'message' => "Passwords don't match"),
            array('email', 'length', 'max' => 255),
            //array('surename, lastname', 'length', 'max' => 45),
            array('role_id', 'safe'),
            array('email', 'email'), 
            array('verifyCode', 'captcha'),
            array('username', 'match', 'pattern' => '/^[A-Za-z0-9_]+$/u', 'message' => "Incorrect symbols (A-z0-9)."),
            array('username', 'unique', 'message' => "This user's name already exists."),
            array('email', 'unique', 'message' => "This user's email address already exists."),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, username, password, email, fullname, activkey, status, role_id', 'safe', 'on' => 'search'),
        );
    }

}