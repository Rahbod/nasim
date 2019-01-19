<?php
/* @var $this TransferManageController */
/* @var $model Transfer */
/* @var $reports [] */
/* @var $from int */
/* @var $to int */
$this->breadcrumbs=array(
    'گزارشات'
);
?>

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">گزارشات مالی</h3>
    </div>
    <div class="box-body">

        <div class="well">
            <?php echo CHtml::beginForm(array('/transfer/manage/report'),'get', array('class' => 'form-inline')); ?>
            <div class="">
                <h5>نمایش گزارش:</h5>
            </div>
            <div class="row">
                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                    <?= CHtml::radioButton('date_type', !isset($_GET['date_type']) || (isset($_GET['date_type']) && $_GET['date_type'] == 'gregorian')?:false, ['value' => 'gregorian']); ?>
                    <?= CHtml::label('تاریخ میلادی', 'date_type') ?>
                </div>
                <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12 dis-box" id="gregorian-fields">
                    <div class="form-group">
                        <?= CHtml::label('از تاریخ', '') ?>
                        <div class="input-group">
                            <?php
                            $this->widget('ext.YiiDateTimePicker.jqueryDateTime', array(
                                'id' => 'g_from',
                                'name' =>'g_from',
                                'value' => isset($_GET['g_from'])?$_GET['g_from']:date("Y-m-d"),
                                'options' => array(
                                    'format'=>'Y-m-d',
                                    'timepicker' => false,
                                ),
                                'htmlOptions' => array(
                                    'class'=>'form-control',
                                    'autocomplete' => 'off'
                                ),
                            ));
                            ?>
                            <span class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <?= CHtml::label('تا تاریخ', '') ?>
                        <div class="input-group">
                            <?php
                            $this->widget('ext.YiiDateTimePicker.jqueryDateTime', array(
                                'id' => 'g_to',
                                'name' =>'g_to',
                                'value' => isset($_GET['g_to'])?$_GET['g_to']:date("Y-m-d"),
                                'options' => array(
                                    'format'=>'Y-m-d',
                                    'timepicker' => false,
                                ),
                                'htmlOptions' => array(
                                    'class'=>'form-control',
                                    'autocomplete' => 'off'
                                ),
                            ));
                            ?>
                            <span class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                    <?= CHtml::radioButton('date_type', isset($_GET['date_type']) && $_GET['date_type'] == 'jalali'?:false, ['value' => 'jalali']); ?>
                    <?= CHtml::label('تاریخ شمسی', 'date_type') ?>
                </div>
                <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12 dis-box" id="jalali-fields">
                    <div class="form-group">
                        <?= CHtml::label('از تاریخ', '') ?>
                        <div class="input-group">
                            <?php $this->widget('ext.PDatePicker.PDatePicker', array(
                                'id'=>'from',
                                'value' => isset($_GET['from_altField'])?$_GET['from_altField']:null,
                                'options'=>array(
                                    'format'=>'YYYY-MM-DD'
                                ),
                                'htmlOptions'=>array(
                                    'class'=>'form-control',
                                    'autocomplete' => 'off',
                                    'name' =>''
                                ),
                            ));?>
                            <span class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <?= CHtml::label('تا تاریخ', '') ?>
                        <div class="input-group">
                            <?php $this->widget('ext.PDatePicker.PDatePicker', array(
                                'id'=>'to',
                                'value' => isset($_GET['to_altField'])?$_GET['to_altField']:null,
                                'options'=>array(
                                    'format'=>'YYYY-MM-DD'
                                ),
                                'htmlOptions'=>array(
                                    'class'=>'form-control',
                                    'autocomplete' => 'off',
                                    'name' =>''
                                ),
                            ));?>
                            <span class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <?= CHtml::submitButton('نمایش', array('class' => 'btn btn-success btn-sm', 'name' =>'')) ?>
            </div>
            <?php echo CHtml::endForm() ?>
        </div>

        <?php $this->renderPartial("//partial-views/_flashMessage"); ?>

        <!--Statistics-->
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <span style="margin-left: 30px;font-weight: bold">مجموع حواله های فروش در این بازه:</span>
                <div class="alert alert-warning">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-center"><?= number_format($reports['sell']['dollar'])?> دلار</div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-center"><?= number_format($reports['sell']['rial'])?> ريال</div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-center"><?= number_format($reports['sell']['dirham'])?> درهم</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <span style="margin-left: 30px;font-weight: bold">مجموع حواله های خرید در این بازه:</span>
                <div class="alert alert-info">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-center"><?= number_format($reports['buy']['dollar'])?> دلار</div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-center"><?= number_format($reports['buy']['rial'])?> ريال</div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-center"><?= number_format($reports['buy']['dirham'])?> درهم</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <?php $this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'admins-grid',
                'dataProvider'=>$model->report($from, $to),
                'filter'=>$model,
                'itemsCssClass'=>'table table-striped table-hover',
                'columns'=>array(
                    'code',
                    'sender.name',
                    'receiver.name',
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
                            if (isset($_GET['date_type']) && $_GET['date_type'] == 'gregorian')
                                return date('Y/m/d H:i', $data->date);
                            return JalaliDate::date('Y/m/d H:i', $data->date);
                        },
                        'filter' => false
                    ],
                    [
                        'name' => 'modified_date',
                        'value' => function($data){
                            if (isset($_GET['date_type']) && $_GET['date_type'] == 'gregorian')
                                return date('Y/m/d H:i', $data->modified_date);
                            return JalaliDate::date('Y/m/d H:i', $data->modified_date);
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
                    array(
                        'class'=>'CButtonColumn',
                        'template' => '{view}',
                        'buttons' => array(
                            'view'=> array(
                                'url' => 'Yii::app()->createUrl("/transfer/manage/view",array("id" => $data->id, "returnUrl" => Yii::app()->request->requestUri))'
                            )
                        )
                    )
                )
            )); ?>
        </div>
    </div>
</div>

<script>
    $(function () {
        $(".dis-box#"+$('#date_type:checked').val()+"-fields").find(":input").each(function(){
            $(this).attr("disabled", false)
        });
        $(".dis-box").not("#"+$('#date_type:checked').val()+"-fields").find(":input").each(function(){
            $(this).val("").attr("disabled", true)
        });

        $("body").on("change", '#date_type', function () {
            var val = $(this).val();
            console.log(val);

            $(".dis-box#"+val+"-fields").find(":input").each(function(){
                $(this).val("").attr("disabled", false)
            });
            $(".dis-box").not("#"+val+"-fields").find(":input").each(function(){
                $(this).val("").attr("disabled", true)
            });
        })
    })
</script>