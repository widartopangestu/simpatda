<?php
/* @var $this PemeriksaanController */
/* @var $model Pemeriksaan */
?>

<?php
$this->breadcrumbs=array(
	Yii::t('trans', 'Laporan Hasil Pemeriksaan (LHP)')=>array('index'),
	Yii::t('trans', 'Create'),
);
$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Create') . ' ' . Yii::t('trans', 'Laporan Hasil Pemeriksaan (LHP)');
$this->modulTitle = Yii::t('trans', 'Create') . ' ' . Yii::t('trans', 'Laporan Hasil Pemeriksaan (LHP)');
$this->menu=array(
	array('label'=>Yii::t('trans', 'Manage'), 'url'=>array('index'), 'icon' => 'list-alt', 'visible' => (Yii::app()->util->is_authorized('pemeriksaan.index')) ? true : false),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>