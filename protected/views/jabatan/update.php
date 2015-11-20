<?php

/* @var $this JabatanController */
/* @var $model Jabatan */
?>

<?php

$this->breadcrumbs = array(
    Yii::t('trans', 'Jabatan') => array('index'),
    $model->id => array('view', 'id' => $model->id),
    Yii::t('trans', 'Update'),
);
$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Update') . ' ' . Yii::t('trans', 'Jabatan');
$this->modulTitle = Yii::t('trans', 'Update') . ' ' . Yii::t('trans', 'Jabatan') . ' #' . $model->id;
$this->menu = array(
    array('label' => Yii::t('trans', 'Manage'), 'url' => array('index'), 'icon' => 'list-alt', 'visible' => (Yii::app()->util->is_authorized('jabatan.index')) ? true : false),
    array('label' => Yii::t('trans', 'Create'), 'url' => array('create'), 'icon' => 'file', 'visible' => (Yii::app()->util->is_authorized('jabatan.create')) ? true : false),
);
?>

<?php $this->renderPartial('_form', array('model' => $model)); ?> 