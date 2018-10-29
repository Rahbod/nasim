<?
/* @var $this Controller*/
?>
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
                <a href="#" class="telegram"></a>
                <a href="#" class="twitter"></a>
                <a href="#" class="facebook"></a>
                <a href="#" class="whatsapp"></a>
                <span>exchange</span>
                <div class="phone">
                    <?= SiteSetting::getOption('tel_code') ?><span><?= SiteSetting::getOption('tel') ?></span>
                </div>
            </div>
        </div>
    </div>
</div>












<!--<header>-->
<!--    <div class="container-fluid">-->
<!--        <div class="col-lg-7 col-md-8 col-sm-4 col-xs-2">-->
<!--            <a href="#" class="menu-trigger hidden-lg hidden-md"></a>-->
<!--            <ul class="nav nav-pills">-->
<!--                <li class="heading hidden-lg hidden-md"><a href="#" class="menu-trigger"></a><span>منوی سایت</span></li>-->
<!--                <li><a href="--><?//= Yii::app()->getBaseUrl(true)?><!--">صفحه اصلی</a></li>-->
<!--                <li><a href="--><?//= Pages::getPageUrlWithTitle("ترجمه رسمی")?><!--">ترجمه رسمی</a></li>-->
<!--                <li><a href="--><?//= Pages::getPageUrlWithTitle("تاییدات مدارک")?><!--">تاییدات مدارک</a></li>-->
<!--                <li><a href="--><?//= Pages::getPageUrlWithTitle("آدرس های مهم")?><!--">آدرس های مهم</a></li>-->
<!--                <li><a href="--><?//= Pages::getPageUrlWithTitle("تعرفه ها")?><!--">تعرفه ها</a></li>-->
<!--                <li><a href="--><?//= Pages::getPageUrlWithTitle("درباره دفتر ترجمه رسمی افرا")?><!--">درباره ما</a></li>-->
<!--                <li><a href="--><?//= $this->createUrl('/contact')?><!--">تماس با ما</a></li>-->
<!--            </ul>-->
<!--        </div>-->
<!--        <div class="col-lg-5 col-md-4 col-sm-8 col-xs-10">-->
<!--            <a href="--><?//= Yii::app()->getBaseUrl(true)?><!--">-->
<!--                <div class="logo-container"></div>-->
<!--                <h1 class="hidden">--><?//= $this->siteName ?><!--</h1>-->
<!--                <h2 class="hidden">--><?//= $this->description ?><!--</h2>-->
<!--            </a>-->
<!--            <a href="tel:021--><?//= SiteSetting::getOption('tel') ?><!--">-->
<!--                <div class="phone-container">-->
<!--                    <div class="header-phone-icon">-->
<!--                        <span class="opensans-light">+98 21</span>-->
<!--                        <span class="opensans-bold">--><?//= SiteSetting::getOption('tel') ?><!--</span>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </a>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="overlay"></div>-->
<!--</header>-->
