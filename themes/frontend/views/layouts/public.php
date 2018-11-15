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

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl;?>/css/fontiran.css">
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
<body>
    <?php $this->renderPartial('//partial-views/_header');?>
    <div class="home-bottom">
        <?php echo $content;?>
        <?php $this->renderPartial('//partial-views/_footer');?>
        <?php $this->renderPartial('//partial-views/_copyright');?>
    </div>
</body>
</html>