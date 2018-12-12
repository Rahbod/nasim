<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<?php
    /** @var $cs CClientScript */
	$baseUrl = Yii::app()->theme->baseUrl;
	$cs = Yii::app()->getClientScript();
	Yii::app()->clientScript->registerCoreScript('jquery');
	?>
	<link rel="stylesheet" href="<?php echo $baseUrl;?>/css/fontiran.css" media="print">
	<?php
	$cs->registerCssFile($baseUrl.'/css/bootstrap.min.css', 'print');
	$cs->registerCssFile($baseUrl.'/css/bootstrap-reset.css', 'print');
	$cs->registerCssFile($baseUrl.'/css/bootstrap-select.min.css', 'print');
	$cs->registerCssFile($baseUrl.'/css/bootstrap-responsive.min.css', 'print');
	$cs->registerCssFile($baseUrl.'/css/font-awesome.css', 'print');
	$cs->registerCssFile($baseUrl.'/css/abound.css?2', 'print');
	$cs->registerCssFile($baseUrl.'/css/rtl.css?2', 'print');
	$cs->registerCssFile($baseUrl.'/css/style-blue.css?2', 'print');
	$cs->registerCoreScript('jquery.ui');
	$cs->registerScriptFile($baseUrl.'/js/bootstrap.min.js');
	$cs->registerScriptFile($baseUrl.'/js/bootstrap-select.min.js', CClientScript::POS_END);
//	$cs->registerScriptFile($baseUrl.'/js/defaults-fa_IR.min.js', CClientScript::POS_END);
	$cs->registerScriptFile($baseUrl.'/js/scripts.js?2');
	?>
</head>

<body>
<section class="container">
	<?php echo $content; ?>
    <script>
        window.print();
    </script>
</section>
</body>
</html>