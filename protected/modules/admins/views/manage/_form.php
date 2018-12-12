<?php
/* @var $this AdminsManageController */
/* @var $model Admins */
/* @var $form CActiveForm */
/* @var $branch boolean */
Yii::app()->clientScript->registerScript('resetForm','document.getElementById("admins-form").reset();');
$branch = isset($branch);
?>
<?php $this->renderPartial('//partial-views/_flashMessage')?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'admins-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
	'clientOptions'=>array(
        'validateOnSubmit'=>true,
    ),

)); ?>
    <div class="message"></div>
    <h4>
        <i class="fa fa-chevron-left"></i>
        اطلاعات شعبه</h4>
	<div class="form-group">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>50,'maxlength'=>255 , 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>
    <div class="form-group">
        <?php echo $form->labelEx($model,'manager_name'); ?>
        <?php echo $form->textField($model,'manager_name',array('size'=>50,'maxlength'=>255 , 'class'=>'form-control')); ?>
        <?php echo $form->error($model,'manager_name'); ?>
    </div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'phone'); ?>
		<?php echo $form->telField($model,'phone',array('size'=>50,'maxlength'=>255 , 'class'=>'form-control ltr text-right')); ?>
		<?php echo $form->error($model,'phone'); ?>
	</div>

    <div class="form-group">
        <?php echo $form->labelEx($model,'address'); ?>
        <?php echo $form->textField($model,'address',array('size'=>50,'maxlength'=>1023 , 'class'=>'form-control', 'dir' => 'auto')); ?>
        <?php echo $form->error($model,'address'); ?>
    </div>
	<hr>
    <h4>
        <i class="fa fa-chevron-left"></i>
        اطلاعات کاربری</h4>
	<div class="form-group">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>50,'maxlength'=>100 , 'class'=>'form-control', (!$model->isNewRecord?'disabled':'s') => true)); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>
    <?php if($model->isNewRecord): ?>
        <div class="form-group">
            <?php echo $form->labelEx($model,'password'); ?>
            <?php echo $form->passwordField($model,'password',array('size'=>50,'maxlength'=>100,'class'=>'form-control')); ?>
            <?php echo $form->error($model,'password'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'repeatPassword'); ?>
            <?php echo $form->passwordField($model,'repeatPassword',array('size'=>50,'maxlength'=>100,'class'=>'form-control')); ?>
            <?php echo $form->error($model,'repeatPassword'); ?>
        </div>
    <?php endif; ?>

    <div class="form-group">
        <?php echo $form->labelEx($model,'email'); ?>
        <?php echo $form->emailField($model,'email',array('size'=>50,'maxlength'=>255,'class'=>'form-control')); ?>
        <?php echo $form->error($model,'email'); ?>
    </div>

    <?php if(!$branch):?>
    <div class="form-group">
        <?php echo $form->labelEx($model,'role_id'); ?>
        <?php echo $form->dropDownList($model,'role_id' ,CHtml::listData(  AdminRoles::model()->findAll('role <> "superAdmin"') , 'id' , 'name'),array('class'=>'form-control')); ?>
        <?php echo $form->error($model,'role_id'); ?>
    </div>
    <?php else:?>
        <?php echo $form->hiddenField($model,'role_id' ,array('value'=>'4')); ?>
    <?php endif;?>

	<div class="form-group buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'افزودن' : 'ویرایش', array('class'=>'btn btn-success')); ?>
	</div>

<?php $this->endWidget(); ?>