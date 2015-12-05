<?php
/* @var $this SetoranPajakController */
/* @var $model SetoranPajak */
?>

<?php
$this->breadcrumbs=array(
	Yii::t('trans', 'Setoran Pajak')=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	Yii::t('trans', 'Update'),
);

$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Update') . ' ' . Yii::t('trans', 'Setoran Pajak');
$this->modulTitle = Yii::t('trans', 'Update') . ' ' . Yii::t('trans', 'Setoran Pajak') . ' #' . $model->id;$this->menu=array(
	array('label'=>Yii::t('trans', 'Manage'), 'url'=>array('index'), 'icon' => 'list-alt', 'visible' => (Yii::app()->util->is_authorized('setoranPajak.index')) ? true : false),
	array('label'=>Yii::t('trans', 'Create'), 'url'=>array('create'), 'icon'=>'file', 'visible' => (Yii::app()->util->is_authorized('setoranPajak.create')) ? true : false),
	array('label'=>Yii::t('trans', 'View'), 'url'=>array('view', 'id'=>$model->id), 'icon'=>'eye-open', 'visible' => (Yii::app()->util->is_authorized('setoranPajak.view')) ? true : false),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>