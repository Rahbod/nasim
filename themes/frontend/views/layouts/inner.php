<?php
/* @var $this Controller */
/* @var $content string */
?>
<!DOCTYPE html>
<html lang="fa_ir">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color" content="#de400b" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?= Yii::app()->request->csrfToken ?>" />
    <meta name="keywords" content="<?= $this->keywords ?>">
    <meta name="description" content="<?= $this->description?> ">
    <!-- <link rel="alternate" href="afra841.ir" hreflang="fa" /> -->
    <link rel="shortcut icon" href="<?php echo Yii::app()->getBaseUrl(true).'/themes/frontend/images/favicon.png';?>">
    <title><?= (!empty($this->pageTitle)?$this->pageTitle.' | ':'').$this->siteName ?></title>

    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl;?>/css/fontiran.css">
    <?php
    $baseUrl = Yii::app()->theme->baseUrl;
    $cs = Yii::app()->getClientScript();
    Yii::app()->clientScript->registerCoreScript('jquery');

    $cs->registerCssFile($baseUrl.'/css/bootstrap.min.css');
    $cs->registerCssFile($baseUrl.'/css/bootstrap-rtl.min.css');
    $cs->registerCssFile($baseUrl.'/css/bootstrap-theme.css?2'.time());
    $cs->registerCssFile($baseUrl.'/css/responsive-theme.css?2'.time());

    $cs->registerScriptFile($baseUrl.'/js/bootstrap.min.js', CClientScript::POS_END);
    $cs->registerScriptFile($baseUrl.'/js/parallax.min.js?2', CClientScript::POS_END);
    $cs->registerScriptFile($baseUrl.'/js/jquery.script.js?2'.time(), CClientScript::POS_END);
    ?>
</head>
<body class="page">
<?php $this->renderPartial('//partial-views/_header', array('inner'=>true));?>

<div class="container">
    <div class="top">
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
                <?php
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
        <div class="page-title h1"><?= $this->pageHeader ?></div>
    </div>
    <div class="content">
        <?php echo $content;?>
    </div>
</div>

<?php $this->renderPartial('//partial-views/_footer');?>
<?php $this->renderPartial('//partial-views/_copyright');?>
</body>
</html>