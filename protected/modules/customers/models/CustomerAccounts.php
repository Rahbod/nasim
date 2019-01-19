<?php

/**
 * This is the model class for table "{{customer_accounts}}".
 *
 * The followings are the available columns in table '{{customer_accounts}}':
 * @property string $id
 * @property string $customer_id
 * @property string $account_number
 * @property string $number_type
 * @property string $bank_name
 *
 * The followings are the available model relations:
 * @property Customers $customer
 */
class CustomerAccounts extends CActiveRecord
{
    const NUMBER_TYPE_ACCOUNT_NUMBER = 1;
    const NUMBER_TYPE_CREDIT_CARD = 2;
    const NUMBER_TYPE_SHEBA_NUMBER = 3;

    public static $numberTypeLabels = [
        self::NUMBER_TYPE_ACCOUNT_NUMBER => 'شماره حساب',
        self::NUMBER_TYPE_CREDIT_CARD => 'شماره کارت',
        self::NUMBER_TYPE_SHEBA_NUMBER => 'شماره شبا',
    ];

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{customer_accounts}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('customer_id, account_number, number_type, bank_name', 'required', 'except' => 'quick'),
			array('customer_id', 'length', 'max'=>10),
			array('account_number, bank_name', 'length', 'max'=>255),
			array('number_type', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, customer_id, account_number, number_type, bank_name', 'safe', 'on'=>'search'),
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
            'customer' => array(self::BELONGS_TO, 'Customers', 'customer_id')
        );
    }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'customer_id' => 'مشتری',
			'account_number' => 'شماره حساب',
			'number_type' => 'نوع شماره',
			'bank_name' => 'نام بانک',
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
		$criteria->compare('customer_id',$this->customer_id,true);
		$criteria->compare('account_number',$this->account_number,true);
		$criteria->compare('number_type',$this->number_type,true);
		$criteria->compare('bank_name',$this->bank_name,true);
		$criteria->order = 'id DESC';
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CustomerAccounts the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    /**
     * @param $userID
     * @param bool $count
     * @return CustomerAccounts[]|string
     */
    public static function getList($customerID, $count = false)
    {
        if ($count)
            return self::model()->countByAttributes(['customer_id' => $customerID]);
        $data = self::model()->findAllByAttributes(['customer_id' => $customerID]);
        return $data;
    }

    public function getHtml()
    {
        return "{$this->bank_name} - {$this->account_number} (".CustomerAccounts::$numberTypeLabels[$this->number_type].")";
    }
}
