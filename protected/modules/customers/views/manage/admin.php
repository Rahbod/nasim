<?php
/* @var $this CustomersManageController */
/* @var $model Customers */

$this->breadcrumbs=array(
    'مشتریان'=>array('admin'),
    'مدیریت مشتریان',
);
?>

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">مدیریت مشتریان</h3>
        <a href="<?php echo $this->createUrl('create')?>" class="pull-left btn btn-success btn-sm">افزودن مشتری</a>
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
                    'name',
                    array(
                        'class'=>'CButtonColumn',
                    )
                )
            )); ?>
        </div>
    </div>
</div>