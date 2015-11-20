<?php

$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Create') . ' ' . Yii::t('trans', 'Role');
$this->modulTitle = Yii::t('trans', 'Create') . ' ' . Yii::t('trans', 'Role');
$this->breadcrumbs = array(
    Yii::t('trans', 'Roles') => array('admin'),
    Yii::t('trans', 'Create'),
);

$this->menu = array(
    array('label' => Yii::t('trans', 'Manage'), 'url' => array('admin'), 'icon' => 'list-alt'),
);
?>

<?php $this->renderPartial('_form', array('model' => $model, 'operations' => $operations)); ?>