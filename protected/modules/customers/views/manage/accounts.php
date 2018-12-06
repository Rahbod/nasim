<?php
/* @var $this CustomersManageController */
/* @var $model Customers */

$this->breadcrumbs=array(
    'شماره حساب های مشتری'
);
?>

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">شماره حساب های مشتری</h3>
        <a href="<?php echo $this->createUrl('admin')?>" class="pull-left btn btn-danger btn-sm">بازگشت</a>
    </div>
    <div class="box-body">
        <?php $this->renderPartial("//partial-views/_flashMessage"); ?>
        <div class="table-responsive">
            <?php $this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'admins-grid',
                'dataProvider'=>$model->search(),
                'filter'=>$model,
                'itemsCssClass'=>'table table-striped table-hover',
                'columns'=>array(
                    'account_number',
                    'bank_name',
                    [
                        'name' => 'number_type',
                        'filter' => CustomerAccounts::$numberTypeLabels,
                        'value' => function($data){
                            return CustomerAccounts::$numberTypeLabels[$data->number_type];
                        }
                    ],
                    array(
                        'class'=>'CButtonColumn',
                        'template' => '{delete}',
                        'buttons' => array(
                            'delete'=> array(
                                'url' => 'Yii::app()->createUrl("/customers/manage/deleteAccount", array("id" => $data->id))'
                            )
                        )
                    )
                )
            )); ?>
        </div>
    </div>
</div>