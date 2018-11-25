<?php
/* @var $this AdminsManageController */
/* @var $model Admins */

$this->breadcrumbs=array(
	'مدیریت شعب'=>array('admin'),
	'افزودن',
);
?>
<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title">افزودن شعبه</h3>
		<a href="<?php echo $this->createUrl('branches')?>" class="btn btn-danger pull-left btn-sm">بازگشت</a>
	</div>
	<div class="box-body">
		<?php $this->renderPartial('_form', array('model'=>$model, 'branch' => true)); ?>
	</div>
</div>