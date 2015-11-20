<?php

/* @var $this BidangUsahaController */
/* @var $model BidangUsaha */
?>

<?php

$this->breadcrumbs = array(
    Yii::t('trans', 'Bidang Usaha') => array('index'),
    $model->id => array('view', 'id' => $model->id),
    Yii::t('trans', 'Update'),
);
$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Update') . ' ' . Yii::t('trans', 'Bidang Usaha');
$this->modulTitle = Yii::t('trans', 'Update') . ' ' . Yii::t('trans', 'Bidang Usaha') . ' #' . $model->id;
$this->menu = array(
    array('label' => Yii::t('trans', 'Manage'), 'url' => array('index'), 'icon' => 'list-alt', 'visible' => (Yii::app()->util->is_authorized('bidangUsaha.index')) ? true : false),
    array('label' => Yii::t('trans', 'Create'), 'url' => array('create'), 'icon' => 'file', 'visible' => (Yii::app()->util->is_authorized('bidangUsaha.create')) ? true : false),
);
?>

<?php $this->renderPartial('_form', array('model' => $model)); ?>  