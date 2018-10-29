<?
/* @var $this Controller*/

$scl = SiteSetting::getOption('social_links')?:null;
if($scl):
    $scl = CJSON::decode($scl);
    $tl = isset($scl['telegram'])?$scl['telegram']:false;
    $tw = isset($scl['twitter'])?$scl['twitter']:false;
    $fb = isset($scl['facebook'])?$scl['facebook']:false;
    $wh = isset($scl['whatsapp'])?$scl['whatsapp']:false;
    $in = isset($scl['instagram'])?$scl['instagram']:false;
endif;
?>
<?php if(isset($inner) && $inner): ?>
    <div class="header">
        <div class="container">
            <div class="navbar hidden-xs">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="<?= Yii::app()->getBaseUrl(true)?>">صفحه اصلی</a></li>
                    <li><a href="<?= $this->createUrl('/pages/2') ?>">ارسال حواله</a></li>
                    <li><a href="<?= $this->createUrl('/pages/3') ?>">شرایط و مقررات</a></li>
                    <li><a href="<?= $this->createUrl('/pages/1') ?>">درباره ما</a></li>
                    <li><a href="<?= $this->createUrl('/contact')?>">تماس با ما</a></li>
                </ul>
            </div>
            <div class="visible-xs">
                <a href="#mobile-menu" class="mobile-menu-trigger"></a>
                <a href="#" class="logo"></a>
            </div>
            <a href="<?= Yii::app()->getBaseUrl(true)?>" class="logo hidden-xs"></a>
        </div>
    </div>
    <?php $this->renderPartial('//partial-views/_banner', array('class' => 'page-bg'));?>
<?php else: ?>
    <div class="home-top">
        <?php $this->renderPartial('//partial-views/_banner');?>
        <div class="container">
            <div class="header">
                <div class="navbar hidden-xs">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="<?= Yii::app()->getBaseUrl(true)?>">صفحه اصلی</a></li>
                        <li><a href="<?= $this->createUrl('/pages/2') ?>">ارسال حواله</a></li>
                        <li><a href="<?= $this->createUrl('/pages/3') ?>">شرایط و مقررات</a></li>
                        <li><a href="<?= $this->createUrl('/pages/1') ?>">درباره ما</a></li>
                        <li><a href="<?= $this->createUrl('/contact')?>">تماس با ما</a></li>
                    </ul>
                </div>
                <div class="visible-xs">
                    <a href="#" class="mobile-menu-trigger"></a>
                </div>
                <a href="<?= Yii::app()->getBaseUrl(true)?>" class="logo"></a>
            </div>
            <div class="price-box">
                <div class="item black">
                    <h3>استرالیا به ایران<small>australia to iran</small></h3>
                    <span><?= number_format(SiteSetting::getOption('price')) ?> تومان</span>
                </div>
                <div class="item orange">
                    <h3>ایران به استرالیا<small>iran to australia</small></h3>
                    <span>تماس بگیرید</span>
                </div>
            </div>
            <div class="title-box hidden-xs">
                <h1>nas<span>ee</span>m</h1>
                <div class="socials-container">
                    <?php if($tl): ?><a target="_blank" href="<?= $tl; ?>" class="telegram"></a><?php endif; ?>
                    <?php if($tw): ?><a target="_blank" href="<?= $tw; ?>" class="twitter"></a><?php endif; ?>
                    <?php if($fb): ?><a target="_blank" href="<?= $fb; ?>" class="facebook"></a><?php endif; ?>
                    <?php if($wh): ?><a target="_blank" href="<?= $wh; ?>" class="whatsapp"></a><?php endif; ?>
                    <?php if($in): ?><a target="_blank" href="<?= $in; ?>" class="instagram"></a><?php endif; ?>
                    <span>exchange</span>
                    <div class="phone">
                        <?= SiteSetting::getOption('tel_code') ?><span><?= SiteSetting::getOption('tel') ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>