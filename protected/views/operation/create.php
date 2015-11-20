<?php

$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Create') . ' ' . Yii::t('trans', 'Operation');
$this->breadcrumbs = array(
    Yii::t('trans', 'Operations') => array('admin'),
    Yii::t('trans', 'Create'),
);
$this->modulTitle = Yii::t('trans', 'Create') . ' ' . Yii::t('trans', 'Operation');
$this->menu = array(
    array('label' => Yii::t('trans', 'Manage'), 'url' => array('admin'), 'icon' => 'list-alt'),
);
?>
<?php $this->renderPartial('_form', array('model' => $model)); ?>