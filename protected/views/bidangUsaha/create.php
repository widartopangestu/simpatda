<?php

/* @var $this BidangUsahaController */
/* @var $model BidangUsaha */
?>

<?php

$this->breadcrumbs = array(
    Yii::t('trans', 'Bidang Usaha') => array('index'),
    Yii::t('trans', 'Create'),
);
$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Create') . ' ' . Yii::t('trans', 'Bidang Usaha');
$this->modulTitle = Yii::t('trans', 'Create') . ' ' . Yii::t('trans', 'Bidang Usaha');
$this->menu = array(
    array('label' => Yii::t('trans', 'Manage'), 'url' => array('index'), 'icon' => 'list-alt', 'visible' => (Yii::app()->util->is_authorized('bidangUsaha.index')) ? true : false),
);
?>

<?php $this->renderPartial('_form', array('model' => $model)); ?>   