<?php

/**
 * This is the model class for table "{{transfer}}".
 *
 * The followings are the available columns in table '{{transfer}}':
 * @property string $id
 * @property string $code
 * @property string $sender_id
 * @property string $receiver_id
 * @property string $receiver_account_id
 * @property string $branch_id
 * @property string $date
 * @property string $modified_date
 * @property string $origin_country
 * @property string $destination_country
 * @property string $foreign_currency
 * @property string $currency_amount
 * @property string $currency_price
 * @property string $total_amount
 * @property string $payment_method
 * @property int $payment_status
 * @property string $origin_currency
 *
 * The followings are the available model relations:
 * @property Customers $sender
 * @property Customers $receiver
 * @property CustomerAccounts $receiverAccount
 * @property Admins $branch
 */
class Transfer extends CActiveRecord
{
    const PAYMENT_METHOD_CASH = 0;
    const PAYMENT_METHOD_DEBTOR = 1;

    const PAYMENT_STATUS_UNPAID = 0;
    const PAYMENT_STATUS_PAID = 1;

    const COUNTRY_IRAN = 'IRAN';
    const COUNTRY_AUSTRALIA = 'AUSTRALIA';
    const COUNTRY_EMIRATES = 'EMIRATES';

    const CURRENCY_IRR = 'IRR';
    const CURRENCY_AUD = 'AUD';
    const CURRENCY_AED = 'AED';

    public static $countryLabels = [
        self::COUNTRY_IRAN => 'ایران',
        self::COUNTRY_AUSTRALIA => 'استرالیا',
        self::COUNTRY_EMIRATES => 'امارات',
    ];

    public static $foreignCurrencyLabels = [
        self::CURRENCY_IRR => 'ریال ایران',
        self::CURRENCY_AUD => 'دلار استرالیا',
        self::CURRENCY_AED => 'درهم امارت',
    ];

    public static $foreignCurrencyEnLabels = [
        self::CURRENCY_IRR => 'Iranian rial',
        self::CURRENCY_AUD => 'Australian dollar',
        self::CURRENCY_AED => 'Emirati Dirham',
    ];

    public static $foreignCurrencyShortEnLabels = [
        self::CURRENCY_IRR => 'RIAL',
        self::CURRENCY_AUD => 'DOLLAR',
        self::CURRENCY_AED => 'DIRHAM',
    ];

