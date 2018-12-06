<?php
/* @var $this CustomersManageController */
/* @var $model CustomerAccounts */
/* @var $form CActiveForm */

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
        <?php $this->renderPartial('//partial-views/_flashMessage') ?>
        <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'customers-form',
            'enableAjaxValidation'=>false,
            'enableClientValidation'=>true,
            'clientOptions' => array(
                'validateOnSubmit' => true
            )
        )); ?>

        <div class="form-group">
            <?php echo $form->labelEx($model,'account_number'); ?>
            <?php echo $form->textField($model,'account_number',array('maxlength'=>255,'class'=>'form-control')); ?>
            <?php echo $form->error($model,'account_number'); ?>
        </div>
        <div class="form-group">
            <?php echo $form->labelEx($model,'number_type'); ?>
            <?php echo $form->dropDownList($model,'number_type', CustomerAccounts::$numberTypeLabels,array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'number_type'); ?>
        </div>
        <div class="form-group">
            <?php echo $form->labelEx($model,'bank_name'); ?>
            <?php echo $form->textField($model,'bank_name',array('maxlength'=>255,'class'=>'form-control')); ?>
            <?php echo $form->error($model,'bank_name'); ?>
        </div>

        <div class="form-group buttons">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'افزودن' : 'ویرایش', array('class'=>'btn btn-success save-customer')); ?>
        </div>

        <?php $this->endWidget(); ?>
	</div>
</div>