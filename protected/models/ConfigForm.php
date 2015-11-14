<?php

class ConfigForm extends CFormModel {

    public $title;
    public $adminEmail;
    public $nama_perusahaan;
    public $alamat_perusahaan;
    public $email_perusahaan;
    public $member;
    public $general_user_role;
    public $company_name_report;
    public $company_description_report;
    public $company_address_report;
    public $defaultPageSize;
    public $language;
    public $currency_precision;
    public $qty_precision;
    public $display_logo_perusahaan;

    public function rules() {
        return array(
            array('title, adminEmail, nama_perusahaan, member, general_user_role, language, defaultPageSize', 'required'),
            array('title, adminEmail, nama_perusahaan', 'length', 'max' => 225),
            array('company_name_report, email_perusahaan, alamat_perusahaan, company_description_report, company_address_report, language, defaultPageSize, currency_precision, qty_precision', 'safe'),
        );
    }

    public function attributeLabels() {
        return array(
            'title' => Yii::t('config', 'Page Title'),
            'adminEmail' => Yii::t('config', 'Admin Email'),
            'nama_perusahaan' => Yii::t('config', 'Company Name'),
            'alamat_perusahaan' => Yii::t('config', 'Company Address'),
            'email_perusahaan' => Yii::t('config', 'Company Email'),
            'member' => Yii::t('config', 'Allow user registration?'),
            'general_user_role' => Yii::t('config', 'New User Default Role'),
            'company_name_report' => Yii::t('config', 'Company Name Report'),
            'company_description_report' => Yii::t('config', 'Company Description Report'),
            'company_address_report' => Yii::t('config', 'Company Address Report'),
            'language' => Yii::t('config', 'Language'),
            'defaultPageSize' => Yii::t('config', 'Default Page Size'),
        );
    }

    public function getRoleOptions() {
        return CHtml::listData(Role::model()->findAll(), 'id', 'name');
    }

    public function getLanguageOptions() {
        return TranslateModule::translator()->acceptedLanguages;
    }

}