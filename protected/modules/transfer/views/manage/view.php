<?php
/* @var $this TransferManageController */
/* @var $model Transfer */

$this->breadcrumbs=array(
	'نمایش حواله'=>array('admin'),
	$model->code,
);
?>
<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title">نمایش حواله "<?php echo $model->code?>"</h3>
        <a href="<?php echo isset($_REQUEST['returnUrl'])?$_REQUEST['returnUrl']:$this->createUrl('admin')?>" class="pull-left btn btn-danger btn-sm">بازگشت</a>
	</div>
	<div class="box-body">
		<?php $this->widget('zii.widgets.CDetailView', array(
			'data'=>$model,
			'attributes'=>array(
				'code',

			),
		)); ?>
	</div>
</div>