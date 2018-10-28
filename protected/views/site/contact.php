<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $page Pages */
/* @var $form CActiveForm */

$this->pageTitle="تماس با ما";
$this->pageHeader="تماس با ما";
$this->breadcrumbs=array(
	'تماس با ما',
);

?>
<section class="page-content">
    <div class="container">
        <div class="contact-box">
            <h3><?= $page->title ?></h3><br>
            <div class="page-text" dir="auto"><?php
                $purifier=new CHtmlPurifier();
                echo $purifier->purify($page->summary);
                ?></div><br>
            <div class="contact-icon-outer hidden-xs">
                <div class="contact-icon"></div>
            </div>
            <?php $this->renderPartial('//partial-views/_flashMessage') ?>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <p>                        در صورتی که مایل به تماس با دفتر ترجمه رسمی افرا هستید، می توانید از طریق فرم زیر بخش مورد نظر خود را انتخاب و موضوع خود را مطرح کنید. همچنین می توانید با شماره تماس های درج شده نیز تماس حاصل فرمایید.</p>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <?php $this->renderPartial('//partial-views/_socials') ?>
                </div>
            </div>
            <?php $map = Yii::app()->getBaseUrl(true).'/uploads/map/'.SiteSetting::getOption("map_pic"); ?>
            <div id="contact-google-map"><a target="_blank" href="<?= SiteSetting::getOption('map_link') ?>"><div class="about-map-pic" style="background-image: url('<?= $map ?>')"></div></a></div>
            <?php $form=$this->beginWidget('CActiveForm', array(
                'id'=>'contact-form',
                'htmlOptions' => array('class' => 'contact-form'),
                'enableClientValidation'=>true,
                'clientOptions'=>array(
                    'validateOnSubmit'=>true,
                    'afterValidate' => 'js: function(form, data, hasError){
                        if(hasError)
                            $(".captcha-container a").click();
                        else
                            return true;
                    }'
                ),
            )); ?>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-5 col-xs-12">
                    <div class="form-group">
                        <?php echo $form->dropDownList($model,'department_id', CHtml::listData(ContactDepartment::model()->findAll(array('order'=>'id')),'id','title'),array('class'=>'form-control select-picker','prompt'=>'بخش موردنظر را انتخاب کنید', 'id' => 'department')) ?>
                        <?php echo $form->error($model,'department_id') ?>
                    </div>
                    <div class="form-group">
                        <?php echo $form->textField($model,'name',array('class'=>'form-control','placeholder'=>'نام و نام خانوادگی')) ?>
                        <?php echo $form->error($model,'name') ?>
                    </div>
                    <div class="form-group">
                        <?php echo $form->emailField($model,'email',array('class'=>'form-control','placeholder'=>'پست الکترونیکی')) ?>
                        <?php echo $form->error($model,'email') ?>
                    </div>
                    <div class="form-group">
                        <?php echo $form->telField($model,'tel',array('class'=>'form-control','placeholder'=>'شماره تلفن همراه')) ?>
                        <?php echo $form->error($model,'tel') ?>
                    </div>
                    <div class="form-group">
                        <?php echo $form->textField($model,'subject',array('class'=>'form-control','placeholder'=>'موضوع')) ?>
                        <?php echo $form->error($model,'subject') ?>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-7 col-xs-12">
                    <div class="form-group">
                        <?php echo $form->textArea($model,'body',array('class'=>'form-control','placeholder'=>'شرح')) ?>
                        <?php echo $form->error($model,'body') ?>
                    </div>
                    <div class="form-group captcha-container">
                        <?php $this->widget('CCaptcha'); ?>
                        <?php echo $form->textField($model,'verifyCode',array('class'=>'form-control captcha pull-right','placeholder'=>"تصویر امنیتی")); ?>
                        <?php echo $form->error($model,'verifyCode') ?>
                        <?php echo CHtml::submitButton('ارسال',array('class' => 'btn btn-primary pull-left')); ?>
                    </div>
                </div>
            </div>
            <?php $this->endWidget() ?>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-8 pull-left address">
                <?php if(SiteSetting::getOption('address')): ?><p><?= CHtml::encode(SiteSetting::getOption('address')) ?></p><?php endif;?>
                <?php if(SiteSetting::getOption('tel')): ?><div><span class="pull-right">تلفن :</span><div class="pull-left ltr"><?= CHtml::encode(SiteSetting::getOption('tel')) ?></div></div><?php endif;?>
                <?php if(SiteSetting::getOption('fax')): ?><div><span class="pull-right">فکس :</span><div class="pull-left ltr"><?= CHtml::encode(SiteSetting::getOption('fax')) ?></div></div><?php endif;?>
                <?php if(SiteSetting::getOption('master_email')): ?><p><span class="pull-right">پست الکترونیکی :</span><span class="pull-left ltr"><?= CHtml::encode(SiteSetting::getOption('master_email')) ?></span></p><?php endif;?>
            </div>
        </div>
    </div>
</section>

<script>
    $(function () {
        $("#yw0_button").click();
    });
</script>