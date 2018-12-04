<?php
/* @var $this CustomersManageController */
/* @var $model Customers */
/* @var $form CActiveForm */
/* @var $mainFields boolean */
Yii::app()->clientScript->registerScript('resetForm','document.getElementById("customers-form").reset();');
?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'customers-form',
	'enableAjaxValidation'=>true,

)); ?>
    <div class="message"></div>

    <div class="form-group">
        <?php echo $form->labelEx($model,'name'); ?>
        <?php echo $form->textField($model,'name',array('maxlength'=>255,'class'=>'form-control')); ?>
        <?php echo $form->error($model,'name'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model,'phone'); ?>
        <?php echo $form->textField($model,'phone',array('maxlength'=>20,'class'=>'form-control')); ?>
        <?php echo $form->error($model,'phone'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model,'mobile'); ?>
        <?php echo $form->textField($model,'mobile',array('maxlength'=>20,'class'=>'form-control')); ?>
        <?php echo $form->error($model,'mobile'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model,'country'); ?>
        <?php echo $form->textField($model,'country',array('maxlength'=>20,'class'=>'form-control')); ?>
        <?php echo $form->error($model,'country'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model,'address'); ?>
        <?php echo $form->textField($model,'address',array('maxlength'=>1024,'class'=>'form-control')); ?>
        <?php echo $form->error($model,'address'); ?>
    </div>

    <?php if(!isset($onlyMainFields)):?>
        <div class="form-group">
            <?php echo $form->labelEx($model,'email'); ?>
            <?php echo $form->emailField($model,'email',array('maxlength'=>255,'class'=>'form-control')); ?>
            <?php echo $form->error($model,'email'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'id_number'); ?>
            <?php echo $form->textField($model,'id_number',array('maxlength'=>50,'class'=>'form-control')); ?>
            <?php echo $form->error($model,'id_number'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'id_number_type'); ?>
            <?php echo $form->dropDownList($model,'id_number_type',Customers::$idNumLabels, array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'id_number_type'); ?>
        </div>
    <?php else:?>
        <input type="hidden" name="ajax" value="1">
    <?php endif;?>

	<div class="form-group buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'افزودن' : 'ویرایش', array('class'=>'btn btn-success save-customer')); ?>
	</div>

<?php $this->endWidget(); ?>