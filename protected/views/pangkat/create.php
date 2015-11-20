<?php

/* @var $this PangkatController */
/* @var $model Pangkat */
?>

<?php

$this->breadcrumbs = array(
    Yii::t('trans', 'Pangkat') => array('index'),
    Yii::t('trans', 'Create'),
);
$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Create') . ' ' . Yii::t('trans', 'Pangkat');
$this->modulTitle = Yii::t('trans', 'Create') . ' ' . Yii::t('trans', 'Pangkat');
$this->menu = array(
    array('label' => Yii::t('trans', 'Manage'), 'url' => array('index'), 'icon' => 'list-alt', 'visible' => (Yii::app()->util->is_authorized('pangkat.index')) ? true : false),
);
?>

<?php $this->renderPartial('_form', array('model' => $model)); ?>  