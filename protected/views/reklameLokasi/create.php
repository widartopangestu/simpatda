<?php
/* @var $this ReklameLokasiController */
/* @var $model ReklameLokasi */
?>

<?php
$this->breadcrumbs=array(
	Yii::t('trans', 'Reklame Lokasi')=>array('index'),
	Yii::t('trans', 'Create'),
);
$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Create') . ' ' . Yii::t('trans', 'Reklame Lokasi');
$this->modulTitle = Yii::t('trans', 'Create') . ' ' . Yii::t('trans', 'Reklame Lokasi');
$this->menu=array(
	array('label'=>Yii::t('trans', 'Manage'), 'url'=>array('index'), 'icon' => 'list-alt', 'visible' => (Yii::app()->util->is_authorized('reklameLokasi.index')) ? true : false),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>