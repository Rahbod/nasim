<?php
/* @var $this PagesManageController */
/* @var $model Pages */
/* @var $form CActiveForm */
?>
<? $this->renderPartial('//partial-views/_flashMessage'); ?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pages-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
    <?php if($this->categorySlug == 'index'):?>
	<div class="form-group">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255,'class' => 'form-control')); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>
    <? endif; ?>

    <div class="form-group">
        <?php echo $form->labelEx($model,'en_title'); ?>
        <?php echo $form->textField($model,'en_title',array('size'=>60,'maxlength'=>255,'class' => 'form-control')); ?>
        <?php echo $form->error($model,'en_title'); ?>
    </div>

    <?php if($this->categorySlug == 'index'):?>
    <div class="form-group">
        <?php echo $form->labelEx($model,'image'); ?>
        <?php $this->widget('ext.dropZoneUploader.dropZoneUploader', array(
            'id' => 'uploaderImage',
            'model' => $model,
            'name' => 'image',
            'maxFiles' => 1,
            'maxFileSize' => 1, //MB
            'url' => $this->createUrl('upload'),
            'deleteUrl' => $this->createUrl('deleteUpload'),
            'acceptedFiles' => '.jpg, .jpeg, .png',
            'serverFiles' => $model->image ? new UploadedFiles($this->imagePath, $model->image) : [],
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
        <?php echo $form->error($model,'image'); ?>
        <div class="uploader-message error"></div>
        <p><small>اندازه مناسب برای تصویر <?php echo $this->categorySlug == 'base'?"500 در 360":"1600 در 1024" ?> می باشد.</small></p>
    </div>
    <?php endif;?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'summary'); ?>
        <?
        $this->widget('ext.ckeditor.CKEditor', array(
            'model'=>$model,
            'attribute'=>'summary',
        ));
        ?>
		<?php echo $form->error($model,'summary'); ?>
	</div>

    <?php if($this->categorySlug != 'base'):?>
        <div class="form-group">
            <?php echo $form->labelEx($model,'formTags'); ?>
            <?php
            $this->widget("ext.tagIt.tagIt",array(
                'model' => $model,
                'attribute' => 'formTags',
                'suggestType' => 'json',
                'suggestUrl' => Yii::app()->createUrl('/tags/list'),
                'data' => $model->formTags
            ));
            ?>
            <?php echo $form->error($model,'formTags'); ?>
        </div>
    <?php endif;?>

	<div class="form-group buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'افزودن' : 'ویرایش',array('class' => 'btn btn-success')); ?>
	</div>

<?php $this->endWidget(); ?>