<?php
/* @var $this TransferManageController */
/* @var $model Transfer */
/* @var $statistics [] */

$this->breadcrumbs=array(
    'حواله ها'=>array('admin'),
    'مدیریت حواله ها',
);

$dataProvider = $model->search();
?>

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">مدیریت حواله ها</h3>
        <a href="<?php echo $this->createUrl('create')?>" class="pull-left btn btn-success btn-sm">افزودن حواله</a>
    </div>
    <div class="box-body">
        <?php $this->renderPartial("//partial-views/_flashMessage"); ?>

        <!--Statistics-->
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <span style="margin-left: 30px;font-weight: bold">مجموع حواله های فروش امروز<?= isset($my)?' شعبه من':''?>:</span>
                <div class="alert alert-warning">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-center"><?= number_format($statistics['sell']['dollar'])?> دلار</div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-center"><?= number_format($statistics['sell']['rial'])?> ريال</div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-center"><?= number_format($statistics['sell']['dirham'])?> درهم</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <span style="margin-left: 30px;font-weight: bold">مجموع حواله های خرید امروز<?= isset($my)?' شعبه من':''?>:</span>
                <div class="alert alert-info">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-center"><?= number_format($statistics['buy']['dollar'])?> دلار</div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-center"><?= number_format($statistics['buy']['rial'])?> ريال</div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-center"><?= number_format($statistics['buy']['dirham'])?> درهم</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <?php $this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'admins-grid',
                'dataProvider'=>$model->search(),
                'filter'=>$model,
                'itemsCssClass'=>'table table-striped table-hover',
                'columns'=>array(
                    'code',
                    'branch.title',
                    'sender.name',
                    'receiver.name',
                    [
                        'name' => 'origin_country',
                        'value' => function($data){
                            return Transfer::$countryLabels[$data->origin_country];
                        },
                        'filter' => Transfer::$countryLabels
                    ],
                    [
                        'name' => 'destination_country',
                        'value' => function($data){
                            return Transfer::$countryLabels[$data->destination_country];
                        },
                        'filter' => Transfer::$countryLabels
                    ],
                    [
                        'name' => 'currency_price',
                        'value' => function($data){
                            /* @var $data Transfer */
                            return (($data->currency_price?(strpos($data->currency_price, '.') !== false?number_format($data->currency_price, 2):number_format($data->currency_price)):"").
                                " ".Transfer::$foreignCurrencyLabels[$data->origin_currency]);
                        },
                    ],
                    [
                        'name' => 'currency_amount',
                        'value' => function($data){
                            /* @var $data Transfer */
                            return (($data->currency_amount?(strpos($data->currency_amount, '.') !== false?number_format($data->currency_amount, 2):number_format($data->currency_amount)):"").
                                " ".Transfer::$foreignCurrencyLabels[$data->foreign_currency]);
                        },
                    ],
                    [
                        'name' => 'total_amount',
                        'value' => function($data){
                            /* @var $data Transfer */
                            return (($data->total_amount?(strpos($data->total_amount, '.') !== false?number_format($data->total_amount, 2):number_format($data->total_amount)):"").
                                " ".Transfer::$foreignCurrencyLabels[$data->origin_currency]);
                        },
                    ],
                    [
                        'name' => 'date',
                        'value' => function($data){
                            return $data->date?JalaliDate::date('Y/m/d H:i', $data->date):'';
                        },
                        'filter' => false
                    ],
                    [
                        'name' => 'modified_date',
                        'value' => function($data){
                            return $data->modified_date?JalaliDate::date('Y/m/d H:i', $data->modified_date):'';
                        },
                        'filter' => false
                    ],
                    [
                        'name' => 'payment_method',
                        'header' => $model->getAttributeLabel('payment_status'),
                        'value' => function($data) {
                            if ($data->payment_method == Transfer::PAYMENT_METHOD_DEBTOR) {
                                if ($data->payment_status == Transfer::PAYMENT_STATUS_UNPAID)
                                    return '<span class="label label-danger">' . Transfer::$paymentMethodLabels[$data->payment_method] . ' - ' . Transfer::$paymentStatusLabels[$data->payment_status] . '</span>';
                                else
                                    return '<span class="label label-success">' . Transfer::$paymentMethodLabels[$data->payment_method] . ' - ' . Transfer::$paymentStatusLabels[$data->payment_status] . '</span>';
                            } else
                                return '<span class="label label-success">' . Transfer::$paymentMethodLabels[$data->payment_method] . ' - ' . Transfer::$paymentStatusLabels[Transfer::PAYMENT_STATUS_PAID] . '</span>';

                        },
                        'type' => 'raw',
                        'filter' => Transfer::$paymentMethodLabels
                    ],
                    [
                        'value' => function($data){
                            if ($data->payment_method == Transfer::PAYMENT_METHOD_DEBTOR && $data->payment_status == Transfer::PAYMENT_STATUS_UNPAID)
                                return CHtml::link('تسویه بدهی',array('/customers/manage/clearing?id='.$data->id),array('class' => 'btn btn-xs btn-success'));
                            return '';
                        },
                        'type' => 'raw',
                        'filter' => false
                    ],
                    array(
                        'class'=>'CButtonColumn',
                        'buttons' => array(
                            'delete' =>array(
                                'visible' => '$data->branch_id == Yii::app()->user->getId()'
                            ),
                            'update' =>array(
                                'visible' => '$data->branch_id == Yii::app()->user->getId()'
                            )
                        )
                    )
                )
            )); ?>
        </div>
    </div>
</div>