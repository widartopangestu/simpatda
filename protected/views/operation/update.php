<?php

$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Update') . ' ' . Yii::t('trans', 'Operation');
$this->breadcrumbs = array(
    Yii::t('trans', 'Operations') => array('admin'),
    $model->name => array('view', 'id' => $model->id),
    Yii::t('trans', 'Update'),
);
$this->modulTitle = Yii::t('trans', 'Update') . ' ' . Yii::t('trans', 'Operation') . ' #' . $model->id;
$this->menu = array(
    array('label' => Yii::t('trans', 'Manage'), 'url' => array('admin'), 'icon' => 'list-alt'),
    array('label' => Yii::t('trans', 'Create'), 'url' => array('create'), 'icon' => 'file'),
);
?>

<?php $this->renderPartial('_form', array('model' => $model)); ?>