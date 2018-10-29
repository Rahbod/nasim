<?php
/* @var $this SiteController */
/* @var $model Pages */
$this->pageTitle=$model->title;
$this->description=$model->getDescription();
?>
<h2 class="orange-title"><?= $model->title ?></h2>
<div class="text" dir="auto"><?php
    $purifier=new CHtmlPurifier();
    echo $purifier->purify($model->summary);
    ?>
</div>