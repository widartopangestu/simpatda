<?php
/* @var $this ReklameLuasController */
/* @var $model ReklameLuas */
?>

<?php
$this->breadcrumbs=array(
	Yii::t('trans', 'Reklame Luas')=>array('index'),
	Yii::t('trans', 'Create'),
);
$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Create') . ' ' . Yii::t('trans', 'Reklame Luas');
$this->modulTitle = Yii::t('trans', 'Create') . ' ' . Yii::t('trans', 'Reklame Luas');
$this->menu=array(
	array('label'=>Yii::t('trans', 'Manage'), 'url'=>array('index'), 'icon' => 'list-alt', 'visible' => (Yii::app()->util->is_authorized('reklameLuas.index')) ? true : false),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>