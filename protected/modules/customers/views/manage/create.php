<?php
/* @var $this AdminsManageController */
/* @var $model Admins */

$this->breadcrumbs=array(
    'مدیریت مشتریان'=> array('admin'),
	'افزودن',
);
?>
<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title">افزودن مشتری</h3>
		<a href="<?php echo $this->createUrl('admin')?>" class="pull-left btn btn-danger btn-sm">بازگشت</a>
	</div>
	<div class="box-body">
		<?php $this->renderPartial('_form', array('model'=>$model,'accModel'=>$accModel)); ?>
	</div>
</div>