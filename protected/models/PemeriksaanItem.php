<?php

/**
 * This is the model class for table "pemeriksaan_item".
 *
 * The followings are the available columns in table 'pemeriksaan_item':
 * @property string $id
 * @property string $periode_awal
 * @property string $periode_akhir
 * @property double $kompensasi
 * @property double $setoran
 * @property double $kredit_lain
 * @property double $bunga
 * @property double $kenaikan
 * @property double $terhutang
 * @property double $total
 * @property string $spt_id
 * @property string $created
 * @property string $updated
 * @property integer $kode_rekening_id
 * @property integer $pemeriksaan_id
 *
 * The followings are the available model relations:
 * @property Spt $spt
 * @property KodeRekening $kodeRekening
 * @property Pemeriksaan $pemeriksaan
 */
class PemeriksaanItem extends CActiveRecord {

    public $total_kredit;
    public $total_sanksi;
    public $pajak;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'pemeriksaan_item';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('periode_awal, periode_akhir, spt_id, kode_rekening_id, pemeriksaan_id', 'required'),
            array('kode_rekening_id, pemeriksaan_id', 'numerical', 'integerOnly' => true),
            array('kompensasi, setoran, kredit_lain, bunga, kenaikan, terhutang, total', 'numerical'),
            array('total_kredit, total_sanksi, pajak', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, periode_awal, periode_akhir, kompensasi, setoran, kredit_lain, bunga, kenaikan, terhutang, total, spt_id, created, updated, kode_rekening_id, pemeriksaan_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'spt' => array(self::BELONGS_TO, 'Spt', 'spt_id'),
            'kodeRekening' => array(self::BELONGS_TO, 'KodeRekening', 'kode_rekening_id'),
            'pemeriksaan' => array(self::BELONGS_TO, 'Pemeriksaan', 'pemeriksaan_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => Yii::t('trans', 'ID'),
            'periode_awal' => Yii::t('trans', 'Periode Awal'),
            'periode_akhir' => Yii::t('trans', 'Periode Akhir'),
            'kompensasi' => Yii::t('trans', 'Kompensasi'),
            'setoran' => Yii::t('trans', 'Setoran'),
            'kredit_lain' => Yii::t('trans', 'Kredit Lain'),
            'bunga' => Yii::t('trans', 'Bunga'),
            'kenaikan' => Yii::t('trans', 'Kenaikan'),
            'terhutang' => Yii::t('trans', 'Terhutang'),
            'total' => Yii::t('trans', 'Total'),
            'spt_id' => Yii::t('trans', 'Spt'),
            'created' => Yii::t('trans', 'Created'),
            'updated' => Yii::t('trans', 'Updated'),
            'kode_rekening_id' => Yii::t('trans', 'Kode Rekening'),
            'pemeriksaan_id' => Yii::t('trans', 'Pemeriksaan'),
            'total_kredit' => Yii::t('trans', 'Total Kredit'),
            'total_sanksi' => Yii::t('trans', 'Total Sanksi'),
            'pajak' => Yii::t('trans', 'Pajak'),
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
        $criteria->compare('periode_awal', $this->periode_awal, true);
        $criteria->compare('periode_akhir', $this->periode_akhir, true);
        $criteria->compare('kompensasi', $this->kompensasi);
        $criteria->compare('setoran', $this->setoran);
        $criteria->compare('kredit_lain', $this->kredit_lain);
        $criteria->compare('bunga', $this->bunga);
        $criteria->compare('kenaikan', $this->kenaikan);
        $criteria->compare('terhutang', $this->terhutang);
        $criteria->compare('total', $this->total);
        $criteria->compare('spt_id', $this->spt_id, true);
        $criteria->compare('created', $this->created, true);
        $criteria->compare('updated', $this->updated, true);
        $criteria->compare('kode_rekening_id', $this->kode_rekening_id);
        $criteria->compare('pemeriksaan_id', $this->pemeriksaan_id);

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
     * @return PemeriksaanItem the static model class
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

}
