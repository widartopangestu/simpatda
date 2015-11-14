<?php

/**
 * JrUserForm class.
 * JrUserForm is the data structure for keeping
 */
class JrUserForm extends CFormModel {

    public $status;
    public $role_id;

    public function rules() {
        return array(
            array('status, role_id', 'safe'),
        );
    }

    public function attributeLabels() {
        return array(
            'status' => Yii::t('trans', 'Aktif Status'),
            'role_id' => Yii::t('trans', 'Role'),
        );
    }

    public function getStatusOptions() {
        return User::model()->getStatusOptions();
    }

    public function getRoleOptions() {
        return CHtml::listData(Role::model()->findAll(), 'id', 'name');
    }

}
