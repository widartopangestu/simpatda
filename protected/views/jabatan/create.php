<?php

/* @var $this JabatanController */
/* @var $model Jabatan */
?>

<?php

$this->breadcrumbs = array(
    Yii::t('trans', 'Jabatan') => array('index'),
    Yii::t('trans', 'Create'),
);
$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Create') . ' ' . Yii::t('trans', 'Jabatan');
$this->modulTitle = Yii::t('trans', 'Create') . ' ' . Yii::t('trans', 'Jabatan');
$this->menu = array(
    array('label' => Yii::t('trans', 'Manage'), 'url' => array('index'), 'icon' => 'list-alt', 'visible' => (Yii::app()->util->is_authorized('jabatan.index')) ? true : false),
);
?>

<?php $this->renderPartial('_form', array('model' => $model)); ?> 