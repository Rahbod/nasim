<?php
/** @var $this Controller*/
$image = $this->pageBanner?
    Yii::app()->getBaseUrl(true).'/uploads/pages/'.$this->pageBanner:
    Yii::app()->getBaseUrl(true).'/uploads/banner/'.SiteSetting::getOption("banner");
?>
<div class="<?= isset($class)?$class:"home-bg" ?>">
    <div class="parallax-window" data-parallax="scroll" data-image-src="<?= $image ?>"></div>
</div>