    public static $paymentStatusLabels = [
        self::PAYMENT_STATUS_PAID => 'پرداخت شده',
        self::PAYMENT_STATUS_UNPAID => 'پرداخت نشده',
    ];
    public static $paymentMethodLabels = [
        self::PAYMENT_METHOD_CASH => 'نقدی',
        self::PAYMENT_METHOD_DEBTOR => 'علی الحساب',
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
            array('code, date, modified_date', 'length', 'max' => 20),
            array('sender_id, receiver_id, branch_id, receiver_account_id', 'length', 'max' => 10),
            array('payment_status, payment_method', 'length', 'max' => 1),
            array('payment_status', 'default', 'value' => self::PAYMENT_STATUS_UNPAID),
            array('payment_method', 'default', 'value' => self::PAYMENT_METHOD_CASH),
            array('origin_country, destination_country, foreign_currency, currency_amount, currency_price, total_amount', 'length', 'max' => 255),
            array('date', 'default', 'value' => time(), 'on' => 'create'),
            array('origin_country', 'compare', 'compareAttribute' => 'destination_country', 'operator' => '!=', 'message' => 'کشور مبدا و کشور مقصد نمی تواند یکسان باشد.'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, modified_date, payment_status, payment_method, code, sender_id, receiver_account_id, receiver_id, branch_id, date, origin_country, destination_country, foreign_currency, currency_amount, currency_price, total_amount', 'safe', 'on' => 'search'),
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
            'receiverAccount' => array(self::BELONGS_TO, 'CustomerAccounts', 'receiver_account_id'),
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
            'modified_date' => 'تاریخ تسویه',
            'origin_country' => 'کشور مبدا',
            'destination_country' => 'کشور مقصد',
            'foreign_currency' => 'ارز',
            'currency_amount' => 'مقدار ارز درخواستی',
            'currency_price' => 'نرخ ارز',
            'total_amount' => 'مقدار کل پرداخت مشتری',
            'payment_method' => 'نوع پرداخت',
            'payment_status' => 'وضعیت پرداخت',
            'receiver_account_id' => 'شماره حساب گیرنده',
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
    public function search($customerID = false, $mode = '')
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
        $criteria->compare('receiver_account_id', $this->receiver_account_id, true);

        if ($customerID && !empty($mode)) {

            if ($mode == 'debtor') {
                $criteria->compare('sender_id', $customerID);
                $criteria->compare('payment_method', self::PAYMENT_METHOD_DEBTOR);
                $criteria->compare('payment_status', self::PAYMENT_STATUS_UNPAID);
            } else
                $criteria->compare($mode == 'send' ? "sender_id" : 'receiver_id', $customerID);
        }

        $criteria->order = 'id DESC';

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => false
        ));
    }

    public function report($from = null, $to = null)
    {
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
        $criteria->compare('receiver_account_id', $this->receiver_account_id, true);

        $criteria->addCondition("payment_method = :cash OR (payment_method = :debtor AND payment_status = :paid)");
        $criteria->params[':cash'] = self::PAYMENT_METHOD_CASH;
        $criteria->params[':debtor'] = self::PAYMENT_METHOD_DEBTOR;
        $criteria->params[':paid'] = self::PAYMENT_STATUS_PAID;

        $criteria->addCondition("modified_date IS NOT NULL AND (modified_date >= :from AND modified_date <= :to)");

        $criteria->params[':from'] = $from;
        if (!$from)
            $criteria->params[':from'] = strtotime(date('Y/m/d 00:00:00'));
        $criteria->params[':to'] = $to;
        if (!$to)
            $criteria->params[':to'] = strtotime(date('Y/m/d 23:59:59'));
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
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    protected function beforeSave()
    {
        $this->currency_price = str_replace(',','',$this->currency_price);
        $this->currency_amount = str_replace(',','',$this->currency_amount);
        $this->total_amount = str_replace(',','',$this->total_amount);

        if ($this->payment_method == self::PAYMENT_METHOD_CASH) {
            $this->payment_status = self::PAYMENT_STATUS_PAID;
            $this->modified_date = time();
        }

        if (empty($this->currency_price)) {
            $dollarPrice = SiteSetting::getOption('dollar_price');
            $dirhamPrice = SiteSetting::getOption('dirham_price');
            $dollarPriceDirham = SiteSetting::getOption('dollar_price_dirham');
            if ($this->foreign_currency == Transfer::CURRENCY_AUD) {
                if ($this->origin_country == Transfer::COUNTRY_IRAN || $this->destination_country == Transfer::COUNTRY_IRAN)
                    $this->currency_price = $dollarPrice;
                else if ($this->origin_country == Transfer::COUNTRY_EMIRATES || $this->destination_country == Transfer::COUNTRY_EMIRATES)
                    $this->currency_price = $dollarPriceDirham;
            } elseif ($this->foreign_currency == Transfer::CURRENCY_IRR) {
                if ($this->origin_country == Transfer::COUNTRY_AUSTRALIA || $this->destination_country == Transfer::COUNTRY_AUSTRALIA)
                    $this->currency_price = (double)1 / $dollarPrice;
                else if ($this->origin_country == Transfer::COUNTRY_EMIRATES || $this->destination_country == Transfer::COUNTRY_EMIRATES)
                    $this->currency_price = (double)1 / $dirhamPrice;
            } elseif ($this->foreign_currency == Transfer::CURRENCY_AED) {
                if ($this->origin_country == Transfer::COUNTRY_IRAN || $this->destination_country == Transfer::COUNTRY_IRAN)
                    $this->currency_price = $dirhamPrice;
                else if ($this->origin_country == Transfer::COUNTRY_AUSTRALIA || $this->destination_country == Transfer::COUNTRY_AUSTRALIA)
                    $this->currency_price = (double)1 / $dollarPriceDirham;
            }
        }
        return parent::beforeSave(); // TODO: Change the autogenerated stub
    }

    /**
     * @param null $from
     * @param null $to
     * @param null $my
     * @return array
     */
    public static function CalculateStatistics($from = null, $to = null, $my = false)
    {
        $statistics = [
            'sell' => [
                'dollar' => 0,
                'rial' => 0,
                'dirham' => 0,
            ],
            'buy' => [
                'dollar' => 0,
                'rial' => 0,
                'dirham' => 0,
            ]
        ];

        $criteria = new CDbCriteria();

        if ($my)
            $criteria->compare("branch_id", Yii::app()->user->getId());

        $criteria->addCondition("payment_method = :cash OR (payment_method = :debtor AND payment_status = :paid)");
        $criteria->addCondition("modified_date IS NOT NULL AND (modified_date >= :from AND modified_date <= :to)");
        $criteria->params[':cash'] = self::PAYMENT_METHOD_CASH;
        $criteria->params[':debtor'] = self::PAYMENT_METHOD_DEBTOR;
        $criteria->params[':paid'] = self::PAYMENT_STATUS_PAID;

        $criteria->params[':from'] = $from;
        if (!$from)
            $criteria->params[':from'] = strtotime(date('Y/m/d 00:00:00'));
        $criteria->params[':to'] = $to;
        if (!$to)
            $criteria->params[':to'] = strtotime(date('Y/m/d 23:59:59'));

        $todayTransfers = Transfer::model()->findAll($criteria);
        foreach ($todayTransfers as $record) {
            if ($record->foreign_currency == Transfer::CURRENCY_AUD) {
                $statistics['sell']['dollar'] += intval($record->currency_amount);
                if ($record->origin_country == Transfer::COUNTRY_IRAN || $record->destination_country == Transfer::COUNTRY_IRAN)
                    $statistics['buy']['rial'] += intval($record->total_amount);
                else if ($record->origin_country == Transfer::COUNTRY_EMIRATES || $record->destination_country == Transfer::COUNTRY_EMIRATES)
                    $statistics['buy']['dirham'] += intval($record->total_amount);
            } elseif ($record->foreign_currency == Transfer::CURRENCY_IRR) {
                $statistics['sell']['rial'] += intval($record->currency_amount);
                if ($record->origin_country == Transfer::COUNTRY_AUSTRALIA || $record->destination_country == Transfer::COUNTRY_AUSTRALIA)
                    $statistics['buy']['dollar'] += intval($record->total_amount);
                else if ($record->origin_country == Transfer::COUNTRY_EMIRATES || $record->destination_country == Transfer::COUNTRY_EMIRATES)
                    $statistics['buy']['dirham'] += intval($record->total_amount);
            } elseif ($record->foreign_currency == Transfer::CURRENCY_AED) {
                $statistics['sell']['dirham'] += intval($record->currency_amount);
                if ($record->origin_country == Transfer::COUNTRY_IRAN || $record->destination_country == Transfer::COUNTRY_IRAN)
                    $statistics['buy']['rial'] += intval($record->total_amount);
                else if ($record->origin_country == Transfer::COUNTRY_AUSTRALIA || $record->destination_country == Transfer::COUNTRY_AUSTRALIA)
                    $statistics['buy']['dollar'] += intval($record->total_amount);
            }
        }
        return $statistics;
    }

    public function getOrigin_currency()
    {
        if ($this->foreign_currency == Transfer::CURRENCY_AUD) {
            if ($this->origin_country == Transfer::COUNTRY_IRAN || $this->destination_country == Transfer::COUNTRY_IRAN)
                return self::CURRENCY_IRR;
            else if ($this->origin_country == Transfer::COUNTRY_EMIRATES || $this->destination_country == Transfer::COUNTRY_EMIRATES)
                return self::CURRENCY_AED;
        } elseif ($this->foreign_currency == Transfer::CURRENCY_IRR) {
            if ($this->origin_country == Transfer::COUNTRY_AUSTRALIA || $this->destination_country == Transfer::COUNTRY_AUSTRALIA)
                return self::CURRENCY_AUD;
            else if ($this->origin_country == Transfer::COUNTRY_EMIRATES || $this->destination_country == Transfer::COUNTRY_EMIRATES)
                return self::CURRENCY_AED;
        } elseif ($this->foreign_currency == Transfer::CURRENCY_AED) {
            if ($this->origin_country == Transfer::COUNTRY_IRAN || $this->destination_country == Transfer::COUNTRY_IRAN)
                return self::CURRENCY_IRR;
            else if ($this->origin_country == Transfer::COUNTRY_AUSTRALIA || $this->destination_country == Transfer::COUNTRY_AUSTRALIA)
                return self::CURRENCY_AUD;
        }
        return null;
    }
}