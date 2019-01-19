<?php
/* @var $this CustomersManageController */
/* @var $model Customers */
/* @var $sendTransfers Transfer */
/* @var $receiveTransfers Transfer */
/* @var $debtorTransfers Transfer */

$this->breadcrumbs=array(
	'مدیریت مشتریان'=>array('admin'),
	$model->name,
);
?>
<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title">مشتری: <?php echo $model->name?></h3>
        <a href="<?php echo $this->createUrl('admin')?>" class="pull-left btn btn-danger btn-sm">بازگشت</a>
	</div>
	<div class="box-body">
        <div class="table-responsive">
            <?php $this->widget('zii.widgets.CDetailView', array(
                'data'=>$model,
                'htmlOptions' => array('class' => 'table table-striped'),
                'attributes'=>array(
                    'name',
                    'code',
                    'phone',
                    'mobile',
                    'country',
                    'address',
                    'email',
                    [
                        'name' => 'id_number_type',
                        'value' => Customers::$idNumLabels[$model->id_number_type]
                    ],
                    'id_number',
                ),
            )); ?>
        </div>
    </div>
</div>
<div class="box box-danger">
    <div class="box-header with-border">
        <h3 class="box-title">بدهی های مشتری</h3>
    </div>
    <div class="box-body">
        <?php $this->renderPartial('//partial-views/_flashMessage')?>
        <div class="table-responsive">
            <?php $this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'debtor-grid',
                'dataProvider'=>$debtorTransfers->search($model->id, 'debtor'),
                'filter'=>$debtorTransfers,
                'itemsCssClass'=>'table table-striped table-hover',
                'columns'=>array(
                    'code',
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
                        'name' => 'foreign_currency',
                        'value' => function($data){
                            return Transfer::$foreignCurrencyLabels[$data->foreign_currency];
                        },
                        'filter' => Transfer::$foreignCurrencyLabels
                    ],
                    [
                        'name' => 'currency_amount',
                        'value' => function($data){
                            return $data->currency_amount?(strpos($data->currency_amount, '.') !== false?number_format($data->currency_amount, 2):number_format($data->currency_amount)):"";
                        },
                    ],
                    [
                        'name' => 'total_amount',
                        'value' => function($data){
                            return $data->total_amount?(strpos($data->total_amount, '.') !== false?number_format($data->total_amount, 2):number_format($data->total_amount)):"";
                        },
                    ],
                    [
                        'name' => 'date',
                        'value' => function($data){
                            return JalaliDate::date('Y/m/d H:i', $data->date);
                        },
                        'filter' => false
                    ],
                    [
                        'name' => 'modified_date',
                        'value' => function($data){
                            return $data->modified_date?JalaliDate::date('Y/m/d H:i', $data->modified_date):"-";
                        },
                        'filter' => false
                    ],
                    [
                        'value' => function($data){
                            $route = urlencode(Yii::app()->request->requestUri);
                            return CHtml::link('تسویه بدهی',array('/customers/manage/clearing?id='.$data->id.'&returnUrl='.$route),array('class' => 'btn btn-xs btn-success'));
                        },
                        'type' => 'raw',
                        'filter' => false
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
<div class="box box-warning">
    <div class="box-header with-border">
        <h3 class="box-title">حواله های ارسالی مشتری</h3>
    </div>
    <div class="box-body">
        <div class="table-responsive">
            <?php $this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'send-grid',
                'dataProvider'=>$sendTransfers->search($model->id, 'send'),
                'filter'=>$sendTransfers,
                'itemsCssClass'=>'table table-striped table-hover',
                'columns'=>array(
                    'code',
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
                        'name' => 'foreign_currency',
                        'value' => function($data){
                            return Transfer::$foreignCurrencyLabels[$data->foreign_currency];
                        },
                        'filter' => Transfer::$foreignCurrencyLabels
                    ],
                    [
                        'name' => 'currency_amount',
                        'value' => function($data){
                            return $data->currency_amount?(strpos($data->currency_amount, '.') !== false?number_format($data->currency_amount, 2):number_format($data->currency_amount)):"";
                        },
                    ],
                    [
                        'name' => 'total_amount',
                        'value' => function($data){
                            return $data->total_amount?(strpos($data->total_amount, '.') !== false?number_format($data->total_amount, 2):number_format($data->total_amount)):"";
                        },
                    ],
                    [
                        'name' => 'date',
                        'value' => function($data){
                            return JalaliDate::date('Y/m/d H:i', $data->date);
                        },
                        'filter' => false
                    ],
                    [
                        'name' => 'modified_date',
                        'value' => function($data){
                            return $data->modified_date?JalaliDate::date('Y/m/d H:i', $data->modified_date):"-";
                        },
                        'filter' => false
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
<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">حواله های دریافتی مشتری</h3>
    </div>
    <div class="box-body">
        <div class="table-responsive">
            <?php $this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'receive-grid',
                'dataProvider'=>$receiveTransfers->search($model->id, 'receive'),
                'filter'=>$receiveTransfers,
                'itemsCssClass'=>'table table-striped table-hover',
                'columns'=>array(
                    'code',
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
                        'name' => 'foreign_currency',
                        'value' => function($data){
                            return Transfer::$foreignCurrencyLabels[$data->foreign_currency];
                        },
                        'filter' => Transfer::$foreignCurrencyLabels
                    ],
                    [
                        'name' => 'currency_amount',
                        'value' => function($data){
                            return $data->currency_amount?(strpos($data->currency_amount, '.') !== false?number_format($data->currency_amount, 2):number_format($data->currency_amount)):"";
                        },
                    ],
                    [
                        'name' => 'total_amount',
                        'value' => function($data){
                            return $data->total_amount?(strpos($data->total_amount, '.') !== false?number_format($data->total_amount, 2):number_format($data->total_amount)):"";
                        },
                    ],
                    [
                        'name' => 'date',
                        'value' => function($data){
                            return JalaliDate::date('Y/m/d H:i', $data->date);
                        },
                        'filter' => false
                    ],
                    [
                        'name' => 'modified_date',
                        'value' => function($data){
                            return $data->modified_date?JalaliDate::date('Y/m/d H:i', $data->modified_date):"-";
                        },
                        'filter' => false
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