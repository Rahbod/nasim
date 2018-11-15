<?php
/* @var $this SettingManageController */
/* @var $model SiteSetting */
?>
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">تنظیمات عمومی</h3>
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

    <?php
    foreach($model as $field):
        if($field->name != 'social_links'&& $field->name != 'price' && $field->name != 'foreign_price'):
            if($field->name == 'keywords'):?>
                <div class="form-group">
                    <?php echo CHtml::label($field->title,''); ?>
                    <?
                    $this->widget("ext.tagIt.tagIt",array(
                        'name' => "SiteSetting[$field->name]",
                        'data' => (!empty($field->value))?CJSON::decode($field->value):''
                    ));
                    ?>
                    <p style="clear: both;font-size: 12px;color: #aaa">عبارت را وارد کرده و اینتر بزنید.</p>
                    <?php echo $form->error($field,'name'); ?>
                </div>
            <?php elseif($field->name == 'banner'):?>
                <div class="form-group">
                    <?php echo CHtml::label($field->title,''); ?><br>
                    <?php $this->widget('ext.dropZoneUploader.dropZoneUploader', array(
                        'id' => 'uploaderBanner',
                        'model' => $field,
                        'name' => 'banner',
                        'maxFiles' => 1,
                        'maxFileSize' => 0.5, //MB
                        'url' => $this->createUrl('upload'),
                        'deleteUrl' => $this->createUrl('deleteUpload'),
                        'acceptedFiles' => '.jpg, .jpeg, .png',
                        'serverFiles' => $field->value ? new UploadedFiles('uploads/banner', $field->value) : [],
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
                    <p><small>اندازه مناسب 1600 در 1024 می باشد.</small></p>
                </div>
            <?php elseif($field->name == 'map_pic'):?>
                <div class="form-group">
                    <?php echo CHtml::label($field->title,''); ?><br>
                    <?php $this->widget('ext.dropZoneUploader.dropZoneUploader', array(
                        'id' => 'uploaderMap',
                        'model' => $field,
                        'name' => 'map_pic',
                        'maxFiles' => 1,
                        'maxFileSize' => 0.5, //MB
                        'url' => $this->createUrl('uploadMap'),
                        'deleteUrl' => $this->createUrl('deleteMap'),
                        'acceptedFiles' => '.jpg, .jpeg, .png',
                        'serverFiles' => $field->value ? new UploadedFiles('uploads/map', $field->value) : [],
                        'onSuccess' => '
                                var responseObj = JSON.parse(res);
                                if(responseObj.status){
                                    {serverName} = responseObj.fileName;
                                    $(".uploader-map-message").html("");
                                }
                                else{
                                    $(".uploader-map-message").html(responseObj.message);
                                    this.removeFile(file);
                                }
                            ',
                    )); ?>
                    <div class="uploader-map-message error"></div>
                    <p><small>اندازه مناسب 900 در 380 می باشد.</small></p>
                </div>
            <?php else:?>
                <div class="form-group">
                    <?php echo CHtml::label($field->title,''); ?>
                    <?php echo CHtml::textField("SiteSetting[$field->name]",$field->value,array('size'=>60,'class'=>'form-control text-right', 'dir' => 'auto')); ?>
                    <?php echo $form->error($field,'name'); ?>
                </div>
            <?php
            endif;
        endif;
    endforeach;
    ?>
    <div class="form-group buttons">
        <?php echo CHtml::submitButton('ذخیره',array('class' => 'btn btn-success')); ?>
    </div>
    <?
    $this->endWidget();
    ?>
    </div>
</div>