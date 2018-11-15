<div class="footer">
    <?php $this->renderPartial('//partial-views/_map') ?>
    <div class="container">
        <div class="content row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <h5>آدرس</h5>
                <p dir="ltr" class="text-right"><a class="address-link" href="http://maps.google.com/?q=<?= urlencode(SiteSetting::getOption('foreign_address')) ?>"><?= SiteSetting::getOption('foreign_address') ?></a></p>
                <p dir="ltr" class="text-right"><a class="address-link" href="http://maps.google.com/?q=<?= urlencode(SiteSetting::getOption('foreign_address2')) ?>"><?= SiteSetting::getOption('foreign_address2') ?></a></p>
                <div class="phone">
                    <?= SiteSetting::getOption('tel_code') ?> <span><a href="tel:<?= SiteSetting::getOption('tel_code').str_replace(' ','', SiteSetting::getOption('tel'))?>">
                            <?= SiteSetting::getOption('tel') ?>
                        </a> - <a href="tel:<?= SiteSetting::getOption('tel_code').str_replace(' ','', SiteSetting::getOption('tel2'))?>">
                            <?= SiteSetting::getOption('tel2') ?>
                        </a></span>
                </div>
            </div>
            <div class=""></div>
        </div>
    </div>
</div>