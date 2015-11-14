<?php

/**
 * RegistrationForm class.
 * RegistrationForm is the data structure for keeping
 * user registration form data. It is used by the 'registration' action of 'UserController'.
 */
class UserProfileForm extends User {


    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('fullname, phone_1, phone_2, address', 'required'),
            array('email, fullname, phone_1, phone_2', 'length', 'max' => 255),
            array('email', 'email'),
            array('email', 'unique', 'message' => "This user's email address already exists."),
        );
    }

}