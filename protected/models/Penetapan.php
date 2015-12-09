<?php

/**
 * This is the model class for table "penetapan".
 *
 * The followings are the available columns in table 'penetapan':
 * @property string $id
 * @property string $tanggal_penetapan
 * @property string $tanggal_jatuh_tempo
 * @property integer $kohir
 * @property string $spt_id
 * @property integer $jenis_surat_id
 * @property string $created
 * @property string $updated
 * @property string $pemeriksaan_id
 *
 * The followings are the available model relations:
 * @property PenetapanDenda $penetapanDenda
 * @property PenetapanKurangBayar $penetapanKurangBayar
 * @property SetoranPajak[] $setoranPajaks
 * @property Spt $spt
 * @property JenisSurat $jenisSurat
 * @property Pemeriksaan $pemeriksaan
 */
class Penetapan extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'penetapan';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('tanggal_penetapan, tanggal_jatuh_tempo, jenis_surat_id', 'required'),
            array('kohir, jenis_surat_id', 'numerical', 'integerOnly' => true),
            array('spt_id, pemeriksaan_id', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, tanggal_penetapan, tanggal_jatuh_tempo, kohir, spt_id, jenis_surat_id, created, updated, pemeriksaan_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'penetapanDenda' => array(self::HAS_ONE, 'PenetapanDenda', 'penetapan_id'),
            'penetapanKurangBayar' => array(self::HAS_ONE, 'PenetapanKurangBayar', 'penetapan_id'),
            'setoranPajaks' => array(self::HAS_MANY, 'SetoranPajak', 'penetapan_id'),
            'spt' => array(self::BELONGS_TO, 'Spt', 'spt_id'),
            'jenisSurat' => array(self::BELONGS_TO, 'JenisSurat', 'jenis_surat_id'),
            'pemeriksaan' => array(self::BELONGS_TO, 'Pemeriksaan', 'pemeriksaan_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => Yii::t('trans', 'ID'),
            'tanggal_penetapan' => Yii::t('trans', 'Tanggal Penetapan'),
            'tanggal_jatuh_tempo' => Yii::t('trans', 'Tanggal Jatuh Tempo'),
            'kohir' => Yii::t('trans', 'Kohir'),
            'spt_id' => Yii::t('trans', 'Spt'),
            'jenis_surat_id' => Yii::t('trans', 'Jenis Surat'),
            'created' => Yii::t('trans', 'Created'),
            'updated' => Yii::t('trans', 'Updated'),
            'pemeriksaan_id' => Yii::t('trans', 'Pemeriksaan'),
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

        $criteria->compare('id', $this->id, true);
        if ($this->tanggal_penetapan)
            $criteria->addCondition('tanggal_penetapan=\'' . date_format(date_create_from_format('d/m/Y', $this->tanggal_penetapan), "Y-m-d") . '\'');
        if ($this->tanggal_jatuh_tempo)
            $criteria->addCondition('tanggal_jatuh_tempo=\'' . date_format(date_create_from_format('d/m/Y', $this->tanggal_jatuh_tempo), "Y-m-d") . '\'');
        $criteria->compare('kohir', $this->kohir);
        $criteria->compare('spt_id', $this->spt_id, true);
        $criteria->compare('jenis_surat_id', $this->jenis_surat_id);
        $criteria->compare('pemeriksaan_id', $this->pemeriksaan_id, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 't.created DESC'
            ),
            'pagination' => array(
                'pageSize' => Yii::app()->user->getState('pageSize' . $this->tableName(), Yii::app()->params['defaultPageSize']),
            ),
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Penetapan the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function behaviors() {
        return array(
            'timestamps' => array(
                'class' => 'zii.behaviors.CTimestampBehavior',
                'createAttribute' => 'created',
                'updateAttribute' => 'updated',
                'timestampExpression' => new CDbExpression('NOW()'),
                'setUpdateOnCreate' => true,
            ),
        );
    }

    public function getJenisSuratOptions() {
        return CHtml::listData(JenisSurat::model()->findAll(), 'id', 'nama');
    }

    public function getNamaJenisSurat() {
        return ($this->jenis_surat_id !== NULL) ? $this->jenisSurat->nama : Yii::t('trans', 'Not Set');
    }

    public function beforeSave() {
        if ($this->isNewRecord) {
            $periode = date('Y', strtotime($this->tanggal_penetapan));
            $sql = "SELECT MAX(kohir) AS maxnomor FROM penetapan WHERE jenis_surat_id =$this->jenis_surat_id AND date_part('year', tanggal_penetapan)='$periode'";
            $result = Yii::app()->db->createCommand($sql)->queryRow();
            $new_code = $this->preventUniqueKode($result['maxnomor'] + 1);
            $this->kohir = $new_code;
        }
        return parent::beforeSave();
    }

    public function preventUniqueKode($count) {
        $form = (int) $count;
        $periode = date('Y', strtotime($this->tanggal_penetapan));
        $flag = self::model()->find("kohir = '$form' AND jenis_surat_id =$this->jenis_surat_id AND date_part('year', tanggal_penetapan)='$periode'");
        if ($flag) {
            $count++;
            $form = $this->preventUniqueNumber($count);
        }
        return $form;
    }

}
