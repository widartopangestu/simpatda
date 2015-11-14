<?php

/**
 * Backup
 * 
 * Yii module to backup, restore databse
 * 
 * @version 1.0
 * @author Shiv Charan Panjeta <shiv@toxsl.com> <shivcharan.panjeta@outlook.com>
 */

/**
 * UploadForm class.
 * UploadForm is the data structure for keeping
 */
class UploadForm extends CFormModel {

    public $upload_file;

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules() {
        if (!isset($this->scenario))
            $this->scenario = 'upload';

        return array(
//            array('upload_file', 'required'),
            array('upload_file', 'file', 'types' => 'sql'),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels() {
        return array(
            'upload_file' => Yii::t('trans', 'Upload File'),
        );
    }

    public static function label($n = 1) {
        return Yii::t('trans', 'File|Files', $n);
    }

}
