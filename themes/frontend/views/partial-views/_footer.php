<div class="footer">
    <div class="container">
        <div class="content row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <h5>شعبه ایران</h5>
                <p><?= SiteSetting::getOption('iran_address') ?></p>
                <h5>شعبه استرالیا</h5>
                <p><?= SiteSetting::getOption('foreign_address') ?></p>
                <p><?= SiteSetting::getOption('foreign_address2') ?></p>
                <div class="phone">
                    <?= SiteSetting::getOption('tel_code') ?> <span><?= SiteSetting::getOption('tel') ?> - <?= SiteSetting::getOption('tel2') ?></span>
                </div>
            </div>
            <div class=""></div>
        </div>
    </div>
    <?php $this->renderPartial('//partial-views/_map') ?>
</div>