<?php
/* @var $this TransferManageController */
/* @var $model Transfer */

$this->breadcrumbs=array(
	'نمایش حواله'=>array('admin'),
	$model->code,
);
?>
<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title">نمایش حواله "<?php echo $model->code?>"</h3>
        <a href="<?php echo isset($_REQUEST['returnUrl'])?$_REQUEST['returnUrl']:$this->createUrl('admin')?>" class="pull-left btn btn-danger btn-sm">بازگشت</a>
	</div>
	<div class="box-body">
        <div class="row form-group">
            <div class="col-lg-12 text-left">
                <a target="_blank" href="<?php echo $this->createUrl('/transfer/manage/print',array('id' => $model->id, 'mode' => 'pos'))?>" class="btn btn-primary btn-sm">
                    <i class="fa fa-print"></i>
                    چاپ رسید
                </a>
                <a target="_blank" href="<?php echo $this->createUrl('/transfer/manage/print',array('id' => $model->id, 'mode' => 'A4'))?>" class="btn btn-default btn-sm">
                    <i class="fa fa-print"></i>
                    چاپ کامل حواله
                </a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <th><?php echo $model->branch->getAttributeLabel('title');?></th>
                        <td width="35%"><?php echo $model->branch->title; ?></td>
                        <th><?php echo $model->branch->getAttributeLabel('manager_name');?></th>
                        <td width="35%"><?php echo $model->branch->manager_name; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo $model->getAttributeLabel('date');?></th>
                        <td width="35%"><?php echo JalaliDate::date('H:i Y/m/d', $model->date); ?> - <?php echo date('H:i Y/m/d', $model->date); ?></td>
                        <th><?php echo $model->getAttributeLabel('modified_date');?></th>
                        <td width="35%"><?php echo $model->modified_date?JalaliDate::date('H:i Y/m/d', $model->modified_date).' - '.date('H:i Y/m/d', $model->modified_date):"--"; ?></td>
                    </tr>
                    <tr>
                        <th colspan="1"><?php echo $model->getAttributeLabel('payment_status');?></th>
                        <td colspan="1"><?php
                            if ($model->payment_method == Transfer::PAYMENT_METHOD_DEBTOR) {
                                if ($model->payment_status == Transfer::PAYMENT_STATUS_UNPAID)
                                    echo '<span class="label label-danger">' . Transfer::$paymentMethodLabels[$model->payment_method] . ' - ' . Transfer::$paymentStatusLabels[$model->payment_status] . '</span>';
                                else
                                    echo '<span class="label label-success">' . Transfer::$paymentMethodLabels[$model->payment_method] . ' - ' . Transfer::$paymentStatusLabels[$model->payment_status] . '</span>';
                            } else
                                echo '<span class="label label-success">' . Transfer::$paymentMethodLabels[$model->payment_method] . ' - ' . Transfer::$paymentStatusLabels[Transfer::PAYMENT_STATUS_PAID] . '</span>';
                            ?></td>
                        <td colspan="2"><?php
                            if ($model->payment_method == Transfer::PAYMENT_METHOD_DEBTOR && $model->payment_status == Transfer::PAYMENT_STATUS_UNPAID)
                                echo '<a class="btn btn-xs btn-success" href="'.$this->createUrl('/customers/manage/clearing?id='.$model->id.'&returnUrl='.urlencode(Yii::app()->request->requestUri)).'">
                                        <i class="fa fa-dollar"></i>
                                        تسویه بدهی
                                      </a>';
                            ?></td>
                    </tr>
                </tbody>
            </table>
            <br>
            <br>
            <h4>جزییات حواله</h4>
            <?php $this->widget('zii.widgets.CDetailView', array(
                'data'=>$model,
                'htmlOptions' => array(
                    'class' => 'table table-striped'
                ),
                'attributes'=>array(
                    'code',
                    'sender.name',
                    'receiver.name',
                    [
                        'name' => 'receiverAccount.account_number',
                        'value' => $model->receiverAccount?"<div><b>
                                        <div>{$model->receiverAccount->bank_name} - {$model->receiverAccount->account_number}</div>
                                        <small>(".CustomerAccounts::$numberTypeLabels[$model->receiverAccount->number_type].")</small>
                                    </b></div>":null,
                        'type' => 'raw'
                    ],
                    [
                        'name' => 'origin_country',
                        'value' => Transfer::$countryLabels[$model->origin_country]
                    ],
                    [
                        'name' => 'destination_country',
                        'value' => Transfer::$countryLabels[$model->destination_country],
                    ],
                    [
                        'name' => 'foreign_currency',
                        'value' => "<b>".Transfer::$foreignCurrencyLabels[$model->foreign_currency]."</b>",
                        'type' => 'raw'
                    ],
                    [
                        'name' => 'currency_price',
                        'value' => $model->currency_price?(strpos($model->currency_price, '.') !== false?number_format($model->currency_price, 2):number_format($model->currency_price)):"",
                    ],
                    [
                        'name' => 'currency_amount',
                        'value' => (($model->currency_amount?(strpos($model->currency_amount, '.') !== false?number_format($model->currency_amount, 2):number_format($model->currency_amount)):"").
                            " ".Transfer::$foreignCurrencyLabels[$model->foreign_currency]),
                    ],
                    [
                        'name' => 'total_amount',
                        'value' => (($model->total_amount?(strpos($model->total_amount, '.') !== false?number_format($model->total_amount, 2):number_format($model->total_amount)):"").
                            " ".Transfer::$foreignCurrencyLabels[$model->origin_currency]),
                    ]
                ),
            )); ?>
        </div>
	</div>
</div>