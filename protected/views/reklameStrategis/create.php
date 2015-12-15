<?php
/* @var $this ReklameStrategisController */
/* @var $model ReklameStrategis */
?>

<?php
$this->breadcrumbs=array(
	Yii::t('trans', 'Reklame Strategis')=>array('index'),
	Yii::t('trans', 'Create'),
);
$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Create') . ' ' . Yii::t('trans', 'Reklame Strategis');
$this->modulTitle = Yii::t('trans', 'Create') . ' ' . Yii::t('trans', 'Reklame Strategis');
$this->menu=array(
	array('label'=>Yii::t('trans', 'Manage'), 'url'=>array('index'), 'icon' => 'list-alt', 'visible' => (Yii::app()->util->is_authorized('reklameStrategis.index')) ? true : false),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>