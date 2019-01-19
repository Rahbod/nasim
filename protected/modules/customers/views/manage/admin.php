<?php
/* @var $this CustomersManageController */
/* @var $model Customers */

$this->breadcrumbs=array(
    'مشتریان'=>array('admin'),
    'مدیریت مشتریان',
);
?>

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">مدیریت مشتریان</h3>
        <a href="<?php echo $this->createUrl('create')?>" class="pull-left btn btn-success btn-sm">افزودن مشتری</a>
    </div>
    <div class="box-body">
        <?php $this->renderPartial("//partial-views/_flashMessage"); ?>
        <div class="table-responsive">
            <?php $this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'admins-grid',
                'dataProvider'=>$model->search(),
                'filter'=>$model,
                'itemsCssClass'=>'table table-striped table-hover',
                'template' => '{summary} {pager} {items} {pager}',
                'ajaxUpdate' => true,
                'afterAjaxUpdate' => "function(id, data){
                    $('html, body').animate({
                    scrollTop: ($('#'+id).offset().top-130)
                    },1000,'easeOutCubic');
                }",
                'pager' => array(
                    'header' => '',
                    'firstPageLabel' => '<<',
                    'lastPageLabel' => '>>',
                    'prevPageLabel' => '<',
                    'nextPageLabel' => '>',
                    'cssFile' => false,
                    'htmlOptions' => array(
                        'class' => 'pagination pagination-sm',
                    ),
                ),
                'pagerCssClass' => 'blank',
                'columns'=>array(
                    'code',
                    'name',
                    [
                        'header' => 'شماره حساب های مشتری',
                        'type' => 'raw',
                        'value' => function($data){
                            return CHtml::link('نمایش', Yii::app()->createUrl('/customers/manage/accounts',array('id' => $data->id)),array('class' => 'btn btn-primary btn-sm','style' => 'width:60px;margin-left:10px')).' '.
                                CHtml::link('افزودن', Yii::app()->createUrl('/customers/manage/addAccount',array('id' => $data->id)),array('class' => 'btn btn-success btn-sm','style' => 'width:60px'));
                        }
                    ],
                    array(
                        'class'=>'CButtonColumn',
                    )
                )
            )); ?>
        </div>
    </div>
</div>