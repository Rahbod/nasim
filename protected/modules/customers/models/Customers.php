<?php

/**
 * This is the model class for table "{{customers}}".
 *
 * The followings are the available columns in table '{{customers}}':
 * @property string $id
 * @property string $name
 * @property string $phone
 * @property string $mobile
 * @property string $country
 * @property string $address
 * @property string $email
 * @property string $code
 * @property string $id_number
 * @property integer $id_number_type
 * @property integer $creator_id
 * @property integer $attachment
 *
 * The followings are the available model relations:
 * @property Transfer[] $transfers
 * @property Transfer[] $transfers1
 */
class Customers extends CActiveRecord
{
	public static $idNumLabels = [
        0 => 'Alien registration number',
//        1 => 'Bank Account',
        2 => 'Benefits card/ID',
        3 => 'Birth Certificate',
        4 => 'Business registration/licence',
        5 => 'Credit card/debit card',
        6 => 'Driver Licence',
        7 => 'Membership ID',
        8 => 'National identity card',
        9 => 'Official passport',
        10 => 'Others',
        11 => 'Photo ID',
        12 => 'Proof of age card',
        13 => 'Security ID',
        14 => 'Social security ID',
        15 => 'Student',
        16 => 'Tax number/ID',
    ];

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{customers}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, mobile, country, address', 'required'),
			array('id_number_type, creator_id', 'numerical', 'integerOnly'=>true),
			array('name, email, code', 'length', 'max'=>255),
			array('phone, mobile, country', 'length', 'max'=>20),
			array('address, attachment', 'length', 'max'=>1023),
			array('id_number', 'length', 'max'=>50),
			array('id_number', 'default', 'value'=>''),
			array('id_number_type', 'default', 'value'=>0),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, phone, mobile, country, address, email, code, id_number, id_number_type, creator_id', 'safe', 'on'=>'search'),
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
			'transfers' => array(self::HAS_MANY, 'Transfer', 'sender_id'),
			'transfers1' => array(self::HAS_MANY, 'Transfer', 'receiver_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'نام و نام خانوادگی',
			'phone' => 'تلفن',
			'mobile' => 'موبایل',
			'country' => 'کشور',
			'address' => 'آدرس',
			'email' => 'پست الکترونیکی',
			'code' => 'کد',
			'id_number' => 'شناسه',
			'id_number_type' => 'نوع شناسه',
			'creator_id' => 'Creator',
			'attachment' => 'فایل ضمیمه',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('id_number',$this->id_number,true);
		$criteria->compare('id_number_type',$this->id_number_type);
		$criteria->compare('creator_id',$this->creator_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination' => array('pageSize' => 50)
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Customers the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
