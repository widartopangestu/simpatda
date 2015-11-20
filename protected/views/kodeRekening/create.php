<?php
/* @var $this KodeRekeningController */
/* @var $model KodeRekening */
?>

<?php
$this->breadcrumbs=array(
	Yii::t('trans', 'Kode Rekenings')=>array('index'),
	Yii::t('trans', 'Create'),
);
$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Create') . ' ' . Yii::t('trans', 'Kode Rekenings');
$this->modulTitle = Yii::t('trans', 'Create') . ' ' . Yii::t('trans', 'Kode Rekening');
$this->menu=array(
	array('label'=>Yii::t('trans', 'Manage'), 'url'=>array('index'), 'icon' => 'list-alt', 'visible' => (Yii::app()->util->is_authorized('kodeRekening.index')) ? true : false),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>