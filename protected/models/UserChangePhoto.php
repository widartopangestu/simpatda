<?php

class UserChangePhoto extends CFormModel {

    public $image;

    public function rules() {
        return array(
            array('image', 'file', 'types' => 'png, jpg, jpeg', 'allowEmpty' => true),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels() {
        return array(
            'image' => Yii::t('trans', 'Photo Profile'),
        );
    }

    /**
     * Get Old Photo
     */
    public function getOldPhoto() {
        $mimage = User::model()->findByPk(Yii::app()->user->id);
        return (!empty($mimage->image)) ? $mimage->image : NULL;
    }

}
