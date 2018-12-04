<?php

/**
 * This is the model class for table "{{transfer}}".
 *
 * The followings are the available columns in table '{{transfer}}':
 * @property string $id
 * @property string $code
 * @property string $sender_id
 * @property string $receiver_id
 * @property string $branch_id
 * @property string $date
 * @property string $origin_country
 * @property string $destination_country
 * @property string $foreign_currency
 * @property string $currency_amount
 * @property string $currency_price
 * @property string $total_amount
 * @property string $payment_method
 * @property int $payment_status
 *
 * The followings are the available model relations:
 * @property Customers $sender
 * @property Customers $receiver
 * @property Admins $branch
 */
class Transfer extends CActiveRecord
{
    const PAYMENT_METHOD_CASH = 0;
    const PAYMENT_METHOD_DEBTOR = 1;

    const PAYMENT_STATUS_UNPAID = 0;
    const PAYMENT_STATUS_PAID = 1;

    public static $countryLabels = [
        'IRAN' => 'ایران',
        'AUSTRALIA' => 'استرالیا',
        'EMIRATES' => 'امارات',
    ];

    public static $foreignCurrencyLabels = [
        'IRR' => 'ریال ایران',
        'AUD' => 'دلار استرالیا',
        'AED' => 'درهم امارت',
    ];

    public static $paymentStatusLabels = [
        self::PAYMENT_STATUS_PAID=>'پرداخت شده',
        self::PAYMENT_STATUS_UNPAID=>'پرداخت نشده',
    ];
    public static $paymentMethodLabels = [
        self::PAYMENT_METHOD_CASH=>'نقدی',
        self::PAYMENT_METHOD_DEBTOR=>'علی الحساب',
    ];

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{transfer}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('code, date', 'length', 'max'=>20),
			array('sender_id, receiver_id, branch_id', 'length', 'max'=>10),
			array('payment_status, payment_method', 'length', 'max'=>1),
			array('payment_status', 'default', 'value'=>0),
			array('payment_method', 'default', 'value'=>0),
			array('origin_country, destination_country, foreign_currency, currency_amount, currency_price, total_amount', 'length', 'max'=>255),
            array('date', 'default', 'value' => time(), 'on' => 'create'),
            array('origin_country','compare','compareAttribute'=>'destination_country','operator'=>'!=','message'=>'کشور مبدا و کشور مقصد نمی تواند یکسان باشد.'),
            // The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, payment_status, payment_method, code, sender_id, receiver_id, branch_id, date, origin_country, destination_country, foreign_currency, currency_amount, currency_price, total_amount', 'safe', 'on'=>'search'),
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
			'sender' => array(self::BELONGS_TO, 'Customers', 'sender_id'),
			'receiver' => array(self::BELONGS_TO, 'Customers', 'receiver_id'),
			'branch' => array(self::BELONGS_TO, 'Admins', 'branch_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'code' => 'کد حواله',
			'sender_id' => 'فرستنده',
			'receiver_id' => 'دریافت کننده',
			'branch_id' => 'شعبه',
			'date' => 'تاریخ ثبت',
			'origin_country' => 'کشور مبدا',
			'destination_country' => 'کشور مقصد',
			'foreign_currency' => 'ارز',
			'currency_amount' => 'مقدار',
			'currency_price' => 'نرخ ارز',
			'total_amount' => 'مقدار کل',
			'payment_method' => 'نوع پرداخت',
			'payment_status' => 'وضعیت پرداخت',
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

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('code', $this->code, true);
        $criteria->compare('sender_id', $this->sender_id, true);
        $criteria->compare('receiver_id', $this->receiver_id, true);
        $criteria->compare('branch_id', $this->branch_id, true);
        $criteria->compare('date', $this->date, true);
        $criteria->compare('origin_country', $this->origin_country, true);
        $criteria->compare('destination_country', $this->destination_country, true);
        $criteria->compare('foreign_currency', $this->foreign_currency, true);
        $criteria->compare('currency_amount', $this->currency_amount, true);
        $criteria->compare('currency_price', $this->currency_price, true);
        $criteria->compare('total_amount', $this->total_amount, true);
        $criteria->compare('payment_method', $this->payment_method);
        $criteria->compare('payment_status', $this->payment_status);

        $criteria->order = 'id DESC';

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => false
        ));
    }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Transfer the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
