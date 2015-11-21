<?php

class ConfigForm extends CFormModel {

    public $title;
    public $adminEmail;
    public $nama_perusahaan;
    public $alamat_perusahaan;
    public $kota_perusahaan;
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
    public $ttd_kartu_npwpd_pejabat;

    public function rules() {
        return array(
            array('title, adminEmail, nama_perusahaan, kota_perusahaan, member, general_user_role, language, defaultPageSize, ttd_kartu_npwpd_pejabat', 'required'),
            array('title, adminEmail, nama_perusahaan', 'length', 'max' => 225),
            array('company_name_report, email_perusahaan, alamat_perusahaan, kota_perusahaan, company_description_report, company_address_report, language, defaultPageSize, currency_precision, qty_precision, ttd_kartu_npwpd_pejabat', 'safe'),
        );
    }

    public function attributeLabels() {
        return array(
            'title' => Yii::t('trans', 'Page Title'),
            'adminEmail' => Yii::t('trans', 'Admin Email'),
            'nama_perusahaan' => Yii::t('trans', 'Company Name'),
            'alamat_perusahaan' => Yii::t('trans', 'Company Address'),
            'kota_perusahaan' => Yii::t('trans', 'Company City'),
            'email_perusahaan' => Yii::t('trans', 'Company Email'),
            'member' => Yii::t('trans', 'Allow user registration?'),
            'general_user_role' => Yii::t('trans', 'New User Default Role'),
            'company_name_report' => Yii::t('trans', 'Company Name Report'),
            'company_description_report' => Yii::t('trans', 'Company Description Report'),
            'company_address_report' => Yii::t('trans', 'Company Address Report'),
            'language' => Yii::t('trans', 'Language'),
            'defaultPageSize' => Yii::t('trans', 'Default Page Size'),
            'currency_precision' => Yii::t('trans', 'Currency Precision'),
            'qty_precision' => Yii::t('trans', 'Quantity Precision'),
            'display_logo_perusahaan' => Yii::t('trans', 'Display Company Logo'),
            'ttd_kartu_npwpd_pejabat' => Yii::t('trans', 'Pejabat yg TTD di Kartu NPWPD'),
        );
    }

    public function getRoleOptions() {
        return CHtml::listData(Role::model()->findAll(), 'id', 'name');
    }
    public function getPejabatOptions() {
        return CHtml::listData(Pejabat::model()->findAll(), 'id', 'nipNama');
    }

    public function getLanguageOptions() {
        return TranslateModule::translator()->acceptedLanguages;
    }

}