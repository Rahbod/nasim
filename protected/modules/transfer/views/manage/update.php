<?php
/* @var $this CustomersManageController */
/* @var $model Customers */

$this->breadcrumbs=array(
    'مدیریت مشتریان'=> array('admin'),
	'ویرایش ' . $model->name,
);
?>
<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title">ویرایش <?= $model->name?></h3>
		<a href="<?php echo $this->createUrl('admin')?>" class="pull-left btn btn-danger btn-sm">بازگشت</a>
	</div>
	<div class="box-body">
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
</div>