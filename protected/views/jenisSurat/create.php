<?php

/* @var $this JenisSuratController */
/* @var $model JenisSurat */
?>

<?php

$this->breadcrumbs = array(
    Yii::t('trans', 'Jenis Surat') => array('index'),
    Yii::t('trans', 'Create'),
);
$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Create') . ' ' . Yii::t('trans', 'Jenis Surat');
$this->modulTitle = Yii::t('trans', 'Create') . ' ' . Yii::t('trans', 'Jenis Surat');
$this->menu = array(
    array('label' => Yii::t('trans', 'Manage'), 'url' => array('index'), 'icon' => 'list-alt', 'visible' => (Yii::app()->util->is_authorized('jenisSurat.index')) ? true : false),
);
?>

<?php $this->renderPartial('_form', array('model' => $model)); ?>  