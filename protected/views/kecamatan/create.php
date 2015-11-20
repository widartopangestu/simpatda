<?php

/* @var $this KecamatanController */
/* @var $model Kecamatan */
?>

<?php

$this->breadcrumbs = array(
    Yii::t('trans', 'Kecamatan') => array('index'),
    Yii::t('trans', 'Create'),
);
$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Create') . ' ' . Yii::t('trans', 'Kecamatan');
$this->modulTitle = Yii::t('trans', 'Create') . ' ' . Yii::t('trans', 'Kecamatan');
$this->menu = array(
    array('label' => Yii::t('trans', 'Manage'), 'url' => array('index'), 'icon' => 'list-alt', 'visible' => (Yii::app()->util->is_authorized('kecamatan.index')) ? true : false),
);
?>

<?php $this->renderPartial('_form', array('model' => $model)); ?>