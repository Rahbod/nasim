<?php
/* @var $this AdminsManageController */
/* @var $model Admins */
/* @var $form CActiveForm */
?>

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">تغییر کلمه عبور</h3>
        </div>
        <div class="box-body">
            <?= $this->renderPartial('//partial-views/_flashMessage')?>
            <?php $form=$this->beginWidget('CActiveForm', array(
                'id'=>'admins-form',
                'enableAjaxValidation'=>false,
            )); ?>

            <?php echo $form->errorSummary($model) ?>

            <div class="form-group">
                <?php echo $form->labelEx($model,'oldPassword'); ?>
                <?php echo $form->passwordField($model,'oldPassword',array('size'=>50,'maxlength'=>100,'class'=>'form-control')); ?>
                <?php echo $form->error($model,'oldPassword'); ?>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model,'newPassword'); ?>
                <?php echo $form->passwordField($model,'newPassword',array('size'=>50,'maxlength'=>100,'class'=>'form-control')); ?>
                <?php echo $form->error($model,'newPassword'); ?>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model,'repeatPassword'); ?>
                <?php echo $form->passwordField($model,'repeatPassword',array('size'=>50,'maxlength'=>100,'class'=>'form-control')); ?>
                <?php echo $form->error($model,'repeatPassword'); ?>
            </div>

            <div class="form-group buttons">
                <?php echo CHtml::submitButton('ذخیره', array('class'=>'btn btn-success')); ?>
            </div>

            <?php $this->endWidget(); ?>
        </div>
    </div>