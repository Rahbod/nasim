<?php
/* @var $this TransferManageController */
/* @var $model Transfer */

$this->breadcrumbs=array(
    'حواله ها'=>array('admin'),
    'مدیریت حواله ها',
);
?>

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">مدیریت حواله ها</h3>
        <a href="<?php echo $this->createUrl('create')?>" class="pull-left btn btn-success btn-sm">افزودن حواله</a>
    </div>
    <div class="box-body">
        <?php $this->renderPartial("//partial-views/_flashMessage"); ?>
        <div class="table-responsive">
            <?php $this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'admins-grid',
                'dataProvider'=>$model->search(),
                'filter'=>$model,
                'itemsCssClass'=>'table table-striped table-hover',
                'columns'=>array(
                    'code',
                    'customer.name',
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