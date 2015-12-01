<?php
/* @var $this SptController */
/* @var $model Spt */
?>

<?php
$this->breadcrumbs=array(
	Yii::t('trans', 'SPTPD')=>array('index'),
	$model->id,
);

$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Manage') . ' ' . Yii::t('trans', 'SPTPD');
$this->modulTitle = Yii::t('trans', 'View') . ' ' . Yii::t('trans', 'SPTPD') . ' #' . $model->id;$this->menu=array(
array('label'=>Yii::t('trans', 'Manage'), 'url'=>array('index'), 'icon' => 'list-alt', 'visible' => (Yii::app()->util->is_authorized('spt.index')) ? true : false),
	array('label'=>Yii::t('trans', 'Create'), 'url'=>array('create'), 'icon'=>'file', 'visible' => (Yii::app()->util->is_authorized('spt.create')) ? true : false),
	array('label'=>Yii::t('trans', 'Update'), 'url'=>array('update', 'id'=>$model->id), 'icon'=>'pencil', 'visible' => (Yii::app()->util->is_authorized('spt.update')) ? true : false),
	array('label'=>Yii::t('trans', 'Delete'), 'url'=>'#', 'visible' => (Yii::app()->util->is_authorized('spt.delete')) ? true : false, 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>Yii::t('trans', 'Are you sure you want to delete this item?')), 'icon'=>'trash'),
);
?>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'id',
		'periode',
		'nomor',
		'periode_awal',
		'periode_akhir',
		'pajak',
		'nilai',
		'jenis_pemungutan',
		'tarif_dasar',
		'tarif_persen',
		'tanggal_proses',
		'tanggal_entry',
		'uraian',
		'jenis_pajak',
		'wajib_pajak_id',
		'kode_rekening_id',
		'jenis_surat_id',
		'updated',
		'created',
	),
)); ?>