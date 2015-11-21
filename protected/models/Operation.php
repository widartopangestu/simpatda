<?php

/**
 * This is the model class for table "operation".
 *
 * The followings are the available columns in table 'operation':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $nama_modul
 * @property integer $grup
 * @property integer $urutan_ke
 * @property integer $tampilkan_dirole
 *
 * The followings are the available model relations:
 * @property Role[] $roles
 */
class Operation extends CActiveRecord {

    const GRUP_SISTEM = 1;
    const GRUP_MASTER = 2;
    const GRUP_REPORT = 3;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'operation';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, nama_modul', 'required'),
            array('grup, urutan_ke, tampilkan_dirole', 'numerical', 'integerOnly' => true),
            array('name, description, nama_modul', 'length', 'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, name, description, nama_modul, grup, urutan_ke, tampilkan_dirole', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'roles' => array(self::MANY_MANY, 'Role', 'role_access(operation_id, role_id)'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => Yii::t('trans', 'ID'),
            'name' => Yii::t('trans', 'Name'),
            'description' => Yii::t('trans', 'Description'),
            'nama_modul' => Yii::t('trans', 'Nama Modul'),
            'grup' => Yii::t('trans', 'Grup'),
            'urutan_ke' => Yii::t('trans', 'Urutan Ke'),
            'tampilkan_dirole' => Yii::t('trans', 'Tampilkan Dirole'),
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

        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('nama_modul', $this->nama_modul, true);
        $criteria->compare('grup', $this->grup);
        $criteria->compare('urutan_ke', $this->urutan_ke);
        $criteria->compare('tampilkan_dirole', $this->tampilkan_dirole);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => Yii::app()->user->getState('pageSize' . $this->tableName(), Yii::app()->params['defaultPageSize']),
            ),
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Operation the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getDescriptionByName($name) {
        return $this->find('name = :name', array(":name" => $name))->description;
    }

    public function getGrupOptions() {
        return array(
            self::GRUP_SISTEM => Yii::t('trans', 'Sistem'),
            self::GRUP_MASTER => Yii::t('trans', 'Master'),
            self::GRUP_REPORT => Yii::t('trans', 'Report'),
        );
    }

    public function getGrupText($grup = null) {
        $value = ($grup === null) ? $this->grup : $grup;
        $grupOptions = $this->getGrupOptions();
        return isset($grupOptions[$value]) ?
                $grupOptions[$value] : "unknown grup ({$value})";
    }

}
