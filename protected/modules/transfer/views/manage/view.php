<?php
/* @var $this CustomersManageController */
/* @var $model Customers */

$this->breadcrumbs=array(
	'مدیریت مشتریان'=>array('admin'),
	$model->name,
);
?>
<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title"><?php echo $model->name?></h3>
        <a href="<?php echo $this->createUrl('admin')?>" class="pull-left btn btn-danger btn-sm">بازگشت</a>
	</div>
	<div class="box-body">
		<?php $this->widget('zii.widgets.CDetailView', array(
			'data'=>$model,
			'attributes'=>array(
				'name',
				'code',
				'phone',
				'mobile',
				'country',
				'address',
				'email',
			),
		)); ?>
	</div>
</div>