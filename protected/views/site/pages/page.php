<?php
/* @var $this SiteController */
/* @var $model Pages */
$this->pageTitle=$model->title;
$this->pageHeader=$model->title;
$this->keywords=$model->getKeywords();
$this->description=$model->getDescription();
$this->breadcrumbs=array(
    'خانه' => array('/'),
    $model->title,
);
?>
<section class="page-content">
    <div class="container">
        <div class="section-text">
            <h2><?= $model->title ?></h2>
            <div class="text" dir="auto"><?php
                $purifier=new CHtmlPurifier();
                echo $purifier->purify($model->summary);
                ?>
            </div>
        </div>
    </div>
</section>