<?php

/**
 * This is the model class for table "penetapan_denda".
 *
 * The followings are the available columns in table 'penetapan_denda':
 * @property string $penetapan_id
 * @property double $nilai_denda
 * @property integer $jumlah_bulan
 * @property string $keterangan
 * @property integer $kode_rekening_id
 * @property string $setoran_pajak_id
 * @property string $created
 * @property string $updated
 *
 * The followings are the available model relations:
 * @property KodeRekening $kodeRekening
 * @property Penetapan $penetapan
 */
class PenetapanDenda extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'penetapan_denda';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('penetapan_id, nilai_denda, jumlah_bulan, setoran_pajak_id, created, updated', 'required'),
			array('jumlah_bulan, kode_rekening_id', 'numerical', 'integerOnly'=>true),
			array('nilai_denda', 'numerical'),
			array('keterangan', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('penetapan_id, nilai_denda, jumlah_bulan, keterangan, kode_rekening_id, setoran_pajak_id, created, updated', 'safe', 'on'=>'search'),
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
			'penetapan' => array(self::BELONGS_TO, 'Penetapan', 'penetapan_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'penetapan_id' => Yii::t('trans','Penetapan'),
			'nilai_denda' => Yii::t('trans','Nilai Denda'),
			'jumlah_bulan' => Yii::t('trans','Jumlah Bulan'),
			'keterangan' => Yii::t('trans','Keterangan'),
			'kode_rekening_id' => Yii::t('trans','Kode Rekening'),
			'setoran_pajak_id' => Yii::t('trans','Setoran Pajak'),
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

		$criteria->compare('penetapan_id',$this->penetapan_id,true);
		$criteria->compare('nilai_denda',$this->nilai_denda);
		$criteria->compare('jumlah_bulan',$this->jumlah_bulan);
		$criteria->compare('keterangan',$this->keterangan,true);
		$criteria->compare('kode_rekening_id',$this->kode_rekening_id);
		$criteria->compare('setoran_pajak_id',$this->setoran_pajak_id,true);
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
	 * @return PenetapanDenda the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
