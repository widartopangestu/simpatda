<?php

/**
 * This is the model class for table "spt_reklame".
 *
 * The followings are the available columns in table 'spt_reklame':
 * @property integer $spt_id
 * @property integer $jumlah
 * @property integer $lama
 * @property double $kelas_kawasan
 * @property double $kelas_luas
 * @property double $kelas_sudut_pandang
 * @property double $kelas_jalan
 * @property double $panjang
 * @property double $lebar
 * @property string $lokasi
 * @property string $judul
 * @property double $njopr
 * @property double $nspr
 * @property double $pajak
 * @property string $created
 * @property string $updated
 *
 * The followings are the available model relations:
 * @property Spt $spt
 */
class SptReklame extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'spt_reklame';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('spt_id, created, updated', 'required'),
			array('spt_id, jumlah, lama', 'numerical', 'integerOnly'=>true),
			array('kelas_kawasan, kelas_luas, kelas_sudut_pandang, kelas_jalan, panjang, lebar, njopr, nspr, pajak', 'numerical'),
			array('lokasi, judul', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('spt_id, jumlah, lama, kelas_kawasan, kelas_luas, kelas_sudut_pandang, kelas_jalan, panjang, lebar, lokasi, judul, njopr, nspr, pajak, created, updated', 'safe', 'on'=>'search'),
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
			'spt' => array(self::BELONGS_TO, 'Spt', 'spt_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'spt_id' => Yii::t('trans','Spt'),
			'jumlah' => Yii::t('trans','Jumlah'),
			'lama' => Yii::t('trans','Lama'),
			'kelas_kawasan' => Yii::t('trans','Kelas Kawasan'),
			'kelas_luas' => Yii::t('trans','Kelas Luas'),
			'kelas_sudut_pandang' => Yii::t('trans','Kelas Sudut Pandang'),
			'kelas_jalan' => Yii::t('trans','Kelas Jalan'),
			'panjang' => Yii::t('trans','Panjang'),
			'lebar' => Yii::t('trans','Lebar'),
			'lokasi' => Yii::t('trans','Lokasi'),
			'judul' => Yii::t('trans','Judul'),
			'njopr' => Yii::t('trans','Njopr'),
			'nspr' => Yii::t('trans','Nspr'),
			'pajak' => Yii::t('trans','Pajak'),
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

		$criteria->compare('spt_id',$this->spt_id);
		$criteria->compare('jumlah',$this->jumlah);
		$criteria->compare('lama',$this->lama);
		$criteria->compare('kelas_kawasan',$this->kelas_kawasan);
		$criteria->compare('kelas_luas',$this->kelas_luas);
		$criteria->compare('kelas_sudut_pandang',$this->kelas_sudut_pandang);
		$criteria->compare('kelas_jalan',$this->kelas_jalan);
		$criteria->compare('panjang',$this->panjang);
		$criteria->compare('lebar',$this->lebar);
		$criteria->compare('lokasi',$this->lokasi,true);
		$criteria->compare('judul',$this->judul,true);
		$criteria->compare('njopr',$this->njopr);
		$criteria->compare('nspr',$this->nspr);
		$criteria->compare('pajak',$this->pajak);
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
	 * @return SptReklame the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
