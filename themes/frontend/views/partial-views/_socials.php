<?php
$scl = SiteSetting::getOption('social_links')?:null;
if($scl):
    $scl = CJSON::decode($scl);
    $tl = isset($scl['telegram'])?$scl['telegram']:false;
    $tw = isset($scl['twitter'])?$scl['twitter']:false;
    $fb = isset($scl['facebook'])?$scl['facebook']:false;
    $wh = isset($scl['whatsapp'])?$scl['whatsapp']:false;
    $in = isset($scl['instagram'])?$scl['instagram']:false;
    ?>
    <div class="socials-container">
        <?php if($tl): ?><a target="_blank" href="<?= $tl; ?>" class="telegram"></a><?php endif; ?>
        <?php if($tw): ?><a target="_blank" href="<?= $tw; ?>" class="twitter"></a><?php endif; ?>
        <?php if($fb): ?><a target="_blank" href="<?= $fb; ?>" class="facebook"></a><?php endif; ?>
        <?php if($wh): ?><a target="_blank" href="<?= $wh; ?>" class="whatsapp"></a><?php endif; ?>
        <?php if($in): ?><a target="_blank" href="<?= $in; ?>" class="instagram"></a><?php endif; ?>
    </div>
<?php
endif;