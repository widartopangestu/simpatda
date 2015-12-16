<?php
/* @var $this ReklameNjopKetinggianController */
/* @var $model ReklameNjopKetinggian */
?>

<?php
$this->breadcrumbs=array(
	Yii::t('trans', 'Reklame Njop Ketinggian')=>array('index'),
	Yii::t('trans', 'Create'),
);
$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Create') . ' ' . Yii::t('trans', 'Reklame Njop Ketinggian');
$this->modulTitle = Yii::t('trans', 'Create') . ' ' . Yii::t('trans', 'Reklame Njop Ketinggian');
$this->menu=array(
	array('label'=>Yii::t('trans', 'Manage'), 'url'=>array('index'), 'icon' => 'list-alt', 'visible' => (Yii::app()->util->is_authorized('reklameNjopKetinggian.index')) ? true : false),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>