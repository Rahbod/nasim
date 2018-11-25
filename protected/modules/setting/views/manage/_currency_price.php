<?php
/* @var $this SettingManageController */
/* @var $field SiteSetting */
?>
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">تنظیم نرخ ارز</h3>
    </div>
    <div class="box-body">
    <?
    $form = $this->beginWidget('CActiveForm',array(
        'id'=> 'general-setting',
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
    ));
    ?>

    <?php $this->renderPartial('//partial-views/_flashMessage') ?>

    <?php $field = SiteSetting::getOption('dollar_price', false);?>
    <div class="form-group">
        <?php echo CHtml::label($field->title.' <small>(به ریال)</small>',''); ?>
        <?php echo CHtml::textField("SiteSetting[$field->name]",$field->value,array('size'=>60,'class'=>'form-control')); ?>
        <?php echo $form->error($field,'name'); ?>
    </div>

    <?php $field = SiteSetting::getOption('dirham_price', false);?>
    <div class="form-group">
        <?php echo CHtml::label($field->title.' <small>(به ریال)</small>',''); ?>
        <?php echo CHtml::textField("SiteSetting[$field->name]",$field->value,array('size'=>60,'class'=>'form-control')); ?>
        <?php echo $form->error($field,'name'); ?>
    </div>

    <?php $field = SiteSetting::getOption('dollar_price_dirham', false);?>
    <div class="form-group">
        <?php echo CHtml::label($field->title.' <small>(به درهم)</small>',''); ?>
        <?php echo CHtml::textField("SiteSetting[$field->name]",$field->value,array('size'=>60,'class'=>'form-control')); ?>
        <?php echo $form->error($field,'name'); ?>
    </div>

    <div class="form-group buttons">
        <?php echo CHtml::submitButton('ذخیره',array('class' => 'btn btn-success')); ?>
    </div>
    <?
    $this->endWidget();
    ?>
    </div>
</div>