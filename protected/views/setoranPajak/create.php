<?php
/* @var $this SetoranPajakController */
/* @var $model SetoranPajak */
?>

<?php
$this->breadcrumbs=array(
	Yii::t('trans', 'Setoran Pajak')=>array('index'),
	Yii::t('trans', 'Create'),
);
$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Create') . ' ' . Yii::t('trans', 'Setoran Pajak');
$this->modulTitle = Yii::t('trans', 'Create') . ' ' . Yii::t('trans', 'Setoran Pajak');
$this->menu=array(
	array('label'=>Yii::t('trans', 'Manage'), 'url'=>array('index'), 'icon' => 'list-alt', 'visible' => (Yii::app()->util->is_authorized('setoranPajak.index')) ? true : false),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>