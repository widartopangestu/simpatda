<?php
/* @var $this PejabatController */
/* @var $model Pejabat */
?>

<?php
$this->breadcrumbs=array(
	Yii::t('trans', 'Pejabat')=>array('index'),
	$model->id,
);

$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Manage') . ' ' . Yii::t('trans', 'Pejabat');
$this->menu=array(
array('label'=>Yii::t('trans', 'Manage'), 'url'=>array('index'), 'icon' => 'list-alt', 'visible' => (Yii::app()->util->is_authorized('pejabat.index')) ? true : false),
	array('label'=>Yii::t('trans', 'Create'), 'url'=>array('create'), 'icon'=>'file', 'visible' => (Yii::app()->util->is_authorized('pejabat.create')) ? true : false),
	array('label'=>Yii::t('trans', 'Update'), 'url'=>array('update', 'id'=>$model->id), 'icon'=>'pencil', 'visible' => (Yii::app()->util->is_authorized('pejabat.update')) ? true : false),
	array('label'=>Yii::t('trans', 'Delete'), 'url'=>'#', 'visible' => (Yii::app()->util->is_authorized('pejabat.delete')) ? true : false, 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>Yii::t('trans', 'Are you sure you want to delete this item?')), 'icon'=>'trash'),
);
?>

<div class="widget ">
    <div class="widget-header">
        <i class="icon-eye-open"></i>
        <h3><?php echo Yii::t('trans', 'View') . ' ' . Yii::t('trans', 'Pejabat'); ?>  #<?php echo $model->id; ?></h3>
    </div> <!-- /widget-header -->
    <div class="widget-content">
<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'kode',
		'nama',
		'nip',
		'status',
		'golongan_id',
		'jabatan_id',
		'pangkat_id',
                array(
                    'name' => 'created',
                    'value' => $model->created !== NULL ? date("d-M-Y H:i:s", strtotime($model->created)) : '',
                ),
                array(
                    'name' => 'updated',
                    'value' => $model->updated !== NULL ? date("d-M-Y H:i:s", strtotime($model->updated)) : '',
                ),
	),
)); ?>
    </div>
</div>