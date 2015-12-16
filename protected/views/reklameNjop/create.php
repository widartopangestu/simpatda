<?php
/* @var $this ReklameNjopController */
/* @var $model ReklameNjop */
?>

<?php
$this->breadcrumbs=array(
	Yii::t('trans', 'Reklame Njop')=>array('index'),
	Yii::t('trans', 'Create'),
);
$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Create') . ' ' . Yii::t('trans', 'Reklame Njop');
$this->modulTitle = Yii::t('trans', 'Create') . ' ' . Yii::t('trans', 'Reklame Njop');
$this->menu=array(
	array('label'=>Yii::t('trans', 'Manage'), 'url'=>array('index'), 'icon' => 'list-alt', 'visible' => (Yii::app()->util->is_authorized('reklameNjop.index')) ? true : false),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>