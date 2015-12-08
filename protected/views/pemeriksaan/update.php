<?php
/* @var $this PemeriksaanController */
/* @var $model Pemeriksaan */
?>

<?php
$this->breadcrumbs=array(
	Yii::t('trans', 'Laporan Hasil Pemeriksaan (LHP)')=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	Yii::t('trans', 'Update'),
);

$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Update') . ' ' . Yii::t('trans', 'Laporan Hasil Pemeriksaan (LHP)');
$this->modulTitle = Yii::t('trans', 'Update') . ' ' . Yii::t('trans', 'Laporan Hasil Pemeriksaan (LHP)') . ' #' . $model->id;$this->menu=array(
	array('label'=>Yii::t('trans', 'Manage'), 'url'=>array('index'), 'icon' => 'list-alt', 'visible' => (Yii::app()->util->is_authorized('pemeriksaan.index')) ? true : false),
	array('label'=>Yii::t('trans', 'Create'), 'url'=>array('create'), 'icon'=>'file', 'visible' => (Yii::app()->util->is_authorized('pemeriksaan.create')) ? true : false),
	array('label'=>Yii::t('trans', 'View'), 'url'=>array('view', 'id'=>$model->id), 'icon'=>'eye-open', 'visible' => (Yii::app()->util->is_authorized('pemeriksaan.view')) ? true : false),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>