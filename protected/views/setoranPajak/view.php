<?php
/* @var $this SetoranPajakController */
/* @var $model SetoranPajak */
?>

<?php
$this->breadcrumbs=array(
	Yii::t('trans', 'Setoran Pajak')=>array('index'),
	$model->id,
);

$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Manage') . ' ' . Yii::t('trans', 'Setoran Pajak');
$this->modulTitle = Yii::t('trans', 'View') . ' ' . Yii::t('trans', 'Setoran Pajak') . ' #' . $model->id;$this->menu=array(
array('label'=>Yii::t('trans', 'Manage'), 'url'=>array('index'), 'icon' => 'list-alt', 'visible' => (Yii::app()->util->is_authorized('setoranPajak.index')) ? true : false),
	array('label'=>Yii::t('trans', 'Create'), 'url'=>array('create'), 'icon'=>'file', 'visible' => (Yii::app()->util->is_authorized('setoranPajak.create')) ? true : false),
	array('label'=>Yii::t('trans', 'Update'), 'url'=>array('update', 'id'=>$model->id), 'icon'=>'pencil', 'visible' => (Yii::app()->util->is_authorized('setoranPajak.update')) ? true : false),
	array('label'=>Yii::t('trans', 'Delete'), 'url'=>'#', 'visible' => (Yii::app()->util->is_authorized('setoranPajak.delete')) ? true : false, 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>Yii::t('trans', 'Are you sure you want to delete this item?')), 'icon'=>'trash'),
);
?>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'id',
		'nomor',
		'tanggal_bayar',
		'jumlah_bayar',
		'jumlah_potongan',
		'via_bayar',
		'nama_penyetor',
		'penetapan_id',
		'created',
		'updated',
	),
)); ?>