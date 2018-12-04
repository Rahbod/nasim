<?php
/* @var $this TransferManageController */
/* @var $model Transfer */

$this->breadcrumbs=array(
    'حواله ها'=>array('admin'),
    'مدیریت حواله ها',
);

$dataProvider = $model->search();
/* @var $record Transfer */
$dollar = 0;
$rial = 0;
$dirham = 0;
foreach($dataProvider->getData() as $record) {
    if ($record->foreign_currency == 'AUD')
        $dollar += intval($record->currency_amount);
    elseif($record->foreign_currency == 'IRR')
        $rial += intval($record->currency_amount);
    elseif($record->foreign_currency == 'AED')
        $dirham += intval($record->currency_amount);
}
?>

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">مدیریت حواله ها</h3>
        <a href="<?php echo $this->createUrl('create')?>" class="pull-left btn btn-success btn-sm">افزودن حواله</a>
    </div>
    <div class="box-body">
        <?php $this->renderPartial("//partial-views/_flashMessage"); ?>
        <div class="alert alert-info">
            <span style="margin-left: 30px;font-weight: bold">مجموع حواله های امروز:</span>
            <span style="margin-left: 30px;"><?= number_format($dollar)?> دلار</span>
            <span style="margin-left: 30px;"><?= number_format($rial)?> ريال</span>
            <span style="margin-left: 30px;"><?= number_format($dirham)?> درهم</span>
        </div>
        <div class="table-responsive">
            <?php $this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'admins-grid',
                'dataProvider'=>$model->search(),
                'filter'=>$model,
                'itemsCssClass'=>'table table-striped table-hover',
                'columns'=>array(
                    'code',
                    'sender.name',
                    'receiver.name',
                    'currency_amount',
                    'total_amount',
                    array(
                        'class'=>'CButtonColumn',
                    )
                )
            )); ?>
        </div>
    </div>
</div>