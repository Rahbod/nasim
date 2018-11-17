<?php
/* @var $this Controller*/
$controller = $this->action->controller->id;
$module = $this->action->controller->module->id;
$action = $this->action->id;
?>
<?php if(isset($inner) && $inner): ?>
    <div class="header">
        <div class="container">
            <div class="navbar hidden-xs">
                <ul class="nav navbar-nav">
                    <li<?= $controller=='site' && $action=='index'?' class="active"':''?>><a href="<?= Yii::app()->getBaseUrl(true)?>">صفحه اصلی<span class="en-title">Home</span></a></li>
                    <li<?= $module=='pages' && $action=='view' && isset($_GET['id']) && $_GET['id']==2?' class="active"':''?>><a href="<?= $this->createUrl('/pages/2') ?>">ارسال حواله<span class="en-title">Transfer Form</span></a></li>
                    <li<?= $module=='pages' && $action=='view' && isset($_GET['id']) && $_GET['id']==3?' class="active"':''?>><a href="<?= $this->createUrl('/pages/3') ?>">شرایط و مقررات<span class="en-title">Terms</span></a></li>
                    <li<?= $module=='pages' && $action=='view' && isset($_GET['id']) && $_GET['id']==1?' class="active"':''?>><a href="<?= $this->createUrl('/pages/1') ?>">درباره ما<span class="en-title">About us</span></a></li>
                    <li<?= $controller=='site' && $action=='contact'?' class="active"':''?>><a href="<?= $this->createUrl('/contact')?>">تماس با ما<span class="en-title">Contact us</span></a></li>
                </ul>
            </div>
            <div class="visible-xs">
                <a href="#mobile-menu" class="mobile-menu-trigger"></a>
                <a href="<?= Yii::app()->getBaseUrl(true)?>" class="logo"></a>
            </div>
            <a href="<?= Yii::app()->getBaseUrl(true)?>" class="logo hidden-xs"></a>
        </div>
    </div>
    <?php $this->renderPartial('//partial-views/_banner', array('class' => 'page-bg'));?>
<?php else:
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
    <div class="home-top">
        <?php $this->renderPartial('//partial-views/_banner');?>
        <div class="container">
            <div class="header">
                <div class="navbar hidden-xs">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="<?= Yii::app()->getBaseUrl(true)?>">صفحه اصلی<span class="en-title">Home</span></a></li>
                        <li><a href="<?= $this->createUrl('/pages/2') ?>">ارسال حواله<span class="en-title">Transfer Form</span></a></li>
                        <li><a href="<?= $this->createUrl('/pages/3') ?>">شرایط و مقررات<span class="en-title">Terms</span></a></li>
                        <li><a href="<?= $this->createUrl('/pages/1') ?>">درباره ما<span class="en-title">About us</span></a></li>
                        <li><a href="<?= $this->createUrl('/contact')?>">تماس با ما<span class="en-title">Contact us</span></a></li>
                    </ul>
                </div>
                <div class="visible-xs">
                    <a href="#" class="mobile-menu-trigger"></a>
                </div>
                <a href="<?= Yii::app()->getBaseUrl(true)?>" class="logo"></a>
            </div>
            <div class="price-box">
                <?php
                $p = SiteSetting::getOption('price');
                $fp = SiteSetting::getOption('foreign_price');
                ?>
                <div class="item black">
                    <h2>استرالیا به ایران<small>australia to iran</small></h2>
                    <span><?php if($p && intval($p)): ?><?= number_format($p) ?> تومان<?php else: ?>تماس بگیرید<?php endif; ?></span>
                </div>
                <div class="item orange">
                    <h2>ایران به استرالیا<small>iran to australia</small></h2>
                    <span><?php if($fp && intval($fp)): ?><?= number_format($fp) ?> تومان<?php else: ?>تماس بگیرید<?php endif; ?></span>
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
                        <?= SiteSetting::getOption('tel_code') ?><span><a href="tel:<?= SiteSetting::getOption('tel_code').str_replace(' ','', SiteSetting::getOption('tel'))?>">
                            <?= SiteSetting::getOption('tel') ?>
                        </a> - <a href="tel:<?= SiteSetting::getOption('tel_code').str_replace(' ','', SiteSetting::getOption('tel2'))?>">
                            <?= SiteSetting::getOption('tel2') ?>
                        </a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<div class="" id="mobile-menu">
    <div class="overlay"></div>
    <div class="content">
        <a href="#" class="close-menu"></a>
        <a href="<?= Yii::app()->getBaseUrl(true)?>" ><div class="mobile-logo"></div></a>
        <ul>
            <li class="active"><a href="<?= Yii::app()->getBaseUrl(true)?>">صفحه اصلی<span class="en-title">Home</span></a></li>
            <li><a href="<?= $this->createUrl('/pages/2') ?>">ارسال حواله<span class="en-title">Transfer Form</span></a></li>
            <li><a href="<?= $this->createUrl('/pages/3') ?>">شرایط و مقررات<span class="en-title">Terms</span></a></li>
            <li><a href="<?= $this->createUrl('/pages/1') ?>">درباره ما<span class="en-title">About us</span></a></li>
            <li><a href="<?= $this->createUrl('/contact')?>">تماس با ما<span class="en-title">Contact us</span></a></li>
        </ul>
        <div class="socials-container">
            <?php if($tl): ?><a target="_blank" href="<?= $tl; ?>" class="telegram"></a><?php endif; ?>
            <?php if($tw): ?><a target="_blank" href="<?= $tw; ?>" class="twitter"></a><?php endif; ?>
            <?php if($fb): ?><a target="_blank" href="<?= $fb; ?>" class="facebook"></a><?php endif; ?>
            <?php if($wh): ?><a target="_blank" href="<?= $wh; ?>" class="whatsapp"></a><?php endif; ?>
            <?php if($in): ?><a target="_blank" href="<?= $in; ?>" class="instagram"></a><?php endif; ?>
        </div>
    </div>
</div>
