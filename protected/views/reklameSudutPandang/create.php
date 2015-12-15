<?php
/* @var $this ReklameSudutPandangController */
/* @var $model ReklameSudutPandang */
?>

<?php
$this->breadcrumbs=array(
	Yii::t('trans', 'Reklame Sudut Pandang')=>array('index'),
	Yii::t('trans', 'Create'),
);
$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Create') . ' ' . Yii::t('trans', 'Reklame Sudut Pandang');
$this->modulTitle = Yii::t('trans', 'Create') . ' ' . Yii::t('trans', 'Reklame Sudut Pandang');
$this->menu=array(
	array('label'=>Yii::t('trans', 'Manage'), 'url'=>array('index'), 'icon' => 'list-alt', 'visible' => (Yii::app()->util->is_authorized('reklameSudutPandang.index')) ? true : false),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>