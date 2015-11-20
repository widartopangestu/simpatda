<?php

/* @var $this PejabatController */
/* @var $model Pejabat */
?>

<?php

$this->breadcrumbs = array(
    Yii::t('trans', 'Pejabat') => array('index'),
    Yii::t('trans', 'Create'),
);
$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Create') . ' ' . Yii::t('trans', 'Pejabat');
$this->modulTitle = Yii::t('trans', 'Create') . ' ' . Yii::t('trans', 'Pejabat');
$this->menu = array(
    array('label' => Yii::t('trans', 'Manage'), 'url' => array('index'), 'icon' => 'list-alt', 'visible' => (Yii::app()->util->is_authorized('pejabat.index')) ? true : false),
);
?>

<?php $this->renderPartial('_form', array('model' => $model)); ?> 