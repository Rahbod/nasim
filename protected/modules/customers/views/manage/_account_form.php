<?php
/* @var $this CustomersManageController */
/* @var $model CustomerAccounts */
/* @var $form CActiveForm */
?>
<?php $this->renderPartial('//partial-views/_flashMessage') ?>
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'account-customer-form',
    'action' => array('/customers/manage/addAccount'),
    'enableAjaxValidation'=>false,
    'enableClientValidation'=>true,
    'clientOptions' => array(
        'validateOnSubmit' => true
    )
));

if(!$model->customer_id)
    echo CHtml::hiddenField(CHtml::activeName($model, 'customer_id'),'');
?>

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
        <?php echo CHtml::submitButton($model->isNewRecord ? 'افزودن' : 'ویرایش', array('class'=>'btn btn-success save-customer-account')); ?>
    </div>

<?php $this->endWidget(); ?>