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
<?php if($model->id == 2): ?>
    <div class="overflow-fix">
        <a href="#" class="transfer-link black">فرم با فرمت<span>pdf</span></a>
        <a href="#" class="transfer-link">فرم با فرمت<span>word</span></a>
    </div>
<?php endif; ?>