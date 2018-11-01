<?php
/* @var $this SettingManageController */
/* @var $model SiteSetting */
?>
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">فرم های حواله</h3>
    </div>
    <div class="box-body">
    <?
    $form = $this->beginWidget('CActiveForm',array(
        'id'=> 'forms-setting',
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
    ));
    ?>

    <?php $this->renderPartial('//partial-views/_flashMessage') ?>

    <?php foreach($model as $field):?>
        <div class="form-group">
            <?php echo CHtml::label($field->title,''); ?><br>
            <?php $this->widget('ext.dropZoneUploader.dropZoneUploader', array(
                'id' => 'uploader-'.$field->name,
                'model' => $field,
                'name' => $field->name,
                'maxFiles' => 1,
                'maxFileSize' => 1, //MB
                'url' => $this->createUrl($field->name == 'form_pdf'?'uploadPdf':'uploadWord'),
                'deleteUrl' => $this->createUrl('deleteForm'),
                'acceptedFiles' => $field->name == 'form_pdf'?'.pdf':'.doc, .docx',
                'serverFiles' => $field->value ? new UploadedFiles($this->formPath, $field->value) : [],
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
            <div class="uploader-message error"></div>
        </div>
    <?php endforeach; ?>
    <div class="form-group buttons">
        <?php echo CHtml::submitButton('ذخیره',array('class' => 'btn btn-success')); ?>
    </div>
    <?
    $this->endWidget();
    ?>
    </div>
</div>