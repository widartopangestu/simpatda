<?php

/* @var $this GolonganController */
/* @var $model Golongan */
?>

<?php

$this->breadcrumbs = array(
    Yii::t('trans', 'Golongan') => array('index'),
    Yii::t('trans', 'Create'),
);
$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Create') . ' ' . Yii::t('trans', 'Golongan');
$this->modulTitle = Yii::t('trans', 'Create') . ' ' . Yii::t('trans', 'Golongan');
$this->menu = array(
    array('label' => Yii::t('trans', 'Manage'), 'url' => array('index'), 'icon' => 'list-alt', 'visible' => (Yii::app()->util->is_authorized('golongan.index')) ? true : false),
);
?>

<?php $this->renderPartial('_form', array('model' => $model)); ?>   