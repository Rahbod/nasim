<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $page Pages */
/* @var $form CActiveForm */

$this->pageTitle="تماس با ما";
$this->pageHeader=$page->en_title;
$this->breadcrumbs=array(
	'تماس با ما',
);

Yii::import('map.models.GoogleMaps');
$map_model = GoogleMaps::model()->findByPk(1);
$mapLat = $map_model->map_lat;
$mapLng = $map_model->map_lng;
$mapZoom = 15;
if($map_model) {
    Yii::app()->clientScript->registerScriptFile('https://maps.googleapis.com/maps/api/js?key=AIzaSyDbhMDAxCreEWc5Due7477QxAVuBAJKdTM');
    Yii::app()->clientScript->registerScript('concat-script', "
    var map2;
	var marker2;
	var myCenter2=new google.maps.LatLng(" . $mapLat . "," . $mapLng . ");
	function initialize2()
	{
		var mapProp = {
          center:myCenter2,
          zoom:" . $mapZoom . ",
          scrollwheel: false
          };

	    map2 = new google.maps.Map(document.getElementById('contact-google-map-2'),mapProp);
		placeMarker2(myCenter2 ,map2);
	}

	function placeMarker2(location ,map) {

		if(marker2 != undefined)
			marker2.setMap(null);
	    marker2 = new google.maps.Marker({
            position: location,
            map: map,
        });
	}
	google.maps.event.addDomListener(window, 'load', initialize2);",CClientScript::POS_READY);
}

?>
<div class="contact-box">
    <h2 class="orange-title"><?= $page->title ?></h2>
    <div class="text" dir="auto"><?php
        $purifier=new CHtmlPurifier();
        echo $purifier->purify($page->summary);
        ?>
    </div>
    <div class="contact-icon-outer hidden-xs">
        <div class="contact-icon"></div>
    </div>
    <?php $this->renderPartial('//partial-views/_flashMessage') ?>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <p>                        در صورتی که مایل به تماس با ما هستید، می توانید از طریق فرم زیر بخش مورد نظر خود را انتخاب و موضوع خود را مطرح کنید. همچنین می توانید با شماره تماس های درج شده نیز تماس حاصل فرمایید.</p>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <?php $this->renderPartial('//partial-views/_socials') ?>
        </div>
    </div>
    <div id="contact-google-map">
        <div style="height: 300px;" id="contact-google-map-2"></div>
    </div>
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
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-8 pull-left address">
        <?php if(SiteSetting::getOption('foreign_address')): ?><div dir="ltr"><span>Address: </span><div class="pull-left ltr"><a class="address-link" href="http://maps.google.com/?q=<?= urlencode(SiteSetting::getOption('foreign_address')) ?>"><?= SiteSetting::getOption('foreign_address') ?></a></div>
            <?php if(SiteSetting::getOption('foreign_address2')): ?><br><div class="pull-left ltr"><a class="address-link" href="http://maps.google.com/?q=<?= urlencode(SiteSetting::getOption('foreign_address2')) ?>"><?= SiteSetting::getOption('foreign_address2') ?></a></div><?php endif;?>
            </div><?php endif;?>
        <?php if(SiteSetting::getOption('tel')): ?><div dir="ltr"><span>tel :</span><div dir="ltr"><?= CHtml::encode(SiteSetting::getOption('tel_code')) ?> <a href="tel:<?= SiteSetting::getOption('tel_code').str_replace(' ','', SiteSetting::getOption('tel'))?>">
                    <?= SiteSetting::getOption('tel') ?>
                </a> - <a href="tel:<?= SiteSetting::getOption('tel_code').str_replace(' ','', SiteSetting::getOption('tel2'))?>">
                    <?= SiteSetting::getOption('tel2') ?>
                </a></div></div><?php endif;?>
        <?php if(SiteSetting::getOption('master_email')): ?><div dir="ltr"><span>Master E-Mail :</span><div dir="ltr"><?= CHtml::encode(SiteSetting::getOption('master_email')) ?></div></div><?php endif;?>
    </div>
</div>
<script>
    $(function () {
        $("#yw0_button").click();
    });
</script>