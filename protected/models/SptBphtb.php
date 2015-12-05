<?php

/**
 * This is the model class for table "spt_bphtb".
 *
 * The followings are the available columns in table 'spt_bphtb':
 * @property integer $spt_id
 * @property string $nop
 * @property string $letak_lokasi
 * @property string $no_sertifikat
 * @property integer $ppat_notaris_id
 * @property double $tanah_luas
 * @property double $tanah_njop_pbb
 * @property double $tanah_hasil
 * @property double $bangunan_luas
 * @property double $bangunan_njop_pbb
 * @property double $bangunan_hasil
 * @property double $njop_pbb
 * @property string $keterangan
 * @property double $pbb_tanah_luas
 * @property double $pbb_tanah_njop_pbb
 * @property double $pbb_tanah_hasil
 * @property double $pbb_bangunan_luas
 * @property double $pbb_bangunan_njop_pbb
 * @property double $pbb_bangunan_hasil
 * @property double $pbb_njop_pbb
 * @property string $pbb_alamat
 * @property string $pbb_nama_wp
 * @property string $tindak_lanjut
 * @property string $created
 * @property string $updated
 *
 * The followings are the available model relations:
 * @property Spt $spt
 */
class SptBphtb extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'spt_bphtb';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('spt_id', 'required'),
            array('spt_id, ppat_notaris_id', 'numerical', 'integerOnly' => true),
            array('tanah_luas, tanah_njop_pbb, tanah_hasil, bangunan_luas, bangunan_njop_pbb, bangunan_hasil, njop_pbb, pbb_tanah_luas, pbb_tanah_njop_pbb, pbb_tanah_hasil, pbb_bangunan_luas, pbb_bangunan_njop_pbb, pbb_bangunan_hasil, pbb_njop_pbb', 'numerical'),
            array('nop', 'length', 'max' => 24),
            array('no_sertifikat', 'length', 'max' => 255),
            array('letak_lokasi, keterangan, pbb_alamat, pbb_nama_wp, tindak_lanjut', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('spt_id, nop, letak_lokasi, no_sertifikat, ppat_notaris_id, tanah_luas, tanah_njop_pbb, tanah_hasil, bangunan_luas, bangunan_njop_pbb, bangunan_hasil, njop_pbb, keterangan, pbb_tanah_luas, pbb_tanah_njop_pbb, pbb_tanah_hasil, pbb_bangunan_luas, pbb_bangunan_njop_pbb, pbb_bangunan_hasil, pbb_njop_pbb, pbb_alamat, pbb_nama_wp, tindak_lanjut, created, updated', 'safe', 'on' => 'search'),
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
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'spt_id' => Yii::t('trans', 'Spt'),
            'nop' => Yii::t('trans', 'Nop'),
            'letak_lokasi' => Yii::t('trans', 'Letak Lokasi'),
            'no_sertifikat' => Yii::t('trans', 'No Sertifikat'),
            'ppat_notaris_id' => Yii::t('trans', 'Ppat Notaris'),
            'tanah_luas' => Yii::t('trans', 'Tanah Luas'),
            'tanah_njop_pbb' => Yii::t('trans', 'Tanah Njop Pbb'),
            'tanah_hasil' => Yii::t('trans', 'Tanah Hasil'),
            'bangunan_luas' => Yii::t('trans', 'Bangunan Luas'),
            'bangunan_njop_pbb' => Yii::t('trans', 'Bangunan Njop Pbb'),
            'bangunan_hasil' => Yii::t('trans', 'Bangunan Hasil'),
            'njop_pbb' => Yii::t('trans', 'Njop Pbb'),
            'keterangan' => Yii::t('trans', 'Keterangan'),
            'pbb_tanah_luas' => Yii::t('trans', 'Pbb Tanah Luas'),
            'pbb_tanah_njop_pbb' => Yii::t('trans', 'Pbb Tanah Njop Pbb'),
            'pbb_tanah_hasil' => Yii::t('trans', 'Pbb Tanah Hasil'),
            'pbb_bangunan_luas' => Yii::t('trans', 'Pbb Bangunan Luas'),
            'pbb_bangunan_njop_pbb' => Yii::t('trans', 'Pbb Bangunan Njop Pbb'),
            'pbb_bangunan_hasil' => Yii::t('trans', 'Pbb Bangunan Hasil'),
            'pbb_njop_pbb' => Yii::t('trans', 'Pbb Njop Pbb'),
            'pbb_alamat' => Yii::t('trans', 'Pbb Alamat'),
            'pbb_nama_wp' => Yii::t('trans', 'Pbb Nama Wp'),
            'tindak_lanjut' => Yii::t('trans', 'Tindak Lanjut'),
            'created' => Yii::t('trans', 'Created'),
            'updated' => Yii::t('trans', 'Updated'),
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

        $criteria->compare('spt_id', $this->spt_id);
        $criteria->compare('nop', $this->nop, true);
        $criteria->compare('letak_lokasi', $this->letak_lokasi, true);
        $criteria->compare('no_sertifikat', $this->no_sertifikat, true);
        $criteria->compare('ppat_notaris_id', $this->ppat_notaris_id);
        $criteria->compare('tanah_luas', $this->tanah_luas);
        $criteria->compare('tanah_njop_pbb', $this->tanah_njop_pbb);
        $criteria->compare('tanah_hasil', $this->tanah_hasil);
        $criteria->compare('bangunan_luas', $this->bangunan_luas);
        $criteria->compare('bangunan_njop_pbb', $this->bangunan_njop_pbb);
        $criteria->compare('bangunan_hasil', $this->bangunan_hasil);
        $criteria->compare('njop_pbb', $this->njop_pbb);
        $criteria->compare('keterangan', $this->keterangan, true);
        $criteria->compare('pbb_tanah_luas', $this->pbb_tanah_luas);
        $criteria->compare('pbb_tanah_njop_pbb', $this->pbb_tanah_njop_pbb);
        $criteria->compare('pbb_tanah_hasil', $this->pbb_tanah_hasil);
        $criteria->compare('pbb_bangunan_luas', $this->pbb_bangunan_luas);
        $criteria->compare('pbb_bangunan_njop_pbb', $this->pbb_bangunan_njop_pbb);
        $criteria->compare('pbb_bangunan_hasil', $this->pbb_bangunan_hasil);
        $criteria->compare('pbb_njop_pbb', $this->pbb_njop_pbb);
        $criteria->compare('pbb_alamat', $this->pbb_alamat, true);
        $criteria->compare('pbb_nama_wp', $this->pbb_nama_wp, true);
        $criteria->compare('tindak_lanjut', $this->tindak_lanjut, true);

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
     * @return SptBphtb the static model class
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
