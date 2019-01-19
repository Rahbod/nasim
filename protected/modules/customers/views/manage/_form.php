<?php
/* @var $this CustomersManageController */
/* @var $model Customers */
/* @var $accModel CustomerAccounts */
/* @var $form CActiveForm */
/* @var $mainFields boolean */

Yii::app()->clientScript->registerScript('resetForm','document.getElementById("customers-form").reset();');
?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'customers-form',
	'enableAjaxValidation'=>true,
	'enableClientValidation'=>true,
    'clientOptions' => array(
            'validateOnSubmit' => true
    )
)); ?>
    <div class="message"></div>

    <div class="form-group">
        <?php echo $form->labelEx($model,'name'); ?>
        <?php echo $form->textField($model,'name',array('maxlength'=>255,'class'=>'form-control')); ?>
        <?php echo $form->error($model,'name'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model,'phone'); ?>
        <?php echo $form->textField($model,'phone',array('maxlength'=>13,'class'=>'form-control')); ?>
        <?php echo $form->error($model,'phone'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model,'mobile'); ?>
        <?php echo $form->textField($model,'mobile',array('maxlength'=>13,'class'=>'form-control')); ?>
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


    <div class="form-group">
        <?php echo $form->labelEx($model,'id_number_type'); ?>
        <?php echo $form->dropDownList($model,'id_number_type',Customers::$idNumLabels, array('class'=>'form-control')); ?>
        <?php echo $form->error($model,'id_number_type'); ?>
    </div>
    <div class="form-group">
        <?php echo $form->labelEx($model,'id_number'); ?>
        <?php echo $form->textField($model,'id_number',array('maxlength'=>50,'class'=>'form-control')); ?>
        <?php echo $form->error($model,'id_number'); ?>
    </div>


    <?php if(!isset($onlyMainFields)):?>
        <div class="form-group">
            <?php echo $form->labelEx($model,'email'); ?>
            <?php echo $form->emailField($model,'email',array('maxlength'=>255,'class'=>'form-control')); ?>
            <?php echo $form->error($model,'email'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'attachment'); ?>
            <?php $this->widget('ext.dropZoneUploader.dropZoneUploader', array(
            'id' => 'uploaderAttachment',
            'model' => $model,
            'name' => 'attachment',
            'maxFiles' => 1,
            'maxFileSize' => 10, //MB
            'url' => $this->createUrl('upload'),
            'deleteUrl' => $this->createUrl('deleteUpload'),
            'acceptedFiles' => '.jpg, .jpeg, .png, .pdf, .doc, .docx, .zip',
            'serverFiles' => $model->attachment ? new UploadedFiles($this->attachmentPath, $model->attachment) : [],
            'onSuccess' => '
                var responseObj = JSON.parse(res);
                if(responseObj.status){
                    {serverName} = responseObj.fileName;
                    $(".uploader-message").html("");
                }
                else{
                    $(".uploader-message").html(responseObj.message);
                    this.removeFile(file);
                }
            ',
        )); ?>
            <?php echo $form->error($model,'attachment'); ?>
            <div class="uploader-message error"></div>
        </div>
    <?php else:?>
        <input type="hidden" name="ajax" value="1">
    <?php endif;?>

<!--    Add Account Number-->
    <?php if($model->isNewRecord):?>
        <hr>
        <h4><i class="fa fa-chevron-left"></i>اطلاعات حساب مشتری</h4>
        <div class="form-group">
            <?php echo $form->labelEx($accModel,'account_number'); ?>
            <?php echo $form->textField($accModel,'account_number',array('maxlength'=>255,'class'=>'form-control')); ?>
            <?php echo $form->error($accModel,'account_number'); ?>
        </div>
        <div class="form-group">
            <?php echo $form->labelEx($accModel,'number_type'); ?>
            <?php echo $form->dropDownList($accModel,'number_type', CustomerAccounts::$numberTypeLabels,array('class'=>'form-control')); ?>
            <?php echo $form->error($accModel,'number_type'); ?>
        </div>
        <div class="form-group">
            <?php echo $form->labelEx($accModel,'bank_name'); ?>
            <?php echo $form->textField($accModel,'bank_name',array('maxlength'=>255,'class'=>'form-control')); ?>
            <?php echo $form->error($accModel,'bank_name'); ?>
        </div>
        <hr>
    <?php endif; ?>

	<div class="form-group buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'افزودن' : 'ویرایش', array('class'=>'btn btn-success save-customer')); ?>
	</div>

<?php $this->endWidget(); ?>