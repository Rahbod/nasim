<?php
/* @var $this AdminsManageController */
/* @var $model Admins */

$this->breadcrumbs=array(
	'شعب'=>array('index'),
	'مدیریت',
);
?>

<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title">مدیریت شعب</h3>
		<a href="<?php echo $this->createUrl('createBranch')?>" class="btn btn-success pull-left btn-sm">افزودن شعبه</a>
	</div>
	<div class="box-body">
		<?php $this->renderPartial("//partial-views/_flashMessage"); ?>
		<div class="table-responsive">
			<?php $this->widget('zii.widgets.grid.CGridView', array(
				'id'=>'admins-grid',
				'dataProvider'=>$model->search(),
				'filter'=>$model,
				'columns'=>array(
					'username',
					'email',
					array(
						'class'=>'CButtonColumn',
						'template' => '{delete}'
					),
				),
			)); ?>
		</div>
	</div>
</div>