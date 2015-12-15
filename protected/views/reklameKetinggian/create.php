<?php

/* @var $this ReklameKetinggianController */
/* @var $model ReklameKetinggian */
?>

<?php

$this->breadcrumbs = array(
    Yii::t('trans', 'Reklame Ketinggian') => array('index'),
    Yii::t('trans', 'Create'),
);
$this->pageTitle = Yii::app()->params['title'] . ' - ' . Yii::t('trans', 'Create') . ' ' . Yii::t('trans', 'Reklame Ketinggian');
$this->modulTitle = Yii::t('trans', 'Create') . ' ' . Yii::t('trans', 'Reklame Ketinggian');
$this->menu = array(
    array('label' => Yii::t('trans', 'Manage'), 'url' => array('index'), 'icon' => 'list-alt', 'visible' => (Yii::app()->util->is_authorized('reklameKetinggian.index')) ? true : false),
);
?>

<?php $this->renderPartial('_form', array('model' => $model)); ?>