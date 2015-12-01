<?php

/**
 * This is the model class for table "spt_item".
 *
 * The followings are the available columns in table 'spt_item':
 * @property string $id
 * @property double $pajak
 * @property double $nilai
 * @property double $tarif_dasar
 * @property double $tarif_persen
 * @property string $lokasi
 * @property integer $kode_rekening_id
 * @property string $spt_id
 * @property string $created
 * @property string $updated
 *
 * The followings are the available model relations:
 * @property KodeRekening $kodeRekening
 * @property Spt $spt
 */
class SptItem extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'spt_item';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pajak, nilai, kode_rekening_id, spt_id, created, updated', 'required'),
			array('kode_rekening_id', 'numerical', 'integerOnly'=>true),
			array('pajak, nilai, tarif_dasar, tarif_persen', 'numerical'),
			array('lokasi', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, pajak, nilai, tarif_dasar, tarif_persen, lokasi, kode_rekening_id, spt_id, created, updated', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'kodeRekening' => array(self::BELONGS_TO, 'KodeRekening', 'kode_rekening_id'),
			'spt' => array(self::BELONGS_TO, 'Spt', 'spt_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('trans','ID'),
			'pajak' => Yii::t('trans','Pajak'),
			'nilai' => Yii::t('trans','Nilai'),
			'tarif_dasar' => Yii::t('trans','Tarif Dasar'),
			'tarif_persen' => Yii::t('trans','Tarif Persen'),
			'lokasi' => Yii::t('trans','Lokasi'),
			'kode_rekening_id' => Yii::t('trans','Kode Rekening'),
			'spt_id' => Yii::t('trans','Spt'),
			'created' => Yii::t('trans','Created'),
			'updated' => Yii::t('trans','Updated'),
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
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('pajak',$this->pajak);
		$criteria->compare('nilai',$this->nilai);
		$criteria->compare('tarif_dasar',$this->tarif_dasar);
		$criteria->compare('tarif_persen',$this->tarif_persen);
		$criteria->compare('lokasi',$this->lokasi,true);
		$criteria->compare('kode_rekening_id',$this->kode_rekening_id);
		$criteria->compare('spt_id',$this->spt_id,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('updated',$this->updated,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination' => array(
                'pageSize' => Yii::app()->user->getState('pageSize' . $this->tableName(), Yii::app()->params['defaultPageSize']),
            ),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SptItem the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
