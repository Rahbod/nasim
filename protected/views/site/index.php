<?php
/**
 * @var $this Controller
 * @var $cs CClientScript
 * @var $baseUrl string
 */

$pages = Pages::model()->findAllByAttributes(['category_id' => 2]);
?>
<div class="shape hidden-xs"></div>
<div class="container">
    <div class="intro-box">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <i class="icon law"></i>
                <div class="text">
                    <h4><?= CHtml::encode($pages[0]->title) ?></h4>
                    <div><?php
                        echo nl2br(strip_tags($pages[0]->summary));
                        ?></div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <i class="icon graph"></i>
                <div class="text">
                    <h4><?= CHtml::encode($pages[1]->title) ?></h4>
                    <div><?php
                        echo nl2br(strip_tags($pages[1]->summary));
                        ?></div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <i class="icon refresh"></i>
                <div class="text">
                    <h4><?= CHtml::encode($pages[2]->title) ?></h4>
                    <div><?php
                        echo nl2br(strip_tags($pages[2]->summary));
                        ?></div>
                </div>
            </div>
        </div>
    </div>
</div>