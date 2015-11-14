<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity {

    const ERROR_USERNAME_INACTIVE = 99;
    const ERROR_USERNAME_BANNED = 98;

    private $_id;

    /**
     * Authenticates a user.
     * @return boolean whether authentication succeeds.
     */
    public function authenticate() {
        if (strpos($this->username, '@') !== false) {
            $user = User::model()->findByAttributes(array('email' => $this->username));
        } else {
            $user = User::model()->find('LOWER(username)=?', array(strtolower($this->username)));
        }     
        if ($user === null)
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        else if (!$user->validatePassword($this->password))
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        else if ($user->status == 0)
            $this->errorCode = self::ERROR_USERNAME_INACTIVE;
        else if ($user->status == -1)
            $this->errorCode = self::ERROR_USERNAME_BANNED;
        else {
            $this->_id = $user->id;
            $this->setState('lastLogin', $user->last_login);
            $this->errorCode = self::ERROR_NONE;
            $user->lastLogin();
        }
        return $this->errorCode == self::ERROR_NONE;
    }

    /**
     * @return integer the ID of the user record
     */
    public function getId() {
        return $this->_id;
    }

}
