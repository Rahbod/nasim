<?php
/* @var $this AdminsDashboardController*/
/* @var $statistics []*/
/* @var CActiveDataProvider $newItemsProvider */
/* @var $lists Lists */

$permissions = [
    'contact' => false,
    'statistics' => false,
];
if(Yii::app()->user->roles == 'admin'){
    $permissions['contact'] = true;
    $permissions['statistics'] = true;
}
?>
<div class="row boxed-statistics">
    <div class="col-md-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-maroon">
            <div class="inner">
                <h3><?php echo $statistics['messages'];?></h3>
                <p>پیغام ها (خوانده نشده)</p>
            </div>
            <div class="icon">
                <i class="ion ion-android-contact"></i>
            </div>
            <a href="<?php echo $this->createUrl('/contact/messages/admin');?>" class="small-box-footer">مشاهده پیغام ها <i class="fa fa-arrow-circle-left"></i></a>
        </div>
    </div>
</div>
<div class="row">
    <section class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <!--Statistics-->
        <?php
        if($permissions['statistics']):
            ?>
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title" >آمار بازدیدکنندگان</h3>
                </div>
                <div class="box-body">
                    <p>
                        افراد آنلاین : <?php echo Yii::app()->userCounter->getOnline(); ?><br />
                        بازدید امروز : <?php echo Yii::app()->userCounter->getToday(); ?><br />
                        بازدید دیروز : <?php echo Yii::app()->userCounter->getYesterday(); ?><br />
                        تعداد کل بازدید ها : <?php echo Yii::app()->userCounter->getTotal(); ?><br />
                        بیشترین بازدید : <?php echo Yii::app()->userCounter->getMaximal(); ?><br />
                    </p>
                </div>
            </div>
            <?php
        endif;
        ?>
    </section>
</div>
