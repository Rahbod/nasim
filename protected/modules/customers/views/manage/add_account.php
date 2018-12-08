<?php
/* @var $this CustomersManageController */
/* @var $model CustomerAccounts */

$this->breadcrumbs=array(
    'مدیریت مشتریان'=> array('admin'),
	'افزودن',
);

$customer = $model->customer;
?>
<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title">افزودن شماره حساب برای "<?= $customer->name ?>"</h3>
		<a href="<?php echo $this->createUrl('admin')?>" class="pull-left btn btn-danger btn-sm">بازگشت</a>
	</div>
	<div class="box-body">
        <?php $this->renderPartial('_account_form', compact('model')) ?>
	</div>
</div